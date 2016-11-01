<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');

		// Load the rest client spark
		// $this->load->spark('restclient/2.2.1')

		// Set config options (only 'server' is required to work)



		// Run some setup

        if ($this->session->userdata('logged_in') &&
            $this->session->userdata('role') == 2) {
				$config = array('server'            => rest_url,
				                'api_key'         => 'Bearer '.$this->session->userdata['token'],
				                'api_name'        => 'Authorization'
				                //'http_user'       => 'username',
				                //'http_pass'       => 'password',
				                //'http_auth'       => 'basic',
				                //'ssl_verify_peer' => TRUE,
				                //'ssl_cainfo'      => '/certs/cert.pem'
				                );
				$this->rest->initialize($config);

		}
        else{
            redirect('/');
        }
	}
	public function index(){
		$this->load->view('template/header');
		$this->load->view('admin/adminview');
		$this->load->view('template/footer');
	}

	public function addUser()
	{
        $request = $this->input->server('REQUEST_METHOD');
        switch ($request) {
            case "GET":
            	$this->load->view('template/header');
                $this->load->view('admin/adduserview');
                $this->load->view('template/footer');
                break;
            case "POST":
				$this->rest->format('application/json');
				$params = $this->input->post(NULL,TRUE);
				$currentuser = $this->session->userdata('username');
				$user = $this->rest->post('user/admin/data?username='.$currentuser, $params,'');

				// if (isset($user->message)) {
				// 	$data['message'] = $user->message;
				// }
				// else{
				// 	$data['message'] = $this->rest->debug();
				// }
				//
				// $this->load->view('admin/adduserview',$data);
				$this->rest->debug();
                break;
            default:
                redirect('/');
        }
	}
	public function delUser()
	{
        $request = $this->input->server('REQUEST_METHOD');
        switch ($request) {
            case "GET":
            	$this->load->view('template/header');
                $this->load->view('admin/deluserview');
                $this->load->view('template/footer');
                break;
            case "POST":
				$this->rest->format('application/json');
				$params = $this->input->post(NULL,TRUE);
				$currentuser = $this->session->userdata('username');
				$user = $this->rest->delete('user/admin/data?username='.$currentuser
						.'&id='.$params['id'],'','');

				if (isset($user->message)) {
					$data['message'] = $user->message;
				}
				else{
					$data['message'] = $this->rest->debug();
				}
				$this->load->view('template/header');
				$this->load->view('admin/deluserview',$data);
				$this->load->view('template/footer');
                break;
            default:
                redirect('/');
        }
	}


  	/*function __encrip_password($password) {
        return md5($password);
    }*/


}
