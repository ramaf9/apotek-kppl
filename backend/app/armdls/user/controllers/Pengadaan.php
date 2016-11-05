<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// import required external library
require_once 'User.php'; // rest_api library

class Pengadaan extends User{
    public function __construct() {
    	parent::__construct();
        $data=parent::$token;
        $username = $this->input->get('username');
        //5 is code of pengadaan role
        if (isset($data) && $data != "" && $data->role == 5 && $username == $data->username) {
            $this->load->model('obat/Obat_model');
            $this->load->model('obat/Pengadaan_obat_model');
        }
        else{
            $this->response([
                'status' => FALSE,
                'error' => 'No authorization'
            ], REST_Controller::HTTP_FORBIDDEN);
        }

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
    public function obat_post(){
    	// set $data array from post method
    	$data = array(
    		'o_name' => $this->input->post('name'),
    		'o_price' => $this->input->post('price'),
    		'o_unit' => $this->input->post('unit'),
    		'u_quantity' => $this->input->post('quantity')
    	);
    	/*
    		call insert method from Obat_model that will get
    		insert new user to database

    	*/
    	$this->Obat_model->insert($data);
    	// send success response
    	$message = [
    		'status' => TRUE,
    		'message' => $data['o_name'].' created'
    	];
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
    }
    // Server's Delete Method
    public function obat_delete(){
    	// retrieve data from current third segment
    	$id = $this->input->get('id');
    	// check if $id is null
    	if($id===NULL){
    		// send failed response
    		$this->set_response([
    			'status' => FALSE,
    			'error' => 'ID cannot be empty'
    		], REST_Controller::HTTP_NOT_FOUND);
    	}
    	/*
    		call delete method from Obat_model that will remove
    		$id data from database

    	*/
    	$data = $this->Obat_model->delete($id);
    	// check if $data return true
    	if ($data)
    	{
    		// send success response
    		$this->set_response($data, REST_Controller::HTTP_OK);
    	}
    	else
    	{
    		// send failed response
    		$this->set_response([
    			'status' => FALSE,
    			'error' => 'Record could not be found'
    		], REST_Controller::HTTP_NOT_FOUND);
    	}
    }
    // Server method to post pengadaan_obat
    public function pengadaan_obat_post(){
    	// set $data array from post method
    	$data = array(
    		'po_obat' => $data['obat'],
    		'po_quantity' => $data['quantity'],
    		'po_vendor' => $data['pasien'],
            'po_status' => 0,
            'po_date' => date("Y/m/d")
    	);
    	/*
    		call insert method from Obat_model that will get
    		insert new user to database

    	*/
    	$this->Pengadaan_obat_model->insert($data);
    	// send success response
    	$message = [
    		'status' => TRUE,
    		'message' => $data['o_name'].' created'
    	];
    	$this->set_response($message, REST_Controller::HTTP_CREATED);
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
    public function pengadaan_confirm_put(){
        $data = $this->input->input_stream();
        $data['quantity'] = '+'.$data['quantity'];
        $result = $this->Obat_model->update($data);

    	if ($result) {
            $result = $this->Pengadaan_obat_model->update($data['po_id']);
            if ($result) {
                // send success response
        		$message = [
        			'status' => TRUE,
        			'message' => 'pengadaan success'
        		];
        		$this->set_response($message, REST_Controller::HTTP_CREATED);
            }
            else{
                // send failed response
                $message = [
                    'status' => FALSE,
                    'message' => 'pengadaan failed'
                ];
                $this->set_response($message, REST_Controller::HTTP_OK);
            }
    	}
    	else{
    		// send failed response
    		$message = [
    			'status' => FALSE,
    			'message' => 'pengadaan failed'
    		];
    		$this->set_response($message, REST_Controller::HTTP_OK);
    	}
    }

}
