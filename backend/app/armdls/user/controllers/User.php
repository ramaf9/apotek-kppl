<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller{
// Load model in constructor
public function __construct() {
	parent::__construct();
	$this->load->model('User_model');
}
// Server's Get Method
public function data_get($id_param = NULL){
	$id = $this->input->get('id');
	if($id===NULL){
		$id = $id_param;
	}
	if ($id === NULL)
	{
		$data = $this->User_model->read($id);
		if ($data)
		{
			$this->response($data, REST_Controller::HTTP_OK);
		}
		else
		{
			$this->response([
			'status' => FALSE,
			'error' => 'No users were found'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}
	$data = $this->User_model->read($id);
	if ($data)
	{
		$this->set_response($data, REST_Controller::HTTP_OK);
	}
	else
	{
		$this->set_response([
		'status' => FALSE,
		'error' => 'Record could not be found'
		], REST_Controller::HTTP_NOT_FOUND);
	}
}
// Server's Post Method
public function data_post(){
	$data = array(
		'u_username' => $this->input->post('username'),
		'u_password' => $this->input->post('upassword'),
		'u_joindate' => date('y-m-d')
	);

	if ($data['u_username']==) {
		# code...
	}
	$this->User_model->insert($data);
	$message = [
		'status' => TRUE,
		'message' => $data['u_username'].' created'
	];
	$this->set_response($message, REST_Controller::HTTP_CREATED);
}
// Server's Put Method
public function data_put(){
	$data = $this->input->input_stream();
	$this->User_model->update($data);
	$message = [
		'status' => TRUE,
		'message' => $data['u_username'].' updated'
	];
	$this->set_response($message, REST_Controller::HTTP_CREATED);
}
// Server's Delete Method
public function data_delete(){
	$id = $this->uri->segment(3);
	if($id===NULL){
		$this->set_response([
			'status' => FALSE,
			'error' => 'ID cannot be empty'
		], REST_Controller::HTTP_NOT_FOUND);
	}
	$data = $this->User_model->delete($id);
	if ($data)
	{
		$this->set_response($data, REST_Controller::HTTP_OK);
	}
	else
	{
		$this->set_response([
			'status' => FALSE,
			'error' => 'Record could not be found'
		], REST_Controller::HTTP_NOT_FOUND);
	}
}

public function login_post(){
	$username = $this->input->post('username');
	$password = $this->input->post('password');
	$message = [];

	if ($id===NULL || $pass===NULL ) {
		# code...
	}
	$data = $this->User_model->check_password($username,$password);
	if ($data) {
		$message = [
			'status' => TRUE,
			'message' => 'Login success'
		]
	}
	else{
		$message = [
			'status' => FALSE,
			'message' => 'Login failed'
		]
	}
	$this->set_response($message, REST_Controller::HTTP_OK);

}
}
