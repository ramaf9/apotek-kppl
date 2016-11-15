<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apoteker extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');

		// Load the rest client spark
		// $this->load->spark('restclient/2.2.1')

		// Set config options (only 'server' is required to work)

        if ($this->session->userdata('logged_in') &&
            $this->session->userdata('role') == 4) {
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

        $this->load->model('Apoteker_models');
	}
	public function index(){
		$data['Apoteker'] = $this->Apoteker_models->get_obat;
		$this->load->view('view/login', $data);
		echo 'test';
	}

	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('Id', 'Id', 'required');
		$this->form_validation->set_rules('obat', 'obat', 'required');
		$this->form_validation->set_rules('kategori', 'kategori', 'required');
		$this->form_validation->set_rules('stock', 'stock', 'required');

		if($this->form_validation->run(); == FALSE){

			$this->load->view('Apoteker/formInputObat');
		}

		else{
			$this->Apoteker_models->set_obat;
			redirect('Apoteker');
		}

		

	}
	public function delete_obat()
	{

	}


  	/*function __encrip_password($password) {
        return md5($password);
    }*/


}
