<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {

	public function index() {
		if(isset($_SESSION['client_login']) && $_SESSION['client_login'] == true){
            $this->session->set_flashdata('flashdata_true', '<p class="text-success font-weight-bold mb-0">Jesteś już zalogowany.</p>');
			redirect('');
			exit;
		}

		$data = loadDefaultDataFront();
		$data['contact_company'] = $this->back_m->get_one('contact', 1);

		$this->form_validation->set_rules('email_log', 'Adres e-mail', 'required|min_length[2]|valid_email|trim');
		$this->form_validation->set_rules('password_log', 'Hasło', 'required|min_length[6]|trim');
		$this->form_validation->set_message('min_length', 'Pole "%s" ma za mało znaków');
		$this->form_validation->set_message('required', 'Pole "%s" jest wymagane');
		$this->form_validation->set_message('valid_email', 'Pole "%s" nie jest poprawnym adresem');

		if ($this->form_validation->run() == FALSE) {
			echo loadViewsFront('login_clients', $data);
		} else {
			if($this->login_m->check_login($_POST['email_log'], $_POST['password_log'])){
				$this->session->set_flashdata('flashdata_true', '<p class="text-success font-weight-bold mb-0">Zostałeś pomyślnie zalogowany.</p>');
				redirect('');
			} else {
				$this->session->set_flashdata('login_false', 'Błędny adres e-mail lub hasło lub konto nie zostało aktywowane.');
				redirect('logowanie');
			}
		}
	}

	public function register() {
		if(isset($_SESSION['client_login']) && $_SESSION['client_login'] == true){
            $this->session->set_flashdata('flashdata_true', '<p class="text-success font-weight-bold mb-0">Jesteś już zalogowany.</p>');
			redirect('');
			exit;
		}

		$data = loadDefaultDataFront();
		$data['contact_company'] = $this->back_m->get_one('contact', 1);

		$this->form_validation->set_rules('first_name', 'Imię', 'required|min_length[2]|trim');
		$this->form_validation->set_rules('last_name', 'Nazwisko', 'required|min_length[2]|trim');
		$this->form_validation->set_rules('email', 'Adres e-mail', 'required|min_length[2]|valid_email|trim|is_unique[clients.email]');
		$this->form_validation->set_rules('password', 'Hasło', 'required|min_length[6]|trim');
		$this->form_validation->set_rules('regulation', 'Potwiedź regulamin', 'required|trim');
		$this->form_validation->set_message('min_length', 'Pole "%s" ma za mało znaków');
		$this->form_validation->set_message('required', 'Pole "%s" jest wymagane');
		$this->form_validation->set_message('valid_email', 'Pole "%s" nie jest poprawnym adresem');
		$this->form_validation->set_message('is_unique', 'Użytkownik o podanym adresie e-mail istnieje już w bazie danych');

		if ($this->form_validation->run() == FALSE) {
			echo loadViewsFront('login_clients', $data);
		} else {
			if ($this->login_m->register($_POST)) {
				$this->session->set_flashdata('flashdata_true', '<p class="text-success font-weight-bold mb-0">Zostałeś pomyślnie zarejestrowany.</p>');
				$this->session->set_flashdata('register_success', 'Zostałeś pomyslnie zarejestrowany. Proszę potwierdź swoje konto klikając w link podany w wiadomości e-mail.');
				redirect('logowanie');
			} else {
				$this->session->set_flashdata('flashdata_false', '<p class="text-danger font-weight-bold mb-0">Wystąpił problem podczas rejestracji Twojego konta. Prosimy spróbować później.</p>');
				redirect('rejestracja');
			}
		}
	}

	public function forgot_password() {
		if(isset($_SESSION['client_login']) && $_SESSION['client_login'] == true){
            $this->session->set_flashdata('flashdata_true', '<p class="text-success font-weight-bold mb-0">Jesteś już zalogowany.</p>');
			redirect('');
			exit;
		}

		$data = loadDefaultDataFront();
		$data['contact_company'] = $this->back_m->get_one('contact', 1);

		$this->form_validation->set_rules('first_name', 'Imię', 'required|min_length[2]|trim');
		$this->form_validation->set_rules('last_name', 'Nazwisko', 'required|min_length[2]|trim');
		$this->form_validation->set_rules('email', 'Adres e-mail', 'required|min_length[2]|valid_email|trim');
		$this->form_validation->set_message('min_length', 'Pole "%s" ma za mało znaków');
		$this->form_validation->set_message('required', 'Pole "%s" jest wymagane');
		$this->form_validation->set_message('valid_email', 'Pole "%s" nie jest poprawnym adresem');

		if ($this->form_validation->run() == FALSE) {
			echo loadViewsFront('forgot_password.php', $data);
		} else {
			if ($this->login_m->reset_password($_POST)) {
				$this->session->set_flashdata('flashdata_true', '<p class="text-success font-weight-bold mb-0">Twoje hasło zostało pomyślnie zmienione.</p>');
				$this->session->set_flashdata('register_success', 'Twoje nowe hasło zostało wysłane na Twój adres e-mail.');
				redirect('logowanie');
			} else {
				$this->session->set_flashdata('flashdata_false', '<p class="text-danger font-weight-bold mb-0">Podane dane są nieprawidłowe.</p>');
				redirect('zapomnialem_hasla');
			}
		}
	}

	public function active_account($secret_key) {
		$insert['active'] = 1;
		if($this->login_m->active_account('clients', $insert, $secret_key)) {
			$this->session->set_flashdata('register_success', 'Twoje konto zostało pomyślnie zweryfikowane! Teraz możesz się zalogować.');
		} else {
			$this->session->set_flashdata('flashdata_false', 'Wystąpił nieznany błąd podczas aktywacji konta. Prosimy skontaktować się naszą infolinią. Przepraszamy.');
		}
		redirect('logowanie');
	}

	public function settings() {
		if(!isset($_SESSION['client_login']) && !$_SESSION['client_login'] == true){
            $this->session->set_flashdata('flashdata_false', '<p class="text-danger font-weight-bold mb-0">Musisz się najpierw zalogować.</p>');
			redirect('');
			exit;
		}

		$data = loadDefaultDataFront();
		$data['client'] = $this->back_m->get_one('clients', $_SESSION['id']);

		$this->form_validation->set_rules('first_name', 'Imię', 'required|min_length[2]|trim');
		$this->form_validation->set_rules('last_name', 'Nazwisko', 'required|min_length[2]|trim');
		$this->form_validation->set_rules('email', 'Adres e-mail', 'required|min_length[2]|valid_email|trim');
		$this->form_validation->set_rules('phone', 'Numer telefonu ', 'min_length[9]|max_length[12]|trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('country', 'Kraj', 'min_length[2]|trim');
		$this->form_validation->set_rules('city', 'Miasto', 'min_length[2]|trim');
		$this->form_validation->set_rules('zipcode', 'Kod pocztowy', 'min_length[2]|trim|alpha_dash');
		$this->form_validation->set_rules('street', 'Ulica', 'min_length[2]|trim');
		$this->form_validation->set_rules('housenumber', 'Numer budynku / domu', 'min_length[1]|trim');
		$this->form_validation->set_rules('flatnumber', 'Numer mieszkania', 'min_length[1]|trim');
		$this->form_validation->set_rules('company', 'Nazwa firmy', 'min_length[2]|trim');
		$this->form_validation->set_rules('nip', 'NIP', 'min_length[2]|trim');
		$this->form_validation->set_rules('country_company', 'Kraj firmy', 'min_length[2]|trim');
		$this->form_validation->set_rules('city_company', 'Miasto firmy', 'min_length[2]|trim');
		$this->form_validation->set_rules('zipcode_company', 'Kod pocztowy firmy', 'min_length[2]|trim|alpha_dash');
		$this->form_validation->set_rules('address_company', 'Adres firmy', 'min_length[2]|trim');
		$this->form_validation->set_rules('password', 'Hasło', 'min_length[6]|trim');
		$this->form_validation->set_rules('current_password', 'Obecne hasło', 'required|min_length[6]|trim');
		$this->form_validation->set_message('min_length', 'Pole "%s" ma za mało znaków');
		$this->form_validation->set_message('max_length', 'Pole "%s" ma za dużo znaków');
		$this->form_validation->set_message('alpha_numeric_spaces', 'Pole "%s" może zawierać tylko cyfry');
		$this->form_validation->set_message('required', 'Pole "%s" jest wymagane');
		$this->form_validation->set_message('valid_email', 'Pole "%s" nie jest poprawnym adresem');
		$this->form_validation->set_message('alpha_dash', 'Pole "%s" zawiera nieprawidłowe znaki');

		if ($this->form_validation->run() == FALSE) {
			echo loadViewsFront('settings', $data);
		} else {
			if (password_verify($_POST['current_password'], $data['client']->password)) {
				unset($_POST['current_password']);
				if ($_POST['password'] != null) {
					$_POST['password'] = hashPassword($_POST['password']);
				} else {
					unset($_POST['password']);
				}
				if ($this->back_m->update('clients', $_POST, $data['client']->id)) {
					$this->session->set_flashdata('register_success', 'Twoje dane zostały pomyślnie zakutalizowane.');
	            	$this->session->set_flashdata('flashdata_true', '<p class="text-success font-weight-bold mb-0">Twoje dane zostały pomyślnie zakutalizowane.</p>');
					redirect($_SERVER['HTTP_REFERER']);
				} else {
					$this->session->set_flashdata('login_false', 'Twoje dane nie zostały zakutalizowane. Prosimy spróbować ponownie później.');
	            	$this->session->set_flashdata('flashdata_false', '<p class="text-danger font-weight-bold mb-0">Twoje dane zostały nie zostały zakutalizowane.</p>');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
			else {
				$this->session->set_flashdata('login_false', 'Twoje obecne hasło jest inne niż to które podałeś.');
	            $this->session->set_flashdata('flashdata_false', '<p class="text-danger font-weight-bold mb-0">Twoje obecne hasło jest inne niż to które podałeś.</p>');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function logout() {
		if(!isset($_SESSION['client_login']) && !$_SESSION['client_login'] == true){
            $this->session->set_flashdata('flashdata_false', '<p class="text-danger font-weight-bold mb-0">Musisz się najpierw zalogować.</p>');
			redirect('');
			exit;
		}
		$this->load->helper('cart');
        clearCart();
		unset($_SESSION['id']);
		unset($_SESSION['first_name']);
		unset($_SESSION['last_name']);
		unset($_SESSION['email']);
		unset($_SESSION['discount']);
		unset($_SESSION['type_client']);
		unset($_SESSION['client_login']);
        $this->session->set_flashdata('flashdata_true', '<p class="text-success font-weight-bold mb-0">Zostałeś pomyślnie wylogowany.</p>');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function favourite() {
		$data = loadDefaultDataFront();
		echo loadViewsFront('favourite', $data);
	}

	public function orders() {
		$data = loadDefaultDataFront();
		$id = $_SESSION['id'];
		$data['user_orders'] = $this->back_m->get_user_orders('transaction', $id);
		$paging = $this->uri->segment(2);
		$perPage = 4;
		$data['paged_orders'] = $this->back_m->get_ordersBy_pagging($id, $perPage, $paging);
		$this->load->library('pagination');
		$config['base_url'] = base_url('moje_zamowienia');
		$config['total_rows'] = count($data['user_orders']);
		$config['per_page'] = $perPage;
		$config['next_link'] = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
		$config['prev_link'] = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
		$config['first_link'] = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';
		$config['last_link'] = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
		$this->pagination->initialize($config);
		echo loadViewsFront('user_orders', $data);
	}


	public function add_favourite_product($id) {
		if(isset($_COOKIE['favouriteProducts'])) {
			$products = json_decode($_COOKIE['favouriteProducts'], true);
			array_push($products, $id);
		} else {
			$products = array(
				0 => $id
			);
		}
		setcookie('favouriteProducts', json_encode($products), time() + (86400 * 30), "/");
		$this->session->set_flashdata('flashdata_true', 'Produkt został dodany do listy ulubionych');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function remove_favourite_product($id) {
		$arrayCookie = json_decode($_COOKIE['favouriteProducts']);
		unset($_COOKIE['favouriteProducts']);
		$newArrayCookie = [];
		foreach ($arrayCookie as $key => $value) {
			if($value != $id) {	
				array_push($newArrayCookie, $value);
			}
		}
		setcookie('favouriteProducts', json_encode($newArrayCookie), time() + (86400 * 30), "/");
		$this->session->set_flashdata('flashdata_true', 'Produkt został usunięty z listy ulubionych');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function share_products($id) {
		$product = $this->back_m->get_one('products', $id);
		$facebookId = '244485139892958';
		$url = 'https://www.facebook.com/dialog/share?app_id='.$facebookId.'&display=popup&href='.base_url('produkt/'.slug($product->name).'/'.$id).'&redirect_uri='.base_url();
		redirect($url);
	}


}