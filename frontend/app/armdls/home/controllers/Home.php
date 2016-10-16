<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
    	$this->load->model('home_models');
		    	// Load the rest client spark
		// $this->load->spark('restclient/2.2.1');

		// Load the library
		$this->load->library('rest');

		// Set config options (only 'server' is required to work)

		$config = array('server'            => 'http://localhost/APOTEK-KPPL/backend',
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

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			$role = $this->session->userdata('role');
			if ($role == 1) {
				# code...
			}
			else if ($role == 2){
				$this->load->view('admin/adminview');
			}
			else if ($role == 3){
				$this->load->view('kasir/kasirmenu');
			}
			else if ($role == 4){

			}
			else if ($role == 5){
				$this->load->view('pengadaan/pengadaanview');
			}

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
					if ($role == 1) {
						# code...
					}
					else if ($role == 2){
						$this->load->view('admin/adminview');
					}
					else if ($role == 3){
						$this->load->view('kasir/kasirmenu');
					}
					else if ($role == 4){

					}
					else if ($role == 5){
						$this->load->view('pengadaan/pengadaanview');
					}

					$this->session->set_userdata($user['data']);
					// echo json_encode($this->session->userdata('logged_in'));
					// $this->session->sess_destroy();
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


  	/*function __encrip_password($password) {
        return md5($password);
    }*/


}
