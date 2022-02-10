<?php
defined('BASEPATH') or exit('No direct script access allowed');



function send_discount_notification_to_client($client)
{
    $CI = &get_instance();

    $contact = $CI->back_m->get_one('contact_settings', 1);
    $settings = $CI->back_m->get_one('settings', 1);

    require 'application/libraries/mailer/config.php';
    require 'application/libraries/mailer/functions.php';
    require 'application/libraries/mailer/PHPMailerAutoload.php';

    $data['base_url'] = base_url();
    $data['logo'] = $settings->logo;
    $data['old_discount'] = $client->discount;
    $data['discount'] = $_POST['discount'];
    $data['name'] = $client->first_name;

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
    $mail->setFrom($cfg['smtp_user'], $contact->company .  ' - zmiana rabatu');
    $mail->AddBCC($client->email);
    if (!empty($data['email'])) {
        $mail->addReplyTo($data['email']);
    }
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = $contact->company .  ' - zmiana rabatu';
    $mail->Body    = build_mail_body($data, 'discount_notification.php');
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        exit;
    }
}