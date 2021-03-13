<?php

class M_auth extends CI_Model {

	public function data_user($data){
		$sikat = $this->db->get_where('tb_user', $data);
		return $sikat;
	}

	public function cek_login($username, $password){
		$sikat = $this->db->query("SELECT * FROM tb_user WHERE username='$username' AND password='$password'");
		return $sikat->result();
	}

}