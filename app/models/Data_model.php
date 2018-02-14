<?php
class data_model extends CI_Model {
    function __construct()
    {
        parent::__construct();

		$this->db = $this->load->database('default',TRUE);
        $this->sections = array('lokasi', 'data', 'foto', 'bangunan', 'komponen', 'waktu');
    }

    function get_data($answer_index)
    {
        $query = str_replace("%i", $answer_index, _view('get_data_lokasi'));
        $data['lokasi'] = _query($query)[0];

        $query = str_replace("%i", $answer_index, _view('get_data_umum'));
        $data['umum'] = _query($query)[0];

        $query = str_replace("%i", $answer_index, _view('get_data_foto'));
        $data['foto'] = _query($query)[0];

        $query = str_replace("%i", $answer_index, _view('get_data_bangunan'));
        $data['bangunan'] = _query($query)[0];

        $query = str_replace("%i", $answer_index, _view('get_data_komponen'));
        $data['komponen'] = _query($query)[0];

        return $data;
    }

    function save_data()
    {
        $post = _post();

        $action = $post["action"];

        $ans_lokasi = array();
        $ans_data_umum = array();
        $ans_aspek_bangunan = array();
        $ans_aspek_komponen = array();

        foreach ($post as $key => $value) {
            if(strpos($key, 'lokasi-') !== false) {
                $key = str_replace("lokasi-", "", $key);

                $ans_lokasi[$key] = $value;
            } else if(strpos($key, 'umum-') !== false) {
                $key = str_replace("umum-", "", $key);

                $ans_data_umum[$key] = $value;
            } else if(strpos($key, 'bangunan-') !== false) {
                $key = str_replace("bangunan-", "", $key);

                $ans_aspek_bangunan[$key] = $value;
            } else if(strpos($key, 'komponen-') !== false) {
                $key = str_replace("komponen-", "", $key);

                $ans_aspek_komponen[$key] = $value;
            }
        }

        if($action == "add")
            $answer_index = $this->get_answer_index();
        else if($action == "edit")
            $answer_index = _post("answer_index");

        $this->process_data("lokasi", $ans_lokasi, $action, $answer_index);
        $this->process_data("data", $ans_lokasi, $action, $answer_index);
        $this->process_data("bangunan", $ans_lokasi, $action, $answer_index);
        $this->process_data("komponen", $ans_lokasi, $action, $answer_index);

        $this->process_images($action, $answer_index);
    }

    function process_data($table, $answer, $type, $answer_index)
    {
        $data = $answer;

        if($type == "add") {
            $answer_index++;

            $data["answer_index"] = $answer_index;
            $data["created_by"] = _userData("userinfo", "id");
            $data["created_time"] = date("Y-m-d H:i:s");
        }

        $data["update_by"] = _userData("userinfo", "id");
        $data["update_time"] = date("Y-m-d H:i:s");

        if($type == "add")
            $this->db->insert(_table($table), $data);
        else
            $this->db->update(_table($table), $data, "answer_index = ".$answer_index);
    }

    function process_images($action, $answer_index)
    {
        $files = $_FILES;
        $post = _post();

        if($action == "add") {
            $answer_index++;

            $data["answer_index"] = $answer_index;
            $data["created_by"] = _userData("userinfo", "id");
            $data["created_time"] = date("Y-m-d H:i:s");
        }

        $data["update_by"] = _userData("userinfo", "id");
        $data["update_time"] = date("Y-m-d H:i:s");

        foreach ($files as $key => $file) {
            if($file["name"] != "") {
                $file_type = pathinfo($file["name"], PATHINFO_EXTENSION);
                $filename = str_replace(".", "", microtime(true)).".".$file_type;

                $data[$key] = $filename;

                process_file($key, $filename);
            }
        }

        if($action == "add")
            $this->db->insert(_table('foto'), $data);
        else
            $this->db->update(_table('foto'), $data, "answer_index = ".$answer_index);
    }

    function get_data_column()
    {
        $result = array();

        foreach ($this->sections as $section) {
            $query = str_replace("%s", $section, _view('get_column_config'));
            $data = _query($query);
            
            $result[$section] = (count($data) > 0) ? $data : "";
        }

        return $result;
    }

    function process_import_data($columns, $data, $answer_index)
    {
        foreach ($this->sections as $section) {
            $result = array(
                "answer_index" => $answer_index
                , "created_by" => _userData("userinfo", "id")
                , "created_time" => date("Y-m-d H:i:s")
                , "update_by" => _userData("userinfo", "id")
                , "update_time" => date("Y-m-d H:i:s")
            );

            foreach ($columns[$section] as $item) {
                $key = $item['field_name'];
                $column_no = $item['column_no'];

                $answer = trim($data[$column_no]);
                $answer = empty($answer) ? "" : $answer;

                $result[$key] = $answer;
            }

            $this->db->insert(_table($section), $result);
        }
    }

    function get_answer_index()
    {
        $query = _view('get_max_answer');
        $data = _query($query);

        return ($data[0]["max_index"] != "") ? $data[0]["max_index"] : 1;
    }

    function save_file()
    {
        $file = "";

        $ext = pathinfo($_FILES["rtlh_file"]["name"], PATHINFO_EXTENSION);

        $uplcfg['upload_path'] = _config('upload_path').'/import';
        $uplcfg['allowed_types'] = 'xls|xlsx';
        $uplcfg['max_size'] = 2000;
        $uplcfg['file_ext_tolower'] = true;
        $uplcfg['overwrite'] = true;
        $uplcfg['file_name'] = "rlth_".date("Ymd_His").".".$ext;

        $this->load->library('upload', $uplcfg);

        if($this->upload->do_upload('rtlh_file')) {
            $data = array('upload_data' => $this->upload->data());
            
            $file = $data['upload_data']['full_path'];
        } else {
            $errors = $this->upload->display_errors();

            _d($errors, true);
        }

        return $file;
    }

    function extract_data($file)
    {
        ini_set('max_execution_time', 0);
        set_time_limit(0);

        $columns = $this->get_data_column();
        $answer_index = $this->get_answer_index();

        $this->load->library('excel');

        $read = PHPExcel_IOFactory::createReaderForFile($file);
        $read->setReadDataOnly(true);
        $excel  = $read->load($file);

        $sheet = $excel->getSheet(0);

        $rows = $sheet->getHighestRow();
        $cols = $sheet->getHighestColumn();
        
        for($row = 2; $row <= $rows; $row++) {
            $data_row = $sheet->rangeToArray('A'.$row.":".$cols.$row, null, true, false);

            $this->process_import_data($columns, $data_row[0], $answer_index);

            $answer_index++;
        }
    }
}
?>