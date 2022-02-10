<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account_settings extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('client')) {
            $this->session->set_flashdata('flashdata_false', '<p class="text-danger font-weight-bold mb-0">Musisz się zalogować!</p>');
            redirect('logowanie');
        }
    }
    public function index()
    {
        $data = loadDefaultDataFront();
        $data['account_settings_desc'] = $this->back_m->get_one('account_settings_desc', 1);

        echo loadViewsFront('auth/account_settings', $data);
    }

    public function update()
    {
        $client = $this->session->userdata('client');


        if ($_POST['new_password'] !== '') {
            if (strlen($_POST['new_password']) <= 5) {
                $this->session->set_flashdata('validation_false', "<p>Hasło powinno zawierać co najmniej 6 znaków!</p>");
                redirect($_SERVER['HTTP_REFERER']);
            }
            if ($_POST['new_password'] != $_POST['new_password_confirm']) {
                $this->session->set_flashdata('validation_false', "<p>Pola 'Nowe hasło' i 'Potwierdź nowe hasło' muszą być identyczne!</p>");
                redirect($_SERVER['HTTP_REFERER']);
            }
            $password_reset = $this->back_m->get_where('password_resets', 'client_id', $client->id);
            $code = $password_reset->code ?? false;
            if (!password_verify($_POST['old_password'], $client->password) && ($_POST['old_password'] !== $code)) {
                $this->session->set_flashdata('validation_false', "<p>Hasło nieprawidłowe!</p>");
                redirect($_SERVER['HTTP_REFERER']);
            }
            $_POST['password'] = hashPassword($_POST['new_password']);
        }

        unset($_POST['new_password'], $_POST['old_password'], $_POST['email']);
        $this->back_m->update('clients', $_POST, $client->id);
        $this->session->set_userdata('client', $this->back_m->get_one('clients', $client->id));

        foreach (get_object_vars($this->session->userdata('client')) as $key => $value) {
            $_SESSION[$key] = $value;
        }

        $this->session->set_flashdata('flashdata_true', "<p class=\"text-success font-weight-bold mb-0\">Pomyślnie edytowano profil!</p>");
        redirect($_SERVER['HTTP_REFERER']);
    }
}
