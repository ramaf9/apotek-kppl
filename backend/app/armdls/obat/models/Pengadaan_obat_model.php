<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengadaan_obat_model extends CI_Model{
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
        $query = $this->db->query("select * from pengadaan_obat
                                   inner join obat
                                   on pengadaan_obat.po_obat=obat.o_id
                                   where pengadaan_obat.po_id".$replace);
    	// return $query as array
    	return $query->result_array();
    }
    public function insert($data){
    	// query inserting new data to database
    	$this->db->insert('pengadaan_obat', $data);
    	return TRUE;
    }
    public function update($id){
        // $id = $data['id'];
    	// change status value to 1
    	$data['po_status'] = 1;
    	// query update $id data from database
    	$this->db->where('po_id',$id);
    	$query = $this->db->update('pengadaan_obat',$data);
    	// check if query return true
    	if ($query) {
    		return TRUE;
    	}
    	else{
    		return FALSE;
    	}
    }

}
