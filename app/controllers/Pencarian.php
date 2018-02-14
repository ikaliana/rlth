<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencarian extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$arrData['tpl'] = _tplInit("pencarian", true, true, false, '', '');

		$this->load->view('general/header', $arrData);
		$this->load->view('pencarian/main', $arrData);
		$this->load->view('general/footer', $arrData);
	}
}