<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{
// Read Query
public function read($id){
	if($id===NULL){
		$replace = "" ;
	}
	else{
		$replace = "=$id";
	}

	$query = $this->db->query("select * from user where u_id".$replace);
	return $query->result_array();
}
// Insert/Create Query
public function insert($data){
	$this->db->insert('user', $data);
	return TRUE;
}
// Delete Query
public function delete($id){
	$query = $this->db->query("delete from user where u_id=$id");
	return TRUE;
}
// Update Query
public function update($data){
	$id= $data['id'];
	$this->db->where('u_id',$id);
	$this->db->update('user',$data);
}
public function check_username($username){
	if($username===NULL){
		$replace = "" ;
	}
	else{
		$replace = "=$username";
	}

	$query = $this->db->query("select * from user where u_username".$replace);
	if ($query->num_rows() > 0) {
		return FALSE;
	}
	else{
		return TRUE;
	}
}
public function check_password($username,$password){
	$query = $this->db->query("select * from user where u_username".$replace." AND u_password=".$password);
	if ($query->num_rows() != 1) {
		return FALSE;
	}
	else{
		return TRUE;
	}
}
}
