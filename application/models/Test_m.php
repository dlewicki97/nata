<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test_m extends CI_Model
{
    public function get_product_photos()
    {
        return $this->db->select('id, photo, photo_min')->from('products')->get()->result();
    }
}
