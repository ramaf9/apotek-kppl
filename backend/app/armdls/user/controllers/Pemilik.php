<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// import required external library
require_once 'User.php'; // rest_api library

class Pemilik extends User{
    public function __construct() {
    	parent::__construct();
        $data=$this->session->userdata($this->input->get('username'));
        // 1 is code of pemilik role
        if ($data['role'] != 1) {
            $this->response([
                'status' => FALSE,
                'error' => 'No authorization'
            ], REST_Controller::HTTP_FORBIDDEN);
        }
        $this->load->model('obat/Obat_model');
        $this->load->model('obat/Request_obat_model');
        $this->load->model('obat/Pengadaan_obat_model');
    }
    // Retrieve all requested obat
    public function request_obat_get(){
        $id = $this->input->get('id');
        $data = $this->Request_obat_model->read($id);
        if ($data) {
            // send all requested obat response
            $this->response($data, REST_Controller::HTTP_OK);
        }
        else{
            // send failed response
            $this->response([
                'status' => FALSE,
                'error' => 'No request were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function pengadaan_obat_get(){
        $id = $this->input->get('id');
        $data = $this->Pengadaan_obat_model->read($id);
        if ($data) {
            // send all requested obat response
            $this->response($data, REST_Controller::HTTP_OK);
        }
        else{
            // send failed response
            $this->response([
                'status' => FALSE,
                'error' => 'No request were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

}
