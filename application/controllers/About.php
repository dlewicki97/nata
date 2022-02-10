<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
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
        $data['about'] = $this->back_m->get_all_priority('about', 'active');

        echo loadViewsFront('about', $data);
    }
}