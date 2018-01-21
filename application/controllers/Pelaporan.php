<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelaporan extends CI_Controller {

	private function InitiateTemplate($template_path,$custom_css_path,$custom_js_path) {
		$data['load_datatable'] = true;
		$data['show_sidebar'] = true;
		$data['load_chart'] = true;
		$data['template'] = $template_path;
		$data['custom_css'] = $custom_css_path;
		$data['custom_js'] = $custom_js_path;
		$data['active_menu'] = "pencarian";

		return $data;	
	}

	private function OpenView($data) {
		$this->load->view('master',$data);
	}

	public function index()
	{
		$data = $this->InitiateTemplate('pelaporan/Home','','pelaporan/home_custom_js');
		$this->OpenView($data);
	}

}
