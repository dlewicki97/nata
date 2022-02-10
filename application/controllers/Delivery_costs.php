<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Delivery_costs extends CI_Controller
{
    public function index()
    {
        $data = loadDefaultDataFront();
        $data['delivery_costs'] = $this->back_m->get_one('delivery_costs', 1);

        echo loadViewsFront('delivery_costs', $data);
    }
}