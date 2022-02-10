<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function index()
    {
        $data = loadDefaultDataFront();
        $data['auth_desc'] = $this->back_m->get_one('auth_desc', 1);

        echo loadViewsFront('auth/register_form', $data);
    }

    public function activate_user($secret_key)
    {
        $client = $this->back_m->get_where('clients', 'secret_key', $secret_key);
        $this->back_m->update('clients', ['active' => 1], $client->id);

        $this->session->set_flashdata('flashdata_true', '<p class="text-success font-weight-bold mb-0">Aktywowano konto! Teraz możesz się zalogować!</p>');

        redirect('logowanie');
    }

    public function create_user()
    {
        $this->load->helper('captcha_secret');

        if (!verifyCaptcha(get_captcha_secret(), $_POST['token'], $_SERVER['REMOTE_ADDR'])) {
            $this->session->set_flashdata('validation_false', "<p>Wykryto złośliwe oprogramowanie!</p>");
            redirect($_SERVER['HTTP_REFERER']);
        }

        $this->load->helper('auth/register');
        $client = $this->back_m->get_where('clients', 'email', $_POST['email']);

        if ($client) {
            $this->session->set_flashdata('validation_false', "<p>Użytkownik o adresie '$client->email' już istnieje!</p>");
            redirect($_SERVER['HTTP_REFERER']);
        }

        if (!validate_register_data()) {
            $this->session->set_flashdata('validation_false', validation_errors());
            prepare_inputs_flashdata();
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            unset($_POST['token']);
            create_new_user($_POST);
        }
    }
}