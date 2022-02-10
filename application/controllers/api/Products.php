<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('products_m');
    }

    public function search_panel()
    {
        echo json_encode($this->products_m->get_like($_POST['search'], $_POST['limit'] ?? 15));
    }
}