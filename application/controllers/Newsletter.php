<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Newsletter extends CI_Controller
{

    public function send()
    {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $this->session->set_flashdata('flashdata_false', '<p class="text-danger font-weight-bold mb-0">Niepoprawny email!</p>');
            redirect($_SERVER['HTTP_REFERER']);
        }
        if ($this->back_m->get_where('newsletter_subscribers', 'email', $_POST['email'])) {
            $this->session->set_flashdata('flashdata_false', '<p class="text-danger font-weight-bold mb-0">Taki email już jest subskrybentem!</p>');
            redirect($_SERVER['HTTP_REFERER']);
        }
        $this->back_m->insert('newsletter_subscribers', ['email' => $_POST['email']]);
        $this->session->set_flashdata('flashdata_true', '<p class="text-success font-weight-bold mb-0">Pomyślnie zapisano do newslettera!</p>');
        redirect($_SERVER['HTTP_REFERER']);
    }
}