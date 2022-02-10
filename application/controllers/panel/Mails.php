<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mails extends CI_Controller
{

    public function index()
    {
        if (checkAccess()) {
            // DEFAULT DATA
            $data = loadDefaultData();

            $data['rows'] = $this->back_m->get_all($this->uri->segment(2));
            echo loadSubViewsBack($this->uri->segment(2), 'index', $data);
        } else {
            redirect('panel');
        }
    }

    public function show($id)
    {
        if (checkAccess()) {
            // DEFAULT DATA
            $data = loadDefaultData();

            $data['value'] = $this->back_m->get_one($this->uri->segment(2), $id);
            echo loadSubViewsBack($this->uri->segment(2), 'show', $data);
        } else {
            redirect('panel');
        }
    }

    public function send()
    {
        $data['contact'] = $this->back_m->get_one('contact_settings', 1);
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
        $mail->setFrom($cfg['smtp_user'], $data['contact']->company .  ' - odpowiedź');
        $mail->AddBCC($_POST['email']);
        if (!empty($_POST['email'])) {
            $mail->addReplyTo($_POST['email']);
        }
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $data['contact']->company .  ' - odpowiedź';
        $mail->Body    = build_mail_body($_POST, 'answer.php');
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            exit;
        } else {
            $update['answer'] = 1;
            $this->back_m->update('mails', $update, $_POST['id']);
        }
    }

    public function send_message($id = '')
    {
        $data['contact'] = $this->back_m->get_one('contact_settings', 1);
        $data['settings'] = $this->back_m->get_one('settings', 1);
        $data['logo'] = $this->back_m->get_one('logos', 4);

        if ($id == '') :

            $data['users'] = $this->back_m->get_all('clients');

        else :

            $data['user'] = $this->back_m->get_one('clients', $id);

        endif;

        require 'application/libraries/mailer/config.php';
        require 'application/libraries/mailer/functions.php';
        require 'application/libraries/mailer/PHPMailerAutoload.php';

        $_POST['base_url'] = base_url();
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
        $mail->setFrom($cfg['smtp_user'], $data['contact']->company .  ' - wiadomość');

        if ($id == '') :

            foreach ($data['users'] as $v) :

                $mail->AddBCC($v->email);

            endforeach;

        else :

            $mail->AddBCC($data['user']->email);

        endif;

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $data['contact']->company .  ' - wiadomość';
        $mail->Body    = build_mail_body($_POST, 'user_message.php');
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            exit;
        } else {
            $this->session->set_flashdata('flashdata', 'Pomyślnie wysłałeś wiadomość!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function send_group_message($id)
    {
        $data['contact'] = $this->back_m->get_one('contact_settings', 1);
        $data['settings'] = $this->back_m->get_one('settings', 1);
        $data['logo'] = $data['settings']->logo_mail;

        $data['users'] = $this->back_m->get_users_from_group('clients', $id);

        require 'application/libraries/mailer/config.php';
        require 'application/libraries/mailer/functions.php';
        require 'application/libraries/mailer/PHPMailerAutoload.php';

        $_POST['base_url'] = base_url();
        $_POST['logo'] = $data['logo'];
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
        $mail->setFrom($cfg['smtp_user'], $data['contact']->company .  " - {$_POST['subject']}");

        foreach ($data['users'] as $v) :

            $mail->AddBCC($v->email);

        endforeach;

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $data['contact']->company .  " - {$_POST['subject']}";
        $mail->Body    = build_mail_body($_POST, 'user_message.php');
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            exit;
        } else {
            $this->session->set_flashdata('flashdata', 'Pomyślnie wysłałeś wiadomość!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function send_to_chosen_users()
    {
        $data['contact'] = $this->back_m->get_one('contact_settings', 1);
        $data['settings'] = $this->back_m->get_one('settings', 1);
        $data['logo'] = $this->back_m->get_one('logos', 4);

        require 'application/libraries/mailer/config.php';
        require 'application/libraries/mailer/functions.php';
        require 'application/libraries/mailer/PHPMailerAutoload.php';

        $_POST['base_url'] = base_url();
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
        $mail->setFrom($cfg['smtp_user'], $data['contact']->company .  ' - wiadomość');

        foreach (explode(',', $_POST['mails']) as $v) :

            $mail->AddBCC($v);

        endforeach;

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $data['contact']->company .  ' - wiadomość';
        $mail->Body    = build_mail_body($_POST, 'user_message.php');
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            exit;
        } else {
            $this->session->set_flashdata('flashdata', 'Pomyślnie wysłałeś wiadomość!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
