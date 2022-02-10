<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Password_reset extends CI_Controller
{

    public function index()
    {
        $data = loadDefaultDataFront();
        $data['password_reset_desc'] = $this->back_m->get_one('password_reset_desc', 1);

        echo loadViewsFront('auth/password_reset', $data);
    }

    public function reset()
    {
        $email = $_POST['email'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->session->set_flashdata('validation_false', "<p>Niepoprawny adres email!</p>");
            redirect($_SERVER['HTTP_REFERER']);
        }

        $client = $this->back_m->get_where('clients', 'email', $email);

        if (!$client) {
            $this->session->set_flashdata('validation_false', "<p>Użytkownik o adresie '$email' nie istnieje!</p>");
            prepare_inputs_flashdata();
            redirect($_SERVER['HTTP_REFERER']);
        }

        $this->load->helper('string');
        $new_password = random_string("alnum", 8);

        $password_reset = $this->back_m->get_where('password_resets', 'client_id', $client->id);
        if ($password_reset) {
            $this->back_m->update('password_resets', ['code' => $new_password], $password_reset->id);
        } else {
            $this->back_m->insert('password_resets', ['client_id' => $client->id, 'code' => $new_password]);
        }


        send_custom_email(['new_password' => $new_password], 'reset_password', $email, 'resetowanie hasła');

        $this->session->set_flashdata('flashdata_true', "<p class=\"text-success font-weight-bold mb-0\">Wysłano nowe hasło na '$email'</p>");

        redirect('logowanie');
    }
}