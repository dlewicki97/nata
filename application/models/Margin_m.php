<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Margin_m extends CI_Model
{
    public function get($price)
    {
        $price = round((float) $price);
        return $this->db->select("*")->from('margin')->where("$price BETWEEN price_from AND price_to")->get()->row();
    }
}