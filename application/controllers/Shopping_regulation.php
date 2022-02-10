<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shopping_regulation extends CI_Controller
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
        $data['shopping_regulation'] = $this->back_m->get_one('shopping_regulation', 1);

        echo loadViewsFront('shopping_regulation', $data);
    }
}