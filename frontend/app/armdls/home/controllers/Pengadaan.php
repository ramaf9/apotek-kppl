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
				                'api_name'        => 'authorization'
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
        $data['pengadaan_obat'] = $this->rest->get('user/pengadaan/pengadaan_obat?username='.$this->currentuser, '','');
        $data['pengadaan_obat'] = json_decode(json_encode($data['pengadaan_obat']), true);
        // echo json_encode($data);
        // $this->rest->debug();
        $this->load->view('template/header');
        $this->load->view('pengadaan/pengadaanview',$data);
        $this->load->view('template/footer');
    }

    public function Vendor()
    {
        $request = $this->input->server('REQUEST_METHOD');
        $id = $this->input->get('id');
        $data = $this->rest->get('user/kasir/pengadaan_obat?username='.$this->currentuser
                                .'&id='.$id, '','');
        $data = json_decode(json_encode($data[0]), true);
        // $data['price'] = $data['ro_quantity']*$data['o_price'];
        switch ($request) {
            case "GET":
                // echo json_encode($data[0]);
                $this->load->view('template/header');
                $this->load->view('pengadaan/pengadaanview',$data);
                $this->load->view('template/footer');
                // $this->rest->debug();
                break;
            case "POST":
                $this->rest->format('application/json');
                $params = $this->input->post(NULL,TRUE);
                $currentuser = $this->session->userdata('username');
                // echo json_encode($data);
                $user = $this->rest->put('user/pengadaan/add?username='.$this->currentuser
                                        .'&quantity='.$data['ro_quantity'].'&po_id='.$data['po_id']
                                        .'&po_vendor='.$data['po_vendor'].'', '','');

                if (isset($user->message)) {
                    $data['message'] = $user->message;
                }
                else{
                    $data['message'] = $this->rest->debug();
                }
                $this->load->view('template/header');
                $this->load->view('pengadaan/pengadaanview',$data);
                $this->load->view('template/footer');
                // $this->rest->debug();
                break;
            default:
                redirect('/');
        }
    }

}