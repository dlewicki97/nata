<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics_m extends CI_Model  
{

    public function get_by_filtr($table, $post) {
        $this->db->like('created', $post, 'after');
        $query = $this->db->get($table);
        return $query->result();
    }  

    public function get_disctinct($table, $distinct) {
		$this->db->group_by($distinct);
		$this->db->order_by($distinct, "desc");
        $query = $this->db->get($table);
        return $query->result();
    }  

    public function get_disctinct_by_filtr($table, $distinct, $post) {
		$this->db->group_by($distinct);
		$this->db->order_by($distinct, "desc");
        $this->db->like('created', $post, 'after');
        $query = $this->db->get($table);
        return $query->result();
    } 

    public function get_all_email($table, $email) {
        $this->db->where(['email' => $email]);
        $query = $this->db->get($table);
        return $query->result();
    } 

    public function get_by_email($table, $email, $post = '') {
        $this->db->where(['email' => $email]);
        $this->db->like('created', $post, 'after');
        $query = $this->db->get($table);
        return $query->result();
    }   

    public function get_by_email_one($table, $email) {
        $this->db->where(['email' => $email]);
        $query = $this->db->get($table);
        return $query->row();
    }  

    public function get_amount($table, $email) {
        $this->db->where('email', $email);
        if (isset($_SESSION['date']) && $_SESSION['date'] != '') {
			$this->db->like('created', $_SESSION['date'], 'after');
        }
        $query = $this->db->get($table);
        return $query->result();
    }  

    public function get_mounth() {
        $query = $this->db->query('SELECT DISTINCT MONTH(`created`) AS `month`, YEAR(`created`) AS `year` FROM transaction');
        return $query->result();
    }  
}