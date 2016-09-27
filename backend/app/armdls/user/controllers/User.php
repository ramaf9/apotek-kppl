<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// import required external library
require_once APPPATH . '/libraries/REST_Controller.php'; // rest_api library

class User extends REST_Controller{
// Load model in constructor
public function __construct() {
	parent::__construct();
	$this->load->model('User_model');
}
// Server's Get Method
public function data_get($id_param = NULL){
	// retrieve data from get method
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
			$id data from database

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
				'error' => 'No users were found'
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
		'u_joindate' => date('y-m-d')
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
	$id = $this->uri->segment(3);
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

// Server's login method
public function login_post(){
	// retrieve login data from post method
	$username = $this->input->post('username');
	$password = $this->input->post('password');
	// initialize empty array
	$message = [];
	// check if $username or $password is null
	if ($username===NULL || $password===NULL ) {
		// set success response
		$message = [
			'status' => FALSE,
			'message' => 'Login failed'
		]
	}
	else{
		/*
		 	call check_password method from user_model that will check
			user's username and password from database

		*/
		$data = $this->User_model->check_password($username,$password);
		// check if $data return true
		if ($data) {
			// set success response
			$message = [
				'status' => TRUE,
				'message' => 'Login success'
			]
		}
		else{
			// set failed response
			$message = [
				'status' => FALSE,
				'message' => 'Login failed'
			]
		}
	}
	// send response
	$this->set_response($message, REST_Controller::HTTP_OK);

}
}
