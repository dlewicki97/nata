<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_m extends CI_Model  
{
	public function discount($table, $code) {
    	$this->db->where('active', 1);
    	$this->db->where('discount_code', $code);
    	$this->db->where('code_start <=', date('Y-m-d'));
    	$this->db->where('code_end >=', date('Y-m-d'));
        $query = $this->db->get($table);
        return $query->row();
    }
}