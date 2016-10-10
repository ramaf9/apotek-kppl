<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// import required external library
require_once 'User.php'; // rest_api library

class Apoteker extends User{
    public function __construct() {
    	parent::__construct();
        $data=$this->session->userdata($this->input->get('username'));
        // 4 is code of apoteker role
        if ($data['role'] != 3) {
            $this->response([
                'status' => FALSE,
                'error' => 'No authorization'
            ], REST_Controller::HTTP_FORBIDDEN);
        }
        $this->load->model('obat/Obat_model');
        $this->load->model('obat/Request_obat_model');
    }
    // Retrieve all obat method
    public function obat_get($id_param = NULL){
        $id = $this->input->get('id');
        if($id===NULL){
    		// set $id value as id from parameter
    		$id = $id_param;
    	}
    	/*
            call read method from Obat_model that will get
            all data from database

        */
        $data = $this->Obat_model->read($id);
        // check if $data return true
        if ($data)
        {
            // send success response
            $this->response($data, REST_Controller::HTTP_OK);
        }
        else
        {
            // send failed response
            $this->response([
                'status' => FALSE,
                'error' => 'No obat were found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }

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
    // Send request obat to procurement
    public function request_obat_post(){
        $data = $this->input->post('input');
        // initialize $content with key same as column name
        $content = array(
    		'ro_obat' => $data['obat'],
    		'ro_quantity' => $data['quantity'],
    		'ro_pasien' => $data['pasien'],
            'ro_status' => 0,
            'ro_date' => date("Y/m/d")
    	);
        // call Obat_model method to insert $content
        $this->Request_obat_model->insert($data);
    	// send success response
    	$message = [
    		'status' => TRUE,
    		'message' => 'Request created'
    	];
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
    }
}
