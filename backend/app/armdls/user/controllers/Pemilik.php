<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// import required external library
require_once 'User.php'; // rest_api library

class Pemilik extends User{
    public function __construct() {
    	parent::__construct();
        $data=parent::$token;
        $username = $this->input->get('username');
        //1 is code of pemilik role
        if (isset($data) && $data != "" && $data->role == 1 && $username == $data->username) {
            $this->load->model('obat/Obat_model');
            $this->load->model('obat/Laporan_model');
        }
        else{
            $this->response([
                'status' => FALSE,
                'error' => 'No authorization'
            ], REST_Controller::HTTP_FORBIDDEN);
        }

    }
    // Retrieve all requested obat
    public function laporan_ro_get(){
        $id = $this->input->get('id');
        $data = $this->Laporan_model->join_request_o(NULL);
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
    public function laporan_po_get(){
        $id = $this->input->get('id');
        $data = $this->Laporan_model->join_pengadaan_o(NULL);
        if ($data) {
            // send all requested obat response
            $this->response($data, REST_Controller::HTTP_OK);
        }
        else{
            // send failed response
            $this->response([
                'status' => FALSE,
                'error' => 'No pengadaan were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

}
