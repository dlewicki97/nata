<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mailer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("captcha_secret");
    }

    public function test()
    {
        send_custom_email(['message' => 'halo witam'], 'test', 'dany97971@wp.pl', "Dzien dobry");
    }

    public function send()
    {

        if (verifyCaptcha(get_captcha_secret(), $_POST['token'], $_SERVER['REMOTE_ADDR'])) {
            $data['contact'] = $this->back_m->get_one('contact_settings', 1);

            $insert['name'] = $this->input->post('name');
            $insert['email'] = $this->input->post('email');
            $insert['subject'] = $this->input->post('subject');
            $insert['phone'] = $this->input->post('phone');
            $insert['message'] = $this->input->post('message');
            if ($this->input->post('rodo1') != null) {
                $insert['rodo1'] = '1';
                $_POST['rodo1'] = 'Zaakceptowane';
            } else {
                $insert['rodo1'] = '0';
                $_POST['rodo1'] = 'Niezaakceptowane';
            }
            if ($this->input->post('rodo2') != null) {
                $insert['rodo2'] = '1';
                $_POST['rodo2'] = 'Zaakceptowane';
            } else {
                $insert['rodo2'] = '0';
                $_POST['rodo2'] = 'Niezaakceptowane';
            }
            $this->back_m->insert('mails', $insert);

            require 'application/libraries/mailer/config.php';
            require 'application/libraries/mailer/functions.php';
            require 'application/libraries/mailer/PHPMailerAutoload.php';

            $_POST['base_url'] = base_url();
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
            $mail->setFrom($cfg['smtp_user'], $data['contact']->company .  ' - formularz kontaktowy');
            $mail->AddBCC($data['contact']->email1);
            if (!empty($_POST['email'])) {
                $mail->addReplyTo($_POST['email']);
            }
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $data['contact']->company .  ' - formularz kontaktowy';
            $mail->Body    = build_mail_body($_POST, 'contact.php');
            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                exit;
            } else {
                $this->session->set_flashdata('flashdata_true', '<p class="text-success font-weight-bold mb-0">Pomyślnie wysłałeś formularz!</p>');
                redirect('kontakt');
            }
        } else {
            $this->session->set_flashdata('flashdata_false', '<p class="text-danger font-weight-bold mb-0">Ochrona antyspamowa!</p>');
            redirect('kontakt');
        }
    }

    public function question_for_product()
    {

        if (verifyCaptcha(get_captcha_secret(), $_POST['token'], $_SERVER['REMOTE_ADDR'])) {
            $data['contact'] = $this->back_m->get_one('contact_settings', 1);

            $insert['subject'] = $this->input->post('subject');
            $insert['name'] = $this->input->post('name');
            $insert['email'] = $this->input->post('email');
            $insert['message'] = $this->input->post('message');
            if ($this->input->post('rodo1') != null) {
                $insert['rodo1'] = '1';
                $_POST['rodo1'] = 'Zaakceptowane';
            } else {
                $insert['rodo1'] = '0';
                $_POST['rodo1'] = 'Niezaakceptowane';
            }
            if ($this->input->post('rodo2') != null) {
                $insert['rodo2'] = '1';
                $_POST['rodo2'] = 'Zaakceptowane';
            } else {
                $insert['rodo2'] = '0';
                $_POST['rodo2'] = 'Niezaakceptowane';
            }
            $this->back_m->insert('mails', $insert);

            require 'application/libraries/mailer/config.php';
            require 'application/libraries/mailer/functions.php';
            require 'application/libraries/mailer/PHPMailerAutoload.php';

            $_POST['base_url'] = base_url();
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
            $mail->setFrom($cfg['smtp_user'], $data['contact']->company .  ' - ' . $this->input->post('subject'));
            $mail->AddBCC($data['contact']->email1);
            //$mail->AddBCC('d.plociennik@adawards.pl');
            if (!empty($_POST['email'])) {
                $mail->addReplyTo($_POST['email']);
            }
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $data['contact']->company .  ' - ' . $this->input->post('subject');
            $mail->Body    = build_mail_body($_POST, 'question_for_product.php');
            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                exit;
            } else {
                $this->session->set_flashdata('flashdata_true', '<p class="text-success font-weight-bold mb-0">Pomyślnie wysłałeś formularz!</p>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('flashdata_false', '<p class="text-danger font-weight-bold mb-0">Ochrona antyspamowa!</p>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}