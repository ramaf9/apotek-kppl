<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat_model extends CI_Model{
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
    	$query = $this->db->query("select * from obat where o_id".$replace);
    	// return $query as array
    	return $query->result_array();
    }
    public function insert($data){
    	// query inserting new data to database
    	$this->db->insert('obat', $data);
    	return TRUE;
    }
    // Delete Query
    public function delete($id){
    	// query delete $id data from database
    	$query = $this->db->query("delete from obat where o_id=$id");
    	return TRUE;
    }
    // Update Query
    public function update($data){
    	// set $id from $data array
    	$id= $data['o_id'];
    	// query update $id data from database
        $this->db->set('o_quantity', 'o_quantity + ' . (int) $data['quantity'], FALSE);
    	$this->db->where('o_id',$id);
        $data = [];
    	$query = $this->db->update('obat',$data);
    	// check if query return true
    	if ($query) {
    		return TRUE;
    	}
    	else{
    		return FALSE;
    	}
    }
}
