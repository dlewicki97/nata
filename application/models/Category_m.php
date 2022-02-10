<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_m extends CI_Model
{
    public function get_like($like)
    {
        $this->db->select('id, name');
        $this->db->like('name', $like);
        return $this->db->get('products')->result();
    }
}
