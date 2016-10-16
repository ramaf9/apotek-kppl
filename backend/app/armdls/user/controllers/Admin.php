<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// import required external library
require_once 'User.php'; // rest_api library

class Admin extends User{
    public function __construct() {
    	parent::__construct();
        $data=$this->session->userdata($this->input->get('username'));
        // 2 is code of admin role
        if (isset($data) && $data['role'] != 2) {
            $this->response([
                'status' => FALSE,
                'error' => 'No authorization'
            ], REST_Controller::HTTP_FORBIDDEN);
        }
        $this->load->model('User_model');

    }
    // Server's Get Method
    	protected function data_get($id_param = NULL){
    		// retrieve data from get method
    		$role=3;
    		$id = $this->input->get('id');
    		// check if $id is null
    		if($id===NULL){
    			// set $id value as id from parameter
    			$id = $id_param;
    		}
    		// check if $id is still null
    		if ($id === NULL)
    		{
    			/*
    			 	call read method from user_model that will get
    				all data from database

    			*/
    			$data = $this->User_model->read($id);
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
    					'error' => 'No users were found'.$role
    				], REST_Controller::HTTP_NOT_FOUND);
    			}
    		}
    		/*
    			call read method from user_model that will get
    			$id user data from database

    		*/
    		$data = $this->User_model->read($id);
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
    	// Server's Post Method
    	public function data_post(){
    		// set $data array from post method
    		$data = array(
    			'u_username' => $this->input->post('username'),
    			'u_password' => $this->input->post('password'),
    			'u_name' => $this->input->post('name'),
    			'u_email' => $this->input->post('email'),
    			'u_telp' => $this->input->post('telp'),
    			'u_role' => $this->input->post('role')
    		);
    		/*
    			call insert method from user_model that will get
    			insert new user to database

    		*/
    		$this->User_model->insert($data);
    		// send success response
    		$message = [
    			'status' => TRUE,
    			'message' => $data['u_username'].' created'
    		];
    		$this->set_response($message, REST_Controller::HTTP_CREATED);
    	}
    	// Server's Put Method
    	public function data_put(){
    		// retrieve data from stream
    		$data = $this->input->input_stream();
    		/*
    			call update method from user_model that will update
    			$id user data from database

    		*/
    		$data = $this->User_model->update($data);

    		if ($data) {
    			// send success response
    			$message = [
    				'status' => TRUE,
    				'message' => 'update success'
    			];
    			$this->set_response($message, REST_Controller::HTTP_CREATED);
    		}
    		else{
    			// send success response
    			$message = [
    				'status' => FALSE,
    				'message' => 'update failed'
    			];
    			$this->set_response($message, REST_Controller::HTTP_OK);
    		}


    	}
    	// Server's Delete Method
    	public function data_delete(){
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
    			call delete method from user_model that will remove
    			$id data from database

    		*/
    		$data = $this->User_model->delete($id);
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


}
