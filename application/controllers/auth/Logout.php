<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{
    public function index()
    {
        foreach (get_object_vars($this->session->userdata('client')) as $key => $value) {
            unset($_SESSION[$key]);
        }
        $this->session->unset_userdata('client');

        redirect($_SERVER['HTTP_REFERER']);
    }
}