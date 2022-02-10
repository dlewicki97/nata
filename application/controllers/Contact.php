<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{

    public function index()
    {
        clean_search();
        $data = loadDefaultDataFront();
        $data['contact_icons'] = $this->back_m->get_all('contact_icons');
        $data['contact_desc'] = $this->back_m->get_one('contact_desc', 1);

        echo loadViewsFront('contact', $data);
    }
}