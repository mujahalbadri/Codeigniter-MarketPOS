<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		check_already_login();
		$this->load->view('login');
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($post['login'])) {
			$this->load->model('user_model');
			$query = $this->user_model->login($post);
			if($query->num_rows() > 0) {
				$row = $query->row();
				$data = [
					'id' => $row->id,
					'level' => $row->level
				];
				$this->session->set_userdata($data);
				echo "<script>
					alert('Selamat datang, login berhasil');
					window.location='". site_url('dashboard') ."';
				</script>";
			} else {
				echo "<script>
					alert('Login gagal, username / password salah');
					window.location='". site_url('auth/login') ."';
				</script>";
			}
		}
	}

	public function logout()
	{
		$data = ['id', 'level'];
		$this->session->unset_userdata($data);
		redirect('auth/login');
	}

}
