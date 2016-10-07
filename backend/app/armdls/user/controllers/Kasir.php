<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// import required external library
require_once 'User.php'; // rest_api library

class Apoteker extends User{
    public function __construct() {
    	parent::__construct();
        $data=$this->session->userdata($this->input->get('username'));
        // 3 is Kasir role
        if ($data['role'] != 3) {
            $this->response([
                'status' => FALSE,
                'error' => 'No authorization'
            ], REST_Controller::HTTP_FORBIDDEN);
        }
        $this->load->model('obat/Obat_model');
    }
    // Retrieve all requested obat
    public function request_obat_get(){
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
    public function payment_put(){
        $data = $this->input->input_stream();

        $data = $this->Obat_model->update($data);

    	if ($data) {
    		// send success response
    		$message = [
    			'status' => TRUE,
    			'message' => 'payment success'
    		];
    		$this->set_response($message, REST_Controller::HTTP_CREATED);
    	}
    	else{
    		// send success response
    		$message = [
    			'status' => FALSE,
    			'message' => 'payment failed'
    		];
    		$this->set_response($message, REST_Controller::HTTP_OK);
    	}
    }
}
