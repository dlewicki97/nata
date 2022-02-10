<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wholesale_offer extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['lang'])) {
            $_SESSION['lang'] = 'pl';
        }
        clean_search();
    }



    public function index()
    {
        $data = loadDefaultDataFront();
        $data['wholesale_offer'] = $this->back_m->get_one('wholesale_offer', 1);

        echo loadViewsFront('wholesale_offer', $data);
    }
}