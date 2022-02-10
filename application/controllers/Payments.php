<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payments extends CI_Controller
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
        $data['payments'] = $this->back_m->get_all('payments');

        echo loadViewsFront('payments', $data);
    }
}