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
			redirect('pemilik');
		}
		else if ($role == 2){
			redirect('admin');
		}
		else if ($role == 3){
			redirect('kasir');
		}
		else if ($role == 4){
			redirect('apoteker');
		}
		else if ($role == 5){
			redirect('pengadaan');
		}
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
				$user = $this->rest->post('user/login', $params,'');
				$user = json_decode(json_encode($user), true);
				if ($user['status']) {
					$role = $user['data']['role'];
					$this->session->set_userdata($user['data']);
					$this->redirectUser($role);
				}
				else{
					$message = "User/password salah";
					echo "<script type='text/javascript'>alert('$message');</script>";
					//redirect('/');
					$this->load->view('login');
				}
		   }

		}

	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('');
	}

	public function view($halaman = 'index'){
		$this->load->view('/'.$halaman);

	}
	public function debug(){

		$this->load->view('header');
		$this->load->view('dashboard');
		$this->load->view('footer');
	}

}
