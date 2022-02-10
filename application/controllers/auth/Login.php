<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function index()
    {
        $data = loadDefaultDataFront();
        $data['auth_desc'] = $this->back_m->get_one('auth_desc', 1);

        echo loadViewsFront('auth/login_form', $data);
    }

    public function sign_in()
    {
        $this->load->helper('auth/register');
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
        } else {
            $password_reset = $this->back_m->get_where('password_resets', 'client_id', $client->id);
            $code = $password_reset->code ?? false;
            if (password_verify($_POST['password'], $client->password) || ($_POST['password'] === $code)) {
                if (!$client->active) {
                    $this->session->set_flashdata('validation_false', "<p>Proszę aktywować konto!</p>");
                    prepare_inputs_flashdata();
                    redirect($_SERVER['HTTP_REFERER']);
                }
                $this->session->set_userdata('client', $client);
                foreach (get_object_vars($client) as $key => $value) {
                    $_SESSION[$key] = $value;
                }
                $this->session->set_flashdata('flashdata_true', '<p class="text-success font-weight-bold mb-0">Pomyślnie zalogowano!</p>');
                redirect('/');
            } else {
                prepare_inputs_flashdata();
                $this->session->set_flashdata('validation_false', "<p>Nieprawidłowe hasło!</p>");
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
}