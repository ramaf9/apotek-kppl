<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// import required external library
require_once APPPATH . '/libraries/REST_Controller.php'; // rest_api library

class User extends REST_Controller{
	static protected $token = "";

	// Load model in constructor
	public function __construct() {
		parent::__construct();
		$token = $this->input->get_request_header('Authorization', TRUE);
		if ($token) {
			$token = explode("Bearer ", $token);
			User::$token = $this->jwt->decode($token[1],secret);
		}
		$token = NULL;
		$this->load->model('User_model');
	}
	// Server's login method
	public function login_post(){
		//retrieve login data from post method
		$data = $this->input->post('input');
		$username = $data['username'];
		$password = $data['password'];
		// initialize empty array
		$message = [];
		// check if $username or $password is null
		if ($username===NULL || $password===NULL ) {
			// set success response
			$message = [
				'status' => FALSE,
				'message' => 'Tidak ada id dan password'
			];
		}
		else{
			/*
			 	call check_password method from user_model that will check
				user's username and password from database

			*/
			$data = $this->User_model->check_password($username,$password);
			// check if $data return true
			if ($data) {
				$newdata = array(
			        'username'  => $data[0]['u_name'],
			        'email'     => $data[0]['u_email'],
					'role'		=> $data[0]['u_role'],
			        'logged_in' => TRUE,
				);
				$token = $this->jwt->encode($newdata,secret);
				$newdata['token'] = $token;

				$this->session->set_userdata($newdata['username'],$newdata);
				// set success response
				$message = [
					'status' => TRUE,
					'message' => 'Login success'
				];
				$message['data'] = $newdata;
				// array_push($message,$newdata);
			}
			else{
				// set failed response
				$message = [
					'status' => FALSE,
					'message' => 'Login failed'
				];
			}
		}
		// send response
		// $message = apache_request_headers();
		$this->set_response($message, REST_Controller::HTTP_OK);

	}
	public function logout_post(){
		$username = $this->input->post('username');
		$this->session->unset_userdata($username);
		$message = [
			'status' => TRUE,
			'message' => 'Logout success'
		];
		// send response
		$this->set_response($message, REST_Controller::HTTP_OK);

	}
}
