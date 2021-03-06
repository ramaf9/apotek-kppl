<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// import required external library
require_once 'User.php'; // rest_api library

class Kasir extends User{
    public function __construct() {
    	parent::__construct();
        $data=parent::$token;
        $username = $this->input->get('username');
        //3 is code of kasir role
        if (isset($data) && $data != "" && $data->role == 3 && $username == $data->username) {
            $this->load->model('obat/Obat_model');
            $this->load->model('obat/Request_obat_model');
        }
        else{
            $this->response([
                'status' => FALSE,
                'error' => 'No authorization'
            ], REST_Controller::HTTP_OK);
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
    public function payment_put(){
        $data = $this->input->input_stream();

        $data['quantity'] = '-'.$data['quantity'];
        $result = $this->Obat_model->update($data);

    	if ($result) {
    		// send success response
            $result = $this->Request_obat_model->update($data['ro_id']);
            if ($result) {
                $message = [
        			'status' => TRUE,
        			'message' => 'payment success'
        		];
        		$this->set_response($message, REST_Controller::HTTP_CREATED);
            }
            else{
                $message = [
        			'status' => FALSE,
        			'message' => 'payment failed'
        		];
        		$this->set_response($message, REST_Controller::HTTP_OK);
            }
    	}
    	else{
    		// send success response
    		$message = [
    			'status' => FALSE,
    			'message' => 'payment failed'
    		];
    		$this->set_response($data, REST_Controller::HTTP_OK);
    	}
    }
}
