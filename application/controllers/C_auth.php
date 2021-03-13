<?php

class C_auth extends CI_Controller{

	function __construct(){
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('M_auth');
	}

	public function index(){
		$data['title']	= 'Halaman Login';
		$this->load->view('auth/auth.php', $data);
	}

	public function cek_login(){
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');

		$data = array(
						'username' => $username,
						'password' => $password
					);

		$sikat = $this->M_auth->data_user($data);

		if($sikat->num_rows() > 0){
			$data['akun']	= $this->M_auth->cek_login($username, $password);

			foreach($data['akun'] as $akun){
			$sesi['id_user']	= $akun->id_user;
			$sesi['npm']		= $akun->npm;
			$sesi['username']	= $akun->username;
			$sesi['password']	= $akun->password;
			$sesi['akses']		= $akun->akses;

			$this->session->set_userdata($sesi);

			echo "
						<link href='".base_url()."/assets/sweetalert/sweetalert.css' rel='stylesheet' />
						<script src='".base_url()."/assets/bsb/plugins/jquery/jquery.min.js'></script>
						<script src='".base_url()."/assets/sweetalert/sweetalert.min.js'></script>
						<script type='text/javascript'>
							setTimeout(function () {  
							swal({
								title: 'Login Sukses',
								text: 'Selamat Datang ".$akun->username."',
								type: 'success',
								timer: 4000,
								showConfirmButton: false
							});  
							},10); 
							window.setTimeout(function(){ 
							window.location.href='".base_url('C_admin/index')."';	
							} ,2100); 
						</script>";
			}
		}else{
			echo "
				<link href='".base_url()."/assets/sweetalert/sweetalert.css' rel='stylesheet' />
				<script src='".base_url()."/assets/bsb/plugins/jquery/jquery.min.js'></script>
				<script src='".base_url()."/assets/sweetalert/sweetalert.min.js'></script>
					<script type='text/javascript'>
						setTimeout(function () {  
						swal({
							title: 'Login Gagal',
							text: 'Cek Username dan Password Anda',
							type: 'error',
							timer: 10000,
							showConfirmButton: false
						});  
						},10); 
						window.setTimeout(function(){ 
						window.location.href='".base_url('C_auth/index')."';	
						} ,2100); 
					</script>";	
		}
		
	}

}