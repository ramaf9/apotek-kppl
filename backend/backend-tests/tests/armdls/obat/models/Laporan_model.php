<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model{
    // Read Query
    public function join_request_o($id){
    	// check if $id param is null
    	if($id===NULL){
    		$replace = "" ;
    	}
    	else{
    		$replace = "=$id";
    	}
    	// query get data $id data from database
    	$query = $this->db->query("select * from request_obat
                                   inner join obat
                                   on request_obat.ro_obat=obat.o_id");
    	// return $query as array
    	return $query->result_array();
    }
    public function join_pengadaan_o($id){
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
                                   on pengadaan_obat.po_obat=obat.o_id");
    	// return $query as array
    	return $query->result_array();
    }
}
