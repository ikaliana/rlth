<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('akun_model', 'a');
	}

	public function index()
	{
		if(_isLogin()) redirect('pencarian');
		$this->load->view('login/main');
		$this->load->view('login/login_js');
	}

	public function check() {
		$username = _post("username");
		$password = _post("password");

		$row =  $this->a->GetUser($username,$password);

		if (count($row) == 0) echo("ERROR");
		else {
			$user = array(
				"username" => $row->username,
				"name" => $row->nama,
				"type" => $row->role_name,
				"email" => $row->email,
				"id" => $row->id
			);
			$this->session->set_userdata("userinfo",$user);
			
			echo("SUCCESS");
		}
	}
}