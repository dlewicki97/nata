<?php
defined('BASEPATH') or exit('No direct script access allowed');


function send_product_reminder($product_id)
{
    $CI = &get_instance();

    $product = $CI->back_m->get_one('products', $product_id);
    $product_reminders = $CI->back_m->get_all_where('product_reminders', 'product_id', $product_id);
    $contact = $CI->back_m->get_one('contact_settings', 1);
    $settings = $CI->back_m->get_one('settings', 1);
    require 'application/libraries/mailer/config.php';

    $data['base_url'] = base_url();
    $data['product_id'] = $product->id;
    $data['slug_name'] = slug($product->name);
    $data['product_name'] = $product->name;
    $data['logo'] = $settings->logo_mail;

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
    $mail->setFrom($cfg['smtp_user'], $contact->company .  " - produkt \"$product->name\" jest już dostępny!");
    if (!empty($data['email'])) {
        $mail->addReplyTo($data['email']);
    }
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    $mail->Body    = build_mail_body($data, 'product_reminder.php');
    $mail->Subject = $contact->company .  " - produkt \"$product->name\" jest już dostępny!";
    foreach ($product_reminders as $reminder) {
        $mail->AddBCC($reminder->email);

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            exit;
        }
    }
}
