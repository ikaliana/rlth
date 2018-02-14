<?php 
class Akun_model extends CI_Model {

    function __construct() { 
        parent::__construct(); 
    }

    private function LoadDatabase() {
        $this->load->database();
    } 

    private function CloseDatabase() {
        $this->db->close();
    }

    public function EncryptPassword($xpass) {
        $strutf8 = utf8_encode($xpass);
        $strhash2 = hash('sha1',$strutf8,true);
        return base64_encode($strhash2);
    }

    public function LoadAll() {
        $this->LoadDatabase();
        $this->db->select('id,nama,username,users.role_id,role_name,email');
        $this->db->from('users');
        $this->db->join('role', 'users.role_id = role.role_id', 'left');
        $this->db->where('users.role_id <> 5');
        $query = $this->db->get();
        $this->CloseDatabase();

        return $query;
    }

    public function Roles() {
        $this->LoadDatabase();
        $query = $this->db->get_where('role','role_id <> 5');
        $this->CloseDatabase();

        return $query;
    }

    public function NewData($nama,$username,$password,$role,$email) {
        $this->LoadDatabase();
        $data = array('nama' => $nama, 'username' => $username, 'password' => md5($password)
                    , 'role_id' => $role, 'email' => $email, 'status' => 1);
        $this->db->insert('users', $data);
        $this->CloseDatabase();
    }

    public function UpdateData($kode,$nama,$username,$role,$email) {
        $this->LoadDatabase();
        $data = array('nama' => $nama, 'username' => $username, 'role_id' => $role, 'email' => $email);
        $this->db->where('id',$kode);
        $this->db->update('users', $data);
        $this->CloseDatabase();
    }

    public function DeleteData($kode) {
        $this->LoadDatabase();
        $this->db->where('id',$kode);
        $this->db->delete('users');
        $this->CloseDatabase();
    }

    public function GetUser($username,$password) {
        $this->LoadDatabase();
        $this->db->select('id,nama,username,users.role_id,role_name,email');
        $this->db->from('users');
        $this->db->join('role', 'users.role_id = role.role_id', 'left');
        $this->db->where('username',$username);
        $this->db->where('password',md5($password));
        $query = $this->db->get();

        return $query->row();
    }

    public function GetUserById($id) {
        $this->LoadDatabase();
        $this->db->select('id,nama,username,users.role_id,role_name,email');
        $this->db->from('users');
        $this->db->join('role', 'users.role_id = role.role_id', 'left');
        $this->db->where('id',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function UpdatePassword($username,$password) {
        $this->LoadDatabase();
        $data = array('password' => md5($password));
        $this->db->where('username',$username);
        $this->db->update('users', $data);
        $this->CloseDatabase();
    }

    public function CheckUsername($username,$id) {
        $this->LoadDatabase();
        $this->db->select('id,username');
        $this->db->from('users');
        $this->db->where("username = '".$username."' AND id <> ".$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function UpdateProfil($kode,$nama,$username,$email) {
        $this->LoadDatabase();
        $data = array('nama' => $nama, 'username' => $username, 'email' => $email);
        $this->db->where('id',$kode);
        $this->db->update('users', $data);
        $this->CloseDatabase();
    }

} 
?> 