<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
    	$this->load->model('home_models');


		// Set config options (only 'server' is required to work)

		$config = array('server'            => rest_url,
		                //'api_key'         => 'Setec_Astronomy'
		                //'api_name'        => 'X-API-KEY'
		                //'http_user'       => 'username',
		                //'http_pass'       => 'password',
		                //'http_auth'       => 'basic',
		                //'ssl_verify_peer' => TRUE,
		                //'ssl_cainfo'      => '/certs/cert.pem'
		                );

		// Run some setup
		$this->rest->initialize($config);

	}
	private function redirectUser($role){
		if ($role == 1) {
			redirect('home/pemilik');
		}
		else if ($role == 2){
			redirect('home/admin');
		}
		else if ($role == 3){
			redirect('home/kasir');
		}
		else if ($role == 4){
			redirect('home/apoteker');
		}
		else if ($role == 5){
			redirect('home/pengadaan');
		}

		// echo json_encode($this->session->userdata('logged_in'));
		// $this->session->sess_destroy();
	}
	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			$role = $this->session->userdata('role');
			$this->redirectUser($role);

		}
		else{
			if ($this->input->server('REQUEST_METHOD') == 'GET')
		   {
		   		$this->load->view('login');
		   }
		else if ($this->input->server('REQUEST_METHOD') == 'POST')
		   {
		   		$this->rest->format('application/json');
				$params['input'] = $this->input->post(NULL,TRUE);
				// $params = $this->input->post('input');
				// $password = $this->input->post('password');
				// $params['username'] = $username;
				// $params['password'] = $password;
				// $params['username'] = $params['name'];
				// $asd = $this->input->post('username');
				// echo json_encode($params);
				$user = $this->rest->post('user/login', $params,'');
				$user = json_decode(json_encode($user), true);
				// $this->rest->debug();
				// // $user = json_decode(json_encode($user));
				// // $user = json_decode($user);
				// // echo $user->data->role;
				if ($user['status']) {
					$role = $user['data']['role'];
					$this->session->set_userdata($user['data']);
					$this->redirectUser($role);
				}
				else{
					redirect('/');
				}
		   }

		}

	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}

	public function view($halaman = 'index'){
		$this->load->view('/'.$halaman);

	}



  	/*function __encrip_password($password) {
        return md5($password);
    }*/


}
