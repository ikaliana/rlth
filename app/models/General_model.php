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
        $bsps = _post('bsps');

    	$query = _view('search_base');

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

        if($bsps != "") {
            $where .= "
                and (
                    d.penghasilan > 1 and d.tanah_milik = 1 and d.bantuan_perumahan = 3 and d.kontribusi_rumah <> 0
                    and (
                        k.kondisi_atap > 1 or k.kondisi_dinding > 1 or k.kondisi_lantai > 1
                    )
                )
            ";
        }

    	$query .= $where;
        //_d($query, true);

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
		            "alamat": "'.trim(preg_replace('/\s+/', ' ', $item['alamat'])).'",
		            "usia": '.$item['usia'].',
		            "jumlahkk": '.$item['jumlah_kk'].',
		            "sektor": "'.$item['sektor'].'",
		            "desa": "'.$item['desa'].'",
                    "bsps": "'.$item['penerima_bsps'].'"
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