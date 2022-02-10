<?php
defined('BASEPATH') or exit('No direct script access allowed');

function validate_register_data()
{
    $CI = &get_instance();

    $CI->form_validation->set_rules('first_name', 'Imię', 'required');
    $CI->form_validation->set_rules('last_name', 'Nazwisko', 'required');
    $CI->form_validation->set_rules('email', 'Adres E-mail', 'required|valid_email');
    $CI->form_validation->set_rules('phone', 'Telefon', 'required');
    $CI->form_validation->set_rules('password', 'Hasło', 'required|min_length[6]');
    $CI->form_validation->set_rules('confirm_password', 'Potwierdź hasło', 'required|matches[password]|min_length[6]');
    $CI->form_validation->set_rules('rodo1', 'Zgoda na przetwarzanie danych osobowych', 'required');
    $CI->form_validation->set_rules('regulation', 'Regulamin sklepu', 'required');

    $CI->form_validation->set_message('required', 'Pole \'{field}\' jest wymagane');
    $CI->form_validation->set_message('alpha', 'Pole \'{field}\' powinno zawierać jedynie znaki alfabetyczne!');
    $CI->form_validation->set_message('valid_email', 'Pole \'{field}\' powinno być zgodne z formą adresu e-mailowego!');
    $CI->form_validation->set_message('numeric', 'Pole \'{field}\' powinno zawierać jedynie znaki numeryczne!');
    $CI->form_validation->set_message('alpha_numeric', 'Pole \'{field}\' powinno zawierać jedynie znaki alfanumeryczne!');
    $CI->form_validation->set_message('regex_match', 'Pole \'{field}\' powinno spełniać wzór \'{param}\'!');
    $CI->form_validation->set_message('matches', 'Pole \'{field}\' powinno być identyczne jak \'{param}\'!');
    $CI->form_validation->set_message('min_length', 'Pole \'{field}\' powinno zawierać minimum \'{param}\' znaków!');


    return $CI->form_validation->run() == TRUE;
}

function prepare_inputs_flashdata()
{
    $CI = &get_instance();
    foreach ($_POST as $key => $value) {
        $CI->session->set_flashdata($key, $value);
    }
}

function create_new_user($data)
{
    $CI = &get_instance();


    $_POST['rodo1'] = $CI->input->post('rodo1') != null ? 1 : 0;
    $_POST['rodo2'] = $CI->input->post('rodo2') != null ? 1 : 0;
    $_POST['regulation'] = $CI->input->post('regulation') != null ? 1 : 0;
    unset($_POST['confirm_password']);
    $_POST['password'] = hashPassword($_POST['password']);
    $insert = $CI->back_m->insert('clients', $_POST);

    if ($insert) {
        $last_id = $CI->db->insert_id();
        $client = $CI->back_m->get_one('clients', $last_id);
        $secret_key = md5($client->id . '|' . $client->email . '|' . $client->created);
        $CI->back_m->update('clients', ['secret_key' => $secret_key], $client->id);

        sendActive($_POST['first_name'], $_POST['email'], $secret_key);
        redirect($_SERVER['HTTP_REFERER']);
    }
}
