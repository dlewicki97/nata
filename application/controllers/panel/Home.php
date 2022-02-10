<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('panel_m');
	}

	public function index()
	{
		if ($this->session->userdata('login')) redirect('panel/dashboard');

		$this->form_validation->set_rules('login', 'Login', 'min_length[2]|trim');
		$this->form_validation->set_rules('password', 'Hasło', 'min_length[6]|trim');
		$this->form_validation->set_message('min_length', 'Pole %s ma za mało znaków');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('flashdata', validation_errors());
			echo loadLogin('index');
		} else {
			$login = strtolower($this->input->post('login'));
			$password = $this->input->post('password');
			if ($this->panel_m->check_login($login, $password)) {
				redirect('panel/dashboard');
			} else {
				echo loadLogin('index');
			}
		}
	}

	public function reset_pass()
	{
		$this->form_validation->set_rules('email', 'Adres E-mail', 'min_length[2]|trim|valid_email');
		$this->form_validation->set_message('min_length', 'Pole %s ma za mało znaków');
		$this->form_validation->set_message('valid_email', 'Błędny adres e-mail');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('flashdata', validation_errors());
			echo loadLogin('reset_pass');
		} else {
			$email = strtolower($this->input->post('email'));
			if ($this->panel_m->check_email($email)) {
				echo loadLogin('index');
			} else {
				echo loadLogin('reset_pass');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('flashdata', 'Poprawne wylogowanie');

		unset($_COOKIE['panelProductsSearch']);
		setcookie('panelProductsSearch', null, -1, '/');
		unset($_COOKIE['panelProductsCount']);
		setcookie('panelProductsCount', null, -1, '/');


		redirect('panel');
	}
}