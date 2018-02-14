<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('general_model','g');
	}

	public function index()
	{
		echo "no data";
	}

	public function combo()
	{
		echo _generateOptionsNested(_post('s'), _post('f'), _post('v'));
	}

	public function search()
	{
		$this->g->search_data();
	}
}