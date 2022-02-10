<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News_m extends CI_Model
{
    public function get_pagination($page)
    {
        $max = 10;
        if (!$page) $page = 1;

        $this->db->where('active', 1);
        $this->db->order_by('priority', 'asc');
        $this->db->limit($max, $page * $max);
        $query = $this->db->get('news');

        return $query->result();
    }

    public function get_orderBy_pagging($table, $perPage, $paging = 0)
    {
        $this->db->where('active', 1);
        $this->db->order_by('priority', 'asc');
        $query = $this->db->get($table, $perPage, $paging);

        return $query->result();
    }
}