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
        $this->process_data("data", $ans_data_umum, $action, $answer_index);
        $this->process_data("bangunan", $ans_aspek_bangunan, $action, $answer_index);
        $this->process_data("komponen", $ans_aspek_komponen, $action, $answer_index);

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

    function process_template($answer_index)
    {
        $template = _config('template_path')."/template.docx";
        $newFile = _config('template_path')."/template_temp.docx";

        $query = str_replace("%i", $answer_index, _view('cetak'));
        $result = _query($query)[0];

        $fieldValues = array (
            'M_1_NAMA' => $result['nama']
            , 'M_6_DESA' => $result['desa']
            , "KECAMATAN" => $result['kecamatan']
            , "M_4_UMUR_TAHUN" => $result['umur']
            , "M_10_PEKERJAAN" => $result['pekerjaan']
            , "M_5_ALAMAT" => $result['alamat']
            , "M_3_NOMOR_KTP" => $result['no_ktp']
            , "M_12_MATERIAL_ATAP_TERLUAS" => $result['material_atap']
            , "M_16_MATERIAL_LANTAI_TERLUAS" => $result['material_dinding']
            , "M_14_MATERIAL_DINDING_TERLUAS" => $result['material_lantai']
        );
        
        $this->load->library('words');

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template);

        foreach ($fieldValues as $key => $value) {
            $templateProcessor->setValue($key, $value);
        }

        $templateProcessor->setImageValue("DENAH", "http://via.placeholder.com/350x150");
        
        $templateProcessor->saveAs($newFile);

        $this->_push_file($newFile, "proposal_".$answer_index.".docx");
    }

    function _process_template($answer_index)
    {
        $template = _config('template_path')."/template.docx";
        $newFile = _config('template_path')."/template_temp.docx";

        $query = str_replace("%i", $answer_index, _view('cetak'));
        $result = _query($query)[0];

        copy( $template, $newFile );

        $zip = new ZipArchive();
        
        if ( $zip->open( $newFile, ZIPARCHIVE::CHECKCONS ) !== TRUE ) { echo 'failed to open template'; exit; }
        
        $file = 'word/document.xml';
        $data = $zip->getFromName( $file );

        $doc = new DOMDocument();
        $doc->loadXML( $data );

        $wts = $doc->getElementsByTagNameNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'fldChar');

        $fieldValues = array (
            'm_1_nama' => $result['nama']
            , 'm_6_desa' => $result['desa']
            , "kecamatan" => $result['kecamatan']
            , "m_4_umur_tahun" => $result['umur']
            , "m_10_pekerjaan" => $result['pekerjaan']
            , "m_5_alamat" => $result['alamat']
            , "m_3_nomor_ktp" => $result['no_ktp']
            , "m_12_material_atap_terluas" => $result['material_atap']
            , "m_16_material_lantai_terluas" => $result['material_dinding']
            , "m_14_material_dinding_terluas" => $result['material_lantai']
        );

        for ( $x = 0; $x < $wts->length; $x++ )
        {
            if ( $wts->item( $x )->attributes->item(0)->nodeName == 'w:fldCharType' && $wts->item( $x )->attributes->item(0)->nodeValue == 'begin' )
            {
                $newcount = $this->getMailMerge( $wts, $x, $fieldValues );
                $x = $newcount;
            }
        }

        $zip->deleteName($file);
        $zip->addFromString( $file, $doc->saveXML() );
        $zip->close();

        //$this->_push_file($newFile, "proposal_".$answer_index.".docx");
    }

    function getMailMerge( &$wts, $index, $dataarray )
    {
        $loop = true;
        $startfield = false;
        $setval = false;
        $counter = $index;
        $newcount = 0;
        
        while ( $loop ) {
            if ( $wts->item( $counter )->attributes->item(0)->nodeName == 'w:fldCharType' ) {
                $nodeName = '';
                $nodeValue = '';
        
                switch( $wts->item( $counter )->attributes->item(0)->nodeValue ) {
                    case 'begin':
                        if ( $startfield ) {
                            $counter = getMailMerge( $wts, $counter, $dataarray );
                        }

                        $startfield = true;
                        
                        if ( $wts->item( $counter )->parentNode->nextSibling ) {
                            $nodeName = $wts->item( $counter )->parentNode->nextSibling->childNodes->item(1)->nodeName;
                            $nodeValue = $wts->item( $counter )->parentNode->nextSibling->childNodes->item(1)->nodeValue;
                        } else {
                            // No sibling
                            // check next node
                            $nodeName = $wts->item( $counter + 1 )->parentNode->previousSibling->childNodes->item(1)->nodeName;
                            $nodeValue = $wts->item( $counter + 1 )->parentNode->previousSibling->childNodes->item(1)->nodeValue;
                        }

                        if ( $nodeValue == 'date \@ "MMMM d, yyyy"' ) {
                            $setval = true;
                            $newval = date( "F j, Y" );
                        }

                        if ( substr( $nodeValue, 0, 11 ) == ' MERGEFIELD' ) {
                            $setval = true;
                            $newval = $dataarray[ strtolower( str_replace( '"', '', trim( substr( $nodeValue, 12 ) ) ) ) ];
                        }

                        $counter++;
                        break;
                    case 'separate':
                        if ( $wts->item( $counter )->parentNode->nextSibling ) {
                            $nodeName = $wts->item( $counter )->parentNode->nextSibling->childNodes->item(1)->nodeName;
                            $nodeValue = $wts->item( $counter )->parentNode->nextSibling->childNodes->item(1)->nodeValue;
                        } else {
                            // No sibling
                            // check next node
                            $nodeName = $wts->item( $counter + 1 )->parentNode->previousSibling->childNodes->item(1)->nodeName;
                            $nodeValue = $wts->item( $counter + 1 )->parentNode->previousSibling->childNodes->item(1)->nodeValue;
                        }

                        if ( $setval ) {
                            $wts->item( $counter )->parentNode->nextSibling->childNodes->item(1)->nodeValue = $newval;
                            $setval = false;
                            $newval = '';
                        }
                        
                        $counter++;
                        break;
                    case 'end':
                        if( $startfield )
                        {
                            $startfield = false;
                        }
                        
                        $loop = false;
                }
            }
        }

        return $counter;
    }

    function _push_file($path, $name)
    {
        // make sure it's a file before doing anything!
        if(is_file($path))
        {
            // required for IE
            if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off'); }

            // get the file mime type using the file extension
            $this->load->helper('file');

            $mime = get_mime_by_extension($path);

            // Build the headers to push out the file properly.
            header('Pragma: public');     // required
            header('Expires: 0');         // no cache
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($path)).' GMT');
            header('Cache-Control: private',false);
            header('Content-Type: '.$mime);  // Add the mime type from Code igniter.
            header('Content-Disposition: attachment; filename="'.basename($name).'"');  // Add the file name
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: '.filesize($path)); // provide file size
            header('Connection: close');

            readfile($path); // push it out

            unlink($path);
            
            exit();
        }
    }
}
?>