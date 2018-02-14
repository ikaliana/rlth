<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('akun_model', 'a');
	}

	public function index()
	{
		$arrData['tpl'] = _tplInit("akun", false, false, true, '', 'akun/main_js');

		$arrData['data'] = $this->a->LoadAll();
		$arrData['role'] = $this->a->Roles();

		$this->load->view('general/header', $arrData);
		$this->load->view('akun/main', $arrData);
		$this->load->view('general/footer', $arrData);
	}

	public function profil() {
		$user = _userData("userinfo");
		
		if(!$user) redirect('akun/login');
		
		$id = $user["id"];

		$arrData['tpl'] = _tplInit("akun", false, false, false, '', 'akun/profil_js');

		$arrData['profil'] =  $this->a->GetUserById($id);
		$arrData['role'] = $this->a->Roles();

		$this->load->view('general/header', $arrData);
		$this->load->view('akun/profil', $arrData);
		$this->load->view('general/footer', $arrData);
	}

	public function unauthorized()
	{
		$this->load->view('akun/unauthorized');
	}

	public function save()
	{
		$kode = _post("kode");
		$nama = _post("nama");
		$username = _post("username");
		$password = _post("password");
		$role = _post("role");
		$mode = _post("editmode");
		$email = _post("email");

		if($mode=="edit")
			$this->a->UpdateData($kode,$nama,$username,$role,$email);
		else
			$this->a->NewData($nama,$username,$password,$role,$email);
	}

	public function delete() {
		$kode = _post("kode");

		$this->a->DeleteData($kode);
	}

	public function ubahpassword()
	{
		$user = _userData("userinfo");
		
		if(!$user) redirect('akun/login');

		$arrData['tpl'] = _tplInit("akun", false, false, false, '', 'akun/ubah_password_js');

		$this->load->view('general/header', $arrData);
		$this->load->view('akun/ubah_password', $arrData);
		$this->load->view('general/footer', $arrData);
	}

	public function checkpassword() {
		$user = _userData("userinfo");

		$username = $user["username"];
		$password = $this->input->post("password");

		$row =  $this->a->GetUser($username,$password);

		if (count($row)==0) echo("ERROR-".$username);
		else if (count($row)==1) echo("SUCCESS");

	}

	public function savepassword() {
		$user = _userData("userinfo");

		$username = $user["username"];
		$password = $this->input->post("password");

		$this->a->UpdatePassword($username,$password);
	}
}