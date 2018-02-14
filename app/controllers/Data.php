<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('data_model','d');
	}

	public function index()
	{
		$arrData['tpl'] = _tplInit("data", true, true, false, '', '');

		$this->load->view('general/header', $arrData);
		$this->load->view('data/main', $arrData);
		$this->load->view('general/footer', $arrData);
	}

	public function add()
	{
		_checkSession();

		$arrData['tpl'] = _tplInit("data", false, false, false, 'data/edit_css', 'data/edit_js');

		$this->load->view('general/header', $arrData);
		$this->load->view('data/add', $arrData);
		$this->load->view('general/footer', $arrData);
	}

	public function detail($answer_index)
	{
		_checkSession();

		$arrData['tpl'] = _tplInit("data", false, false, false, 'data/edit_css', 'data/edit_js');
		$arrData['data'] = $this->d->get_data($answer_index);

		$this->load->view('general/header', $arrData);
		$this->load->view('data/detail', $arrData);
		$this->load->view('general/footer', $arrData);
	}

	public function save()
	{
		_checkSession();

		$this->d->save_data();

		redirect('data');
	}

	public function import()
	{
		_checkSession();

		$arrData['tpl'] = _tplInit("data", false, false, false, '', 'data/import_js');

		$this->load->view('general/header', $arrData);
		$this->load->view('data/import', $arrData);
		$this->load->view('general/footer', $arrData);
	}

	public function extract()
	{
		_checkSession();
		
		$file = $this->d->save_file();
		$this->d->extract_data($file);

		redirect("data/import");
	}
}