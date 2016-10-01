<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_obat_model extends CI_Model{
    // Read Query
    public function read($id){
    	// check if $id param is null
    	if($id===NULL){
    		$replace = "" ;
    	}
    	else{
    		$replace = "=$id";
    	}
    	// query get data $id data from database
    	$query = $this->db->query("select * from request_obat where ro_id".$replace);
    	// return $query as array
    	return $query->result_array();
    }
    public function insert($data){
    	// query inserting new data to database
    	$this->db->insert('user', $data);
    	return TRUE;
    }
}
