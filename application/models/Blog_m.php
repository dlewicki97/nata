<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog_m extends CI_Model
{
    public function get_orderBy_pagging($table, $perPage, $paging = 0)
    {
        $query = @$this->db->get($table, $perPage, $paging);

        return $query->result();
    }
}
