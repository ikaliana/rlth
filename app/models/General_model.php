<?php
class general_model extends CI_Model {
    function __construct()
    {
        parent::__construct();

		$this->db = $this->load->database('default',TRUE);
    }

    function search_data()
    {
    	$keyword = _post('keyword');
    	$kecamatan = _post('kecamatan');
    	$desa = _post('desa');

    	$query = "
    		select 
                l.answer_index
                , l.lokasi_longitude as longitude
                , l.lokasi_latitude as latitude
                , l.lokasi_altitude as altitude
                , d.nama
                , ifnull(gender.option_name, '0. NOT SPECIFIED') as gender
                , ifnull(d.alamat, '') as alamat
                , ifnull(nullif(d.umur, ''), 0) as usia
                , ifnull(nullif(d.jumlah_kk, ''), 0) as jumlah_kk
                , kerja.option_name as sektor
                , desa.option_name as desa 
    		from "._table('lokasi')." l 
    			left join "._table('data')." d on d.answer_index = l.answer_index 
    			left join "._table('pekerjaan')." kerja on kerja.option_id = d.pekerjaan 
    			left join "._table('gender')." gender on kerja.option_id = d.gender 
    			left join "._table('desa')." desa on desa.option_id = d.desa 
    		where l.lokasi_longitude <> '' and l.lokasi_latitude <> ''
    	";

    	$where = "";

    	if($keyword != "") {
    		$where = " and (d.nama like '%".$keyword."%'";
    		$where .= " or d.alamat like '%".$keyword."%'";
    		$where .= " or kerja.option_name like '%".$keyword."%')";
    	}

    	if($kecamatan != "") {
    		$option = "";
    		
    		foreach ($kecamatan as $item) {
    			$option .= "'".$item."', ";
    		}

    		if(strlen($option) > 0) {
    			$option = substr($option, 0, strlen($option) - 2);

    			$where .= " and l.kecamatan in (".$option.")";
    		}
    	}

    	if($desa != "") {
    		$option = "";
    		
    		foreach ($desa as $item) {
    			$option .= "'".$item."', ";
    		}

    		if(strlen($option) > 0) {
    			$option = substr($option, 0, strlen($option) - 2);

    			$where .= " and d.desa in (".$option.")";
    		}
    	}

    	$query .= $where;

    	$data = _query($query);

    	if(count($data) > 0)
    		echo $this->generate_map_json($data);
    	else
    		echo "";
    }

    function generate_map_json($data)
    {
    	$json = '{"type": "FeatureCollection","features": [';

    	foreach ($data as $item) {
    		$json .= '{
		        "type": "Feature",
		        "properties": {
		            "id": '.$item['answer_index'].',
		            "nama": "'.$item['nama'].'",
		            "jeniskelamin": "'.$item['gender'].'",
		            "alamat": "'.$item['alamat'].'",
		            "usia": '.$item['usia'].',
		            "jumlahkk": '.$item['jumlah_kk'].',
		            "sektor": "'.$item['sektor'].'",
		            "desa": "'.$item['desa'].'"
		        },
		        "geometry": {
		            "type": "Point",
		            "coordinates": ['.$item['longitude'].', '.$item['latitude'].', '.$item['altitude'].']
		        }
		    }, ';
    	}

    	$json = substr($json, 0, strlen($json) - 2)."]}";

    	return $json;
    }
}
?>