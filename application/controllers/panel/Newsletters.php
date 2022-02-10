<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Newsletters extends CI_Controller
{

	public function index()
	{
		if (checkAccess()) {
			if (!$this->db->table_exists($this->uri->segment(2))) {
				$this->base_m->create_table($this->uri->segment(2));
			}
			// DEFAULT DATA
			$data = loadDefaultData();

			$data['rows'] = $this->back_m->get_all($this->uri->segment(2));
			echo loadSubViewsBack($this->uri->segment(2), 'index', $data);
		} else {
			redirect('panel');
		}
	}

	public function form($type, $id = '')
	{
		if (checkAccess()) {
			// DEFAULT DATA
			$data = loadDefaultData();

			if ($id != '') {
				$data['value'] = $this->back_m->get_one($this->uri->segment(2), $id);
			}
			echo loadSubViewsBack($this->uri->segment(2), 'form', $data);
		} else {
			redirect('panel');
		}
	}

	public function action($type, $table, $id = '')
	{
		if (!checkAccess()) {
			redirect('panel');
		}
		$data['contact'] = $this->back_m->get_one('contact_settings', 1);
		$newsletter_subscribers = $this->back_m->get_all('newsletter_subscribers');

		require 'application/libraries/mailer/config.php';
		require 'application/libraries/mailer/functions.php';
		require 'application/libraries/mailer/PHPMailerAutoload.php';

		$this->back_m->insert('newsletters', ['subject' => $_POST['subject'], 'message' => $_POST['message']]);

		foreach ($newsletter_subscribers as $sub) {

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
			$mail->setFrom($cfg['smtp_user'], $data['contact']->company .  ' - newsletter');

			$mail->AddBCC($sub->email);
			$mail->isHTML(true);
			$mail->CharSet = 'UTF-8';
			$mail->Subject = $data['contact']->company .  ' - newsletter';
			$mail->Body    = build_mail_body($_POST, 'newsletter.php');
			$sent = $mail->send();

			if (!$sent) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
				$this->session->set_flashdata('flashdata', 'Nie udało się wysłać newslettera!');
				exit;
			}
		}

		$this->session->set_flashdata('flashdata', 'Newsletter został wysłany do subskrybentów!');
		redirect('panel/newsletters');
	}
}
