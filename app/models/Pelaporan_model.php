<?php
class pelaporan_model extends CI_Model {
    function __construct()
    {
        parent::__construct();

		$this->db = $this->load->database('default',TRUE);
    }

    function get_selected_option($option_name) {
        $selected_option = _post($option_name);
        $option = "";
        if($selected_option != "") {
            foreach ($selected_option as $item) {
                if($option != "") $option .= ",";
                $option .= "'".$item."'";
            }
        }
        if ($option == "") $option = "''";

        return $option;        
    }

    function execute_query($query_name)
    {
        $query = _view($query_name);
        $query = str_replace("%2", $this->get_selected_option('kecamatan'), $query);
        $query = str_replace("%1", $this->get_selected_option('desa'), $query);

        return _query($query);        
    }

    function responden_per_kecamatan()
    {
    	return $this->execute_query('laporan_responden_per_kecamatan');
    }

    function responden_per_gender()
    {
        return $this->execute_query('laporan_responden_per_gender');
    }

    function responden_per_pendidikan()
    {
        return $this->execute_query('laporan_responden_per_pendidikan');
    }

    function responden_per_pekerjaan()
    {
        return $this->execute_query('laporan_responden_per_pekerjaan');
    }

    function responden_per_penghasilan()
    {
        return $this->execute_query('laporan_responden_per_penghasilan');
    }

    function responden_per_status_rumah()
    {
        return $this->execute_query('laporan_responden_per_status_rumah');
    }

    function responden_per_status_tanah()
    {
        return $this->execute_query('laporan_responden_per_status_tanah');
    }

    function responden_per_rumah_lain()
    {
        return $this->execute_query('laporan_responden_per_rumah_lain');
    }

    function responden_per_tanah_tanah()
    {
        return $this->execute_query('laporan_responden_per_tanah_lain');
    }

    function responden_per_bantuan_rumah()
    {
        return $this->execute_query('laporan_responden_per_bantuan_rumah');
    }

}
?>