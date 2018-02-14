<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

    // function __construct() { 
    //     parent::__construct(); 
    //     $this->CheckUserAccess();
    // }
    
	private function InitiateTemplate($load_map,$load_datatable,$template_path,$custom_css_path,$custom_js_path) {
		$data['load_map'] = $load_map;
		$data['load_datatable'] = $load_datatable;
		$data['template'] = $template_path;
		$data['custom_css'] = $custom_css_path;
		$data['custom_js'] = $custom_js_path;
		$data['active_menu'] = "akun";

		return $data;	
	}

	private function OpenView($data) {
		$this->load->view('master',$data);
	}

	private function CheckUserAccess() {
		if(!CheckAksesGroup(["Administrator","Super Admin"])) { redirect('home/unauthorized'); }
	}

	public function index() 
	{
		$user = $this->session->userdata("userinfo");
		if(!$user) redirect('akun/login');

		$this->CheckUserAccess();

		$data = $this->InitiateTemplate(false,true,'administrasi/Akun','','administrasi/Akun_js');

		$this->load->model('Akun_model'); 
		$data['data'] = $this->Akun_model->LoadAll();
		$data['role'] = $this->Akun_model->Roles();

		$this->OpenView($data);
	}

	public function Save()
	{
		$kode = $this->input->post("kode");
		$nama = $this->input->post("nama");
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$role = $this->input->post("role");
		$mode = $this->input->post("editmode");
		$email = $this->input->post("email");

		$this->load->model('Akun_model'); 
		if($mode=="edit")
			$this->Akun_model->UpdateData($kode,$nama,$username,$role,$email);
		else
			$this->Akun_model->NewData($nama,$username,$password,$role,$email);
	}

	public function Delete() {
		$kode = $this->input->post("kode");

		$this->load->model('Akun_model'); 
		$this->Akun_model->DeleteData($kode);
	}

	public function Login() {
		$data['show_left_menu'] = false;
		$data['template'] = 'administrasi/login';
		$data['custom_css'] = '';
		$data['custom_js'] = 'administrasi/login_js';

		$this->load->view('master',$data);		
	}

	public function DoLogin() {
		$username = $this->input->post("username");
		$password = $this->input->post("password");

		$this->load->model('Akun_model');

		$row =  $this->Akun_model->GetUser($username,$password);

		if (count($row)==0) echo("ERROR");
		else if (count($row)==1) {
			$user = array( "username"=>$row->username,"name"=>$row->nama,"type"=>$row->role_name,"email"=>$row->email,"id"=>$row->id);
			$this->session->set_userdata("userinfo",$user);
			echo("SUCCESS");
		}
	}

	public function Logout() {
		$user = $this->session->userdata("userinfo");
		$username = $user["username"];

		$this->session->unset_userdata('userinfo');
		redirect('akun/login');
	}

	public function UbahPassword() {
		$user = $this->session->userdata("userinfo");
		if(!$user) redirect('akun/login');

		$data['template'] = 'administrasi/ubah_password';
		$data['custom_css'] = '';
		$data['custom_js'] = 'administrasi/ubah_password_js';

		$this->load->view('master',$data);				
	}

	public function CheckPassword() {
		$user = $this->session->userdata("userinfo");
		$username = $user["username"];
		$password = $this->input->post("password");

		$this->load->model('Akun_model');

		$row =  $this->Akun_model->GetUser($username,$password);

		if (count($row)==0) echo("ERROR-".$username);
		else if (count($row)==1) echo("SUCCESS");

	}

	public function SavePassword() {
		$user = $this->session->userdata("userinfo");
		$username = $user["username"];
		$password = $this->input->post("password");

		$this->load->model('Akun_model'); 
		$this->Akun_model->UpdatePassword($username,$password);
	}

	public function Profil() {
		$user = $this->session->userdata("userinfo");
		if(!$user) redirect('akun/login');
		$id = $user["id"];

		$data['template'] = 'administrasi/profil';
		$data['custom_css'] = '';
		$data['custom_js'] = 'administrasi/profil_js';

		$this->load->model('Akun_model');
		$data['profil'] =  $this->Akun_model->GetUserById($user["id"]);
		$data['role'] = $this->Akun_model->Roles();

		$this->load->view('master',$data);				
	}

	public function CheckUsername() {
		$username = $this->input->post("username");
		$id = $this->input->post("id");

		$this->load->model('Akun_model');
		$row =  $this->Akun_model->CheckUsername($username,$id);

		if (count($row)==1) echo("ERROR-".$username);
		else if (count($row)==0) echo("SUCCESS");
	}

	public function SaveProfil() {
		$user = $this->session->userdata("userinfo");
		$id = $user["id"];

		$nama = $this->input->post("nama");
		$username = $this->input->post("username");
		$email = $this->input->post("email");

		$this->load->model('Akun_model'); 
		$this->Akun_model->UpdateProfil($id,$nama,$username,$email);
	}

	public function Relogin() {
		$id = $this->input->post("id");

		$this->load->model('Akun_model');
		$row = $this->Akun_model->GetUserById($id);
		if (count($row)==0) echo("ERROR");
		else if (count($row)==1) {
			$this->session->unset_userdata('userinfo');
			$user = array( "username"=>$row->username,"name"=>$row->nama,"type"=>$row->role_name,"email"=>$row->email,"id"=>$row->id);
			$this->session->set_userdata("userinfo",$user);
			echo("SUCCESS");
		}
	}
}
