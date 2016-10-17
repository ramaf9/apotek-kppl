<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');

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
        if ($this->session->userdata('logged_in') &&
            $this->session->userdata('role') == 3) {

		}
        else{
            redirect('/');
        }
	}
    public function index(){
        $currentuser = $this->session->userdata('username');
        $data['request_obat'] = $this->rest->get('user/kasir/request_obat?username='.$currentuser, '','');
        $data = json_decode(json_encode($data), true);
        $this->load->view('kasir/kasirmenu',$data);
    }

	public function wResep()
	{
        $request = $this->input->server('REQUEST_METHOD');
        switch ($request) {
            case "GET":
                $this->load->view('kasir/denganresep');
                break;
            case "POST":
				$this->rest->format('application/json');
				$params = $this->input->post(NULL,TRUE);
				$currentuser = $this->session->userdata('username');
				$user = $this->rest->post('user/admin/data?username='.$currentuser, $params,'');

				if (isset($user->message)) {
					$data['message'] = $user->message;
				}
				else{
					$data['message'] = $this->rest->debug();
				}

				$this->load->view('kasir/denganresep',$data);
                break;
            default:
                redirect('/');
        }
	}
	public function woResep()
	{
        $request = $this->input->server('REQUEST_METHOD');
        switch ($request) {
            case "GET":
                $this->load->view('kasir/tanparesep');
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

				$this->load->view('kasir/tanparesep',$data);
                break;
            default:
                redirect('/');
        }
	}


  	/*function __encrip_password($password) {
        return md5($password);
    }*/


}
