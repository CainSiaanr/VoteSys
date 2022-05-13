<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logincheck extends CI_Controller {

    public function loginchecker()
	{
		//Fetching username & password
		$uname = $this->input->post('username');
		$pass = $this->input->post('password');

		//Loading login model & fetching data
		$this->load->model('voter_model');
		$query = $this->voter_model->fetch_accounts();

		foreach ($query as $row=>$value){
			//Checking username
			if($value->username == $uname){//hash('sha256', $username)){
				//Checking password
				if($value->password == $pass){//hash('sha256', $pass.'admin')){
					//TODO:setup domain name when deployed later
					$cookie = array(
						'name'   => 'role',
						'value'  => $value->role,
						'expire' => '0',
						//'domain' => '/*insert domain here*/', 
						'secure' => TRUE
					);

					$this->input->set_cookie($cookie);

					$cookie = array(
						'name'   => 'name',
						'value'  => $value->nama,
						'expire' => '0',
						//'domain' => '/*insert domain here*/', 
						'secure' => TRUE
					);

					$this->input->set_cookie($cookie);

					if($value->role == 'voter'){
						$cookie = array(
							'name'   => 'id',
							'value'  => $value->id,
							'expire' => '0',
							//'domain' => '/*insert domain here*/', 
							'secure' => TRUE
						);

						$this->input->set_cookie($cookie);
						
						$cookie = array(
							'name'   => 'prodi',
							'value'  => $value->himpunan_id,
							'expire' => '0',
							//'domain' => '/*insert domain here*/', 
							'secure' => TRUE
						);

						$this->input->set_cookie($cookie);

						redirect('vote');
					}else if($value->role == 'admin'){
						$cookie = array(
							'name'   => 'id',
							'value'  => $value->id,
							'expire' => '0',
							//'domain' => '/*insert domain here*/', 
							'secure' => TRUE
						);

						$this->input->set_cookie($cookie);

						redirect('admin/candidate');
					}
					break;
				}
			}
		}
		//If wrong, set notification then redirect to login
		$this->session->set_flashdata('query_result', 'Username atau password salah.');
		redirect('login');
	}

	public function logout(){
		//TODO:setup domain name when deployed later
		$cookie = array(
			'name'   => 'role',
			'value'  => '',
			'expire' => '',
			//'domain' => '/*insert domain here*/', 
			'secure' => TRUE
		);

		$this->input->set_cookie($cookie);

		if($this->input->cookie('name') != NULL){
			$cookie = array(
				'name'   => 'name',
				'value'  => '',
				'expire' => '',
				//'domain' => '/*insert domain here*/', 
				'secure' => TRUE
			);

			$this->input->set_cookie($cookie);
		}

		if($this->input->cookie('id') != NULL){
			$cookie = array(
				'name'   => 'id',
				'value'  => '',
				'expire' => '',
				//'domain' => '/*insert domain here*/', 
				'secure' => TRUE
			);

			$this->input->set_cookie($cookie);
		}

		if($this->input->cookie('prodi') != NULL){
			$cookie = array(
				'name'   => 'prodi',
				'value'  => '',
				'expire' => '',
				//'domain' => '/*insert domain here*/', 
				'secure' => TRUE
			);

			$this->input->set_cookie($cookie);
		}

		redirect('');
	}
}
?>
