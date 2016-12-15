<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// import required external library
require_once 'User.php'; // rest_api library

class Admin extends User{
    public function __construct() {
    	parent::__construct();
        $data=parent::$token;
        $username = $this->input->get('username');
        //2 is code of admin role
        if (isset($data) && $data != "" && $data->role == 2 && $username == $data->username) {
            $this->load->model('User_model');
        }
        else{
            $this->response([
                'status' => FALSE,
                'error' => 'No authorization'
            ], REST_Controller::HTTP_OK);
        }

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
    			], REST_Controller::HTTP_OK);
    		}
    	}
    	// Server's Post Method
    	public function data_post(){
    		// set $data array from post method
            
    		$data = array(
    			'u_username' => $this->input->post('username'),
    			'u_password' => md5($this->input->post('password')),
    			'u_name' => $this->input->post('name'),
    			'u_email' => $this->input->post('email'),
    			'u_telp' => $this->input->post('telp'),
    			'u_role' => $this->input->post('role')
    		);
            if (count($data) < 6) {
                $message = [
                'status' => FALSE,
                'message' => 'Incomplete data'
                ];
                $this->set_response($message, REST_Controller::HTTP_CREATED);
            }
    		/*
    			call insert method from user_model that will get
    			insert new user to database

    		*/
            if ($this->User_model->check_username($data['u_username'])) {
                $this->User_model->insert($data);

                // send success response
        		$message = [
        			'status' => TRUE,
        			'message' => $data['u_username'].' created'
        		];
        		$this->set_response($message, REST_Controller::HTTP_CREATED);
            }
            else{
                // send error response
        		$message = [
        			'status' => FALSE,
        			'message' => $data['u_username'].' failed to create'
        		];
        		$this->set_response($message, REST_Controller::HTTP_OK);
            }


    	}
    	// Server's Put Method
    	private function data_update($data){
    		// retrieve data from stream
    		// $data = $this->input->input_stream();
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
    			$this->set_response($message, REST_Controller::HTTP_OK);
    		}
    		else{
    			// send success response
    			$message = [
    				'status' => FALSE,
    				'message' => 'No data with specified id'
    			];
    			$this->set_response($message, REST_Controller::HTTP_OK);
    		}


    	}

        public function change_email_put($id=NULL){
            $data['u_email'] = $this->input->input_stream('u_email');
            $data['u_id'] = $id;
            if (!empty($data['u_email']) && $data['u_id'] != NULL) {
               $this->data_update($data);
            }
            else{
                $message = [
                    'status' => FALSE,
                    'message' => 'No email or ID found'
                ];
                $this->set_response($message, REST_Controller::HTTP_OK);
            }
            
        }

        public function banned_user_put($id=NULL){
            $data['u_status'] = "banned";
            $data['u_id'] = $id;
            if (!empty($data['u_status']) && $data['u_id'] != NULL) {
               $this->data_update($data);
            }
            else{
                $message = [
                    'status' => FALSE,
                    'message' => 'No ID found'
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
    			$this->set_response([
    				'status' => TRUE,
    				'error' => 'Delete success'
    			], REST_Controller::HTTP_OK);
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
