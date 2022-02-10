<?php
defined('BASEPATH') or exit('No direct script access allowed');

class My_orders extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['lang'])) {
            $_SESSION['lang'] = 'pl';
        }
        if (!$this->session->userdata('client')) {
            $this->session->set_flashdata('flashdata_false', '<p class="text-danger font-weight-bold mb-0">Musisz się zalogować!</p>');
            redirect('logowanie');
        }
        clean_search();
    }
    public function test()
    {
        $set = 0;
        $set ?? $dupa = "xd";
        echo $dupa;
    }
    public function index()
    {
        $this->load->helper('transaction_status');
        $this->load->helper('transaction_delivery');
        $data = loadDefaultDataFront();
        $data['my_orders_desc'] = $this->back_m->get_one('my_orders_desc', 1);
        $data['transactions'] = $this->back_m->get_all_where('transaction', 'client_id', $this->session->userdata('client')->id, 'desc');

        echo loadViewsFront('my_orders', $data);
    }
}