<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelaporan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('pelaporan_model','p');
	}

	public function index()
	{
		$arrData['tpl'] = _tplInit("pelaporan", false, true, false, 'pelaporan/pelaporan_css', 'pelaporan/pelaporan_js');

		$this->load->view('general/header', $arrData);
		$this->load->view('pelaporan/main', $arrData);
		$this->load->view('general/footer', $arrData);
	}

	public function responden_kecamatan() 
	{
		$data = $this->p->responden_per_kecamatan();
		$this->get_json($data,['kecamatan','jumlah'],['nama_kecamatan','jumlah']);
	}

	public function responden_gender() 
	{
		$data = $this->p->responden_per_gender();
		$this->get_json($data,['gender','jumlah'],['gender','jumlah']);
	}

	public function responden_pendidikan() 
	{
		$data = $this->p->responden_per_pendidikan();
		$this->get_json($data,['pendidikan','jumlah'],['pendidikan','jumlah']);
	}

	public function responden_pekerjaan() 
	{
		$data = $this->p->responden_per_pekerjaan();
		$this->get_json($data,['pekerjaan','jumlah'],['pekerjaan','jumlah']);
	}

	public function responden_penghasilan() 
	{
		$data = $this->p->responden_per_penghasilan();
		$this->get_json($data,['penghasilan','jumlah'],['penghasilan','jumlah']);
	}

	public function responden_status_rumah() 
	{
		$data = $this->p->responden_per_status_rumah();
		$this->get_json($data,['status','jumlah'],['status','jumlah']);
	}

	public function responden_status_tanah() 
	{
		$data = $this->p->responden_per_status_tanah();
		$this->get_json($data,['status','jumlah'],['status','jumlah']);
	}

	public function responden_rumah_lain() 
	{
		$data = $this->p->responden_per_rumah_lain();
		$this->get_json($data,['status','jumlah'],['status','jumlah']);
	}

	public function responden_tanah_lain() 
	{
		$data = $this->p->responden_per_tanah_tanah();
		$this->get_json($data,['status','jumlah'],['status','jumlah']);
	}

	public function responden_bantuan_rumah() 
	{
		$data = $this->p->responden_per_bantuan_rumah();
		$this->get_json($data,['status','jumlah'],['status','jumlah']);
	}

	public function get_json($data,$label,$field) 
	{
		$json = "";
		foreach ($data as $item) {
    		$json .= '{';
    		for($i = 0; $i < count($label); $i++)
    		{
    			$json .= '"'.$label[$i].'": "'.$item[$field[$i]].'",';
    		}
    		$json .= '},';
    	}
    	if($json != "") $json = "[".$json."]";
    	echo $json;
	}

}