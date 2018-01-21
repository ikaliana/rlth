<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencarian extends CI_Controller {

	private function InitiateTemplate($load_map,$load_datatable,$show_sidebar,$show_floatmenu,$template_path,$custom_css_path,$custom_js_path) {
		$data['load_map'] = $load_map;
		$data['load_datatable'] = $load_datatable;
		$data['template'] = $template_path;
		$data['custom_css'] = $custom_css_path;
		$data['custom_js'] = $custom_js_path;
		$data['active_menu'] = "pencarian";
		$data['show_sidebar'] = $show_sidebar;
		$data['show_floatmenu'] = $show_floatmenu;

		return $data;	
	}

	private function OpenView($data) {
		$this->load->view('master',$data);
	}

	public function index()
	{
		$data = $this->InitiateTemplate(true,true,true,true,'pencarian/Home','','pencarian/home_custom_js');
		$this->OpenView($data);
	}

	public function detail()
	{
		$data = $this->InitiateTemplate(false,false,false,false,'pencarian/detail','','pencarian/detail_js');
		$this->OpenView($data);
	}

}
