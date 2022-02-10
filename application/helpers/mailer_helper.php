<?php defined('BASEPATH') or exit('No direct script access allowed');

function sendActive($name, $email, $secret_key)
{
    require 'application/libraries/mailer/config.php';
    require 'application/libraries/mailer/functions.php';
    require 'application/libraries/mailer/PHPMailerAutoload.php';
    $CI = &get_instance();
    $data['contact'] = $CI->back_m->get_one('contact_settings', 1);
    $data['settings'] = $CI->back_m->get_one('settings', 1);

    $_POST['base_url'] = base_url();
    $_POST['secret_key'] = $secret_key;
    $_POST['name'] = $name;
    $_POST['company'] = $data['contact']->company;
    $_POST['logo'] = $data['settings']->logo_mail;

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = $cfg['smtp_host'];
    $mail->SMTPAuth = true;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Username = $cfg['smtp_user'];
    $mail->Password = $cfg['smtp_pass'];
    $mail->Port = $cfg['smtp_port'];
    $mail->setFrom($cfg['smtp_user'], $data['contact']->company .  ' - aktywacja konta');
    $mail->AddBCC($email);
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $data['contact']->company .  ' - aktywacja konta';
    $mail->Body    = build_mail_body($_POST, 'active_account.php');
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        exit;
    } else {
        $CI->session->set_flashdata('flashdata_true', '<p class="text-success font-weight-bold mb-0">Pomyślnie utworzono konto, wysłano link aktywacyjny na podany adres e-mail!</p>');
    }
}

function send_new_password($id, $name, $email)
{
    require 'application/libraries/mailer/config.php';
    require 'application/libraries/mailer/functions.php';
    require 'application/libraries/mailer/PHPMailerAutoload.php';
    $CI = &get_instance();
    $data['contact'] = $CI->back_m->get_one('contact_settings', 1);
    $data['settings'] = $CI->back_m->get_one('settings', 1);

    $_POST['base_url'] = base_url();
    $_POST['secret_key'] = $secret_key;
    $_POST['name'] = $name;
    $_POST['company'] = $data['contact']->company;
    $_POST['logo'] = $data['settings']->logo_mail;
    $_POST['new_password'] = randomPassword();
    $_POST['name'] = $name;

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = $cfg['smtp_host'];
    $mail->SMTPAuth = true;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Username = $cfg['smtp_user'];
    $mail->Password = $cfg['smtp_pass'];
    $mail->Port = $cfg['smtp_port'];
    $mail->setFrom($cfg['smtp_user'], $data['contact']->company .  ' - resetowanie hasła');
    $mail->AddBCC($email);
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $data['contact']->company .  ' - resetowanie hasła';
    $mail->Body    = build_mail_body($_POST, 'reset_password.php');
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        exit;
    }
    $update['password'] = hashPassword($_POST['new_password']);
    $CI->back_m->update('clients', $update, $id);
    return true;
}

function resendActive($id, $email, $created)
{
    require 'application/libraries/mailer/config.php';
    require 'application/libraries/mailer/functions.php';
    require 'application/libraries/mailer/PHPMailerAutoload.php';
    $CI = &get_instance();
    $client = $CI->back_m->get_one('clients', $id);
    $data['contact'] = $CI->back_m->get_one('contact_settings', 1);
    $data['settings'] = $CI->back_m->get_one('settings', 1);

    $_POST['base_url'] = base_url();
    $_POST['secret_key'] = md5($id . '|' . $email . '|' . $created);
    $_POST['company'] = $data['contact']->company;
    $_POST['logo'] = $data['settings']->logo_mail;
    $_POST['name'] = $client->first_name;

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = $cfg['smtp_host'];
    $mail->SMTPAuth = true;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Username = $cfg['smtp_user'];
    $mail->Password = $cfg['smtp_pass'];
    $mail->Port = $cfg['smtp_port'];
    $mail->setFrom($cfg['smtp_user'], $data['contact']->company .  ' - przypomnienie o aktywacji konta');
    $mail->AddBCC($email);
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $data['contact']->company .  ' - przypomnienie o aktywacji konta';
    $mail->Body    = build_mail_body($_POST, 'active_account.php');
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        exit;
    }
}

function send_custom_email($email_data, $template, $to, $subject)
{
    $CI = &get_instance();

    $data['contact'] = $CI->back_m->get_one('contact_settings', 1);
    $settings = $CI->back_m->get_one('settings', 1);

    require 'application/libraries/mailer/config.php';
    require 'application/libraries/mailer/functions.php';
    require 'application/libraries/mailer/PHPMailerAutoload.php';

    $email_data['base_url'] = base_url();
    $email_data['logo'] = $settings->logo_mail;
    $email_data['company'] = $data['contact']->company;
    $email_data['name'] = $email_data['first_name'] ?? '';

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = $cfg['smtp_host'];
    $mail->SMTPAuth = true;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Username = $cfg['smtp_user'];
    $mail->Password = $cfg['smtp_pass'];
    $mail->Port = $cfg['smtp_port'];
    $mail->setFrom($cfg['smtp_user'], $data['contact']->company .  " - $subject");
    $mail->AddBCC($to);
    if (!empty($_POST['email'])) {
        $mail->addReplyTo($_POST['email']);
    }
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $data['contact']->company .  " - $subject";
    $mail->Body    = build_mail_body($email_data, "$template.php");
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        exit;
    } else {
        $CI->session->set_flashdata('flashdata_true', '<p class="text-success font-weight-bold mb-0">Pomyślnie utworzono konto, wysłano link aktywacyjny na podany adres e-mail!</p>');
    }
}

function send_change_to_await_list($id)
{
    require 'application/libraries/mailer/config.php';
    require 'application/libraries/mailer/functions.php';
    require 'application/libraries/mailer/PHPMailerAutoload.php';
    $CI = &get_instance();
    $data['contact'] = $CI->back_m->get_one('contact_settings', 1);
    $data['settings'] = $CI->back_m->get_one('settings', 1);
    $data['product'] = $CI->back_m->get_one('products', $id);
    $data['users'] = $CI->back_m->get_awaiting_users('product_await_list', $id);

    if ($data['users'] ?? null) {

        $_POST['base_url'] = base_url();
        $_POST['company'] = $data['contact']->company;
        $_POST['logo'] = $data['settings']->logo_mail;
        $_POST['product-title'] = slug($data['product']->name);

        $_POST['product'] = '<table style="width: 100%; border-spacing: 0;">';
        $_POST['product'] .= '<tr style="background: #eaeaea;">';
        $_POST['product'] .= '<td style="padding: 10px;"><img src="' . base_url() . 'import/photo_min/' . $data['product']->photo . '" width="128" /></td>';
        $_POST['product'] .= '<td><a target="_BLANK" href="' . base_url() . 'produkt/' . slug($data['product']->name) . '/' . $id . '">' . $data['product']->name . '</a></td>';
        $_POST['product'] .= '<td>' . $data['product']->price_brutto . ' PLN</td>';
        $_POST['product'] .= '</tr>';
        $_POST['product'] .= '</table>';

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = $cfg['smtp_host'];
        $mail->SMTPAuth = true;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Username = $cfg['smtp_user'];
        $mail->Password = $cfg['smtp_pass'];
        $mail->Port = $cfg['smtp_port'];
        $mail->setFrom($cfg['smtp_user'], $data['contact']->company .  ' - obserwowany przez ciebie produkt wrócił do naszego sklepu.');
        foreach ($data['users'] as $key) {
            $mail->AddBCC($key->email);
        }
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $data['contact']->company .  ' - obserwowany przez ciebie produkt wrócił do naszego sklepu.';
        $mail->Body    = build_mail_body($_POST, 'product_await_list.php');
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            exit;
        }
    }
}

function sendPackage($transaction_id, $courier, $shipmentId)
{
    $CI = &get_instance();

    $data['contact'] = $CI->back_m->get_one('contact_settings', 1);
    $settings = $CI->back_m->get_one('settings', 1);
    $transaction = $CI->back_m->get_one('transaction', $transaction_id);

    require 'application/libraries/mailer/config.php';
    require 'application/libraries/mailer/functions.php';
    require 'application/libraries/mailer/PHPMailerAutoload.php';

    $email_data['base_url'] = base_url();
    $email_data['logo'] = $settings->logo_mail;
    $email_data['company'] = $data['contact']->company;
    $email_data['name'] = $transaction->first_name;

    $email_data['link'] = 'https://tracktrace.dpd.com.pl/parcelDetails?typ=1&p1=' . $shipmentId;
    if ($courier == 'inpost') {
        $email_data['link'] = 'https://inpost.pl/sledzenie-przesylek?number=' . $shipmentId;
    }

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = $cfg['smtp_host'];
    $mail->SMTPAuth = true;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Username = $cfg['smtp_user'];
    $mail->Password = $cfg['smtp_pass'];
    $mail->Port = $cfg['smtp_port'];
    $mail->setFrom($cfg['smtp_user'], $data['contact']->company .  " - status Twojej przesyłki");
    $mail->AddBCC($transaction->email);
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $data['contact']->company .  " - status Twojej przesyłki";
    $mail->Body    = build_mail_body($email_data, "package.php");
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        exit;
    }
}

function sendInvoice($transaction, $invoice)
{
    $CI = &get_instance();

    $data['contact'] = $CI->back_m->get_one('contact_settings', 1);
    $settings = $CI->back_m->get_one('settings', 1);

    require 'application/libraries/mailer/config.php';
    require 'application/libraries/mailer/functions.php';
    require 'application/libraries/mailer/PHPMailerAutoload.php';

    $transaction_data['base_url'] = base_url();
    $email_data['logo'] = $settings->logo;
    $email_data['company'] = $data['contact']->company;
    $email_data['name'] = $transaction->first_name;


    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = $cfg['smtp_host'];
    $mail->SMTPAuth = true;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Username = $cfg['smtp_user'];
    $mail->Password = $cfg['smtp_pass'];
    $mail->Port = $cfg['smtp_port'];
    $mail->setFrom($cfg['smtp_user'], $data['contact']->company .  " - faktura do Twojego zamówienia");
    $mail->AddBCC($transaction->email);
    $mail->addAttachment($invoice);
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $data['contact']->company .  " - faktura do Twojego zamówienia";
    $mail->Body    = build_mail_body($email_data, "invoice.php");
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        exit;
    }
}