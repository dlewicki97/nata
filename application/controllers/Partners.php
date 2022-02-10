<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Partners extends CI_Controller
{

    public function index()
    {
        clean_search();
        $data = loadDefaultDataFront();
        $data['partners'] = $this->back_m->get_all_priority('partners', 'active');

        echo loadViewsFront('partners', $data);
    }
}