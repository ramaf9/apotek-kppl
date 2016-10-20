<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengadaan extends CI_Controller {
    private $currentuser = "";
	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');

		// Load the rest client spark
		// $this->load->spark('restclient/2.2.1');

		// Load the library
		$this->load->library('rest');

		// Set config options (only 'server' is required to work)

        if ($this->session->userdata('logged_in') &&
            $this->session->userdata('role') == 5) {
                $this->currentuser = $this->session->userdata('username');
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
        $data['obat'] = $this->rest->get('user/pengadaan/obat?username='.$this->currentuser, '','');
        $data['obat'] = json_decode(json_encode($data['obat']), true);
        // echo json_encode($data);
        // $this->rest->debug();
        $this->load->view('pengadaan/pengadaanview',$data);
    }

	public function Obat()
	{
        $request = $this->input->server('REQUEST_METHOD');
        $id = $this->input->get('id');
        $data = $this->rest->get('user/kasir/request_obat?username='.$this->currentuser
                                .'&id='.$id, '','');
        $data = json_decode(json_encode($data[0]), true);
        $data['price'] = $data['ro_quantity']*$data['o_price'];
        switch ($request) {
            case "GET":
                // echo json_encode($data[0]);
                $this->load->view('kasir/withresepview',$data);
                // $this->rest->debug();
                break;
            case "POST":
				$this->rest->format('application/json');
				$params = $this->input->post(NULL,TRUE);
				$currentuser = $this->session->userdata('username');
                // echo json_encode($data);
				$user = $this->rest->put('user/kasir/payment?username='.$this->currentuser
                                        .'&quantity='.$data['ro_quantity'].'&ro_id='.$data['ro_id']
                                        .'&o_id='.$data['o_id'].'', '','');

				if (isset($user->message)) {
					$data['message'] = $user->message;
				}
				else{
					$data['message'] = $this->rest->debug();
				}

				$this->load->view('kasir/withresepview',$data);
                // $this->rest->debug();
                break;
            default:
                redirect('/');
        }
	}



  	/*function __encrip_password($password) {
        return md5($password);
    }*/


}
