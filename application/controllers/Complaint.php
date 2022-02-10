<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Complaint extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['lang'])) {
            $_SESSION['lang'] = 'pl';
        }
    }



    public function index()
    {
        $data = loadDefaultDataFront();
        $data['complaint'] = $this->back_m->get_one('complaint', 1);

        echo loadViewsFront('complaint', $data);
    }
}