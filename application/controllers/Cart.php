<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('shop_m');
		$this->load->helper('cart');
	}

	public function index()
	{
		clean_search();
		if (empty($this->cart->contents())) {
			unset($_SESSION['used_discount']);
			unset($_SESSION['value_discount']);
		}
		$data = loadDefaultDataFront();
		availableProduct($this->cart->contents());
		echo loadViewsFront('cart', $data);
	}

	public function test()
	{
		echo json_encode($this->cart->contents());
	}

	public function client_data()
	{
		$data = loadDefaultDataFront();
		emptyCart();
		availableProduct($this->cart->contents());
		if (isset($_SESSION['id'])) {
			$data['client'] = $this->session->userdata('client');
		}

		$this->form_validation->set_rules('first_name', 'Imię', 'required|min_length[2]|trim');
		$this->form_validation->set_rules('last_name', 'Nazwisko', 'required|min_length[2]|trim');
		$this->form_validation->set_rules('email', 'Adres e-mail', 'required|min_length[2]|valid_email|trim');
		$this->form_validation->set_rules('phone', 'Numer telefonu ', 'required|min_length[9]|max_length[12]|trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('country', 'Kraj', 'required|min_length[2]|trim');
		$this->form_validation->set_rules('city', 'Miasto', 'required|min_length[2]|trim');
		$this->form_validation->set_rules('zipcode', 'Kod pocztowy', 'required|min_length[2]|trim|alpha_dash');
		$this->form_validation->set_rules('street', 'Ulica', 'required|min_length[2]|trim');
		$this->form_validation->set_rules('housenumber', 'Numer budynku / domu', 'required|min_length[1]|trim');
		$this->form_validation->set_rules('flatnumber', 'Numer mieszkania', 'min_length[1]|trim');
		$this->form_validation->set_rules('regulation', 'Regulamin', 'required');
		$this->form_validation->set_rules('rodo1', 'Rodo', 'required');
		if (isset($_POST['invoice'])) {
			$this->form_validation->set_rules('company', 'Nazwa firmy', 'required|min_length[2]|trim');
			$this->form_validation->set_rules('nip', 'NIP', 'required|min_length[2]|trim');
			$this->form_validation->set_rules('country_company', 'Kraj firmy', 'required|min_length[2]|trim');
			$this->form_validation->set_rules('city_company', 'Miasto firmy', 'required|min_length[2]|trim');
			$this->form_validation->set_rules('zipcode_company', 'Kod pocztowy firmy', 'required|min_length[2]|trim|alpha_dash');
			$this->form_validation->set_rules('address_company', 'Adres firmy', 'required|min_length[2]|trim');
		}
		$this->form_validation->set_message('min_length', 'Pole "%s" ma za mało znaków');
		$this->form_validation->set_message('max_length', 'Pole "%s" ma za dużo znaków');
		$this->form_validation->set_message('alpha_numeric_spaces', 'Pole "%s" może zawierać tylko cyfry');
		$this->form_validation->set_message('required', 'Pole "%s" jest wymagane');
		$this->form_validation->set_message('valid_email', 'Pole "%s" nie jest poprawnym adresem');
		$this->form_validation->set_message('alpha_dash', 'Pole "%s" zawiera nieprawidłowe znaki');

		if ($this->form_validation->run() == FALSE) {
			echo loadViewsFront('client_data', $data);
		} else {
			foreach ($_POST as $k => $v) {
				if ($k === 'id') continue;
				$_SESSION[$k] = $v;
			}
			redirect('koszyk/platnosc');
		}
	}

	public function invoice_fields()
	{
		$data[] = '';
		if (isset($_SESSION['id'])) {
			$data['client'] = $this->session->userdata('client');
		}
		$this->load->view('front/elements/invoice', $data);
	}

	public function delivery_payment()
	{
		$data = loadDefaultDataFront();
		emptyCart();
		availableProduct($this->cart->contents());
		$this->form_validation->set_rules('delivery', 'Dostawa', 'required');
		$this->form_validation->set_rules('payment', 'Płatność', 'required');
		if (explode('|', @$_POST['delivery'])[0] == 'paczkomat' || explode('|', @$_POST['delivery'])[0] == 'paczkomat_pobranie') {
			$this->form_validation->set_rules('inpost_parcel', 'Paczkomat', 'required');
			$this->form_validation->set_rules('inpost_code', 'Paczkomat', 'required');
		}
		$this->form_validation->set_message('required', 'Pole "%s" jest wymagane');
		if ($this->form_validation->run() == FALSE) {
			echo loadViewsFront('delivery_payment', $data);
		} else {
			foreach ($_POST as $k => $v) {
				if ($k === 'id') continue;
				if ($k == 'delivery') {
					$_SESSION[$k] = explode('|', $v)[0];
					$_SESSION['delivery_cost'] = explode('|', $v)[1];
				} else {
					$_SESSION[$k] = $v;
				}
			}
			redirect('koszyk/podsumowanie');
		}
	}

	public function payment_fields()
	{
		$data['payments'] = $this->back_m->get_all('payments');
		$this->load->view('front/elements/payment_fields', $data);
	}


	public function p24_status($id)
	{
		require_once 'application/libraries/Przelewy24.php';

		log_message('info', "p24_status ID[$id]");
		$transaction = $this->back_m->get_one('transaction', $id);
		$insert['paid'] = 1;
		$postData = json_decode($transaction->p24_data, true);
		$P24 = new Przelewy24($postData["p24_merchant_id"], $postData["p24_pos_id"], $postData['salt'], false);
		$P24->addValue("p24_session_id", $postData['p24_session_id']);
		$P24->addValue("p24_amount", $postData['p24_amount']);
		$P24->addValue("p24_currency", $postData['p24_currency']);
		$P24->addValue("p24_order_id", $_POST['p24_order_id']);
		$p24VerifyStatus = $P24->trnVerify();
		log_message('info', "TRANSACTION ID[$id]: " . json_encode($p24VerifyStatus));
		$this->back_m->update('transaction', $insert, $id);
	}

	public function summary()
	{
		$data = loadDefaultDataFront();
		emptyCart();
		if (!isset($_POST['submit'])) {
			availableProduct($this->cart->contents());
			echo loadViewsFront('summary', $data);
		} else {
			$this->load->helper('transaction_helper');
			$transaction_id = addTransaction($_POST, $_SESSION);
			if ($transaction_id !== false) {
				unset($_SESSION['used_discount']);
				unset($_SESSION['value_discount']);
				unset($_SESSION['discount_value']);
				unset($_SESSION['discount_type']);
				if ($_SESSION['payment'] == 'p24') {
					$this->load->library('p24_lib');
					$update['payment_url'] = $this->p24_lib->p24_payment($transaction_id);
					$this->back_m->update('transaction', $update, $transaction_id);
					$_SESSION['thankyou'] = true;
					redirect($update['payment_url']);
				} else if ($_SESSION['payment'] == 'payu') {
					$this->load->library('payu_lib');
					$update['payment_url'] = $this->payu_lib->payu_payment($_SESSION, $transaction_id);
					$this->back_m->update('transaction', $update, $transaction_id);
					$_SESSION['thankyou'] = true;
					redirect($update['payment_url']);
				} else {
					$_SESSION['thankyou'] = true;
					redirect('dziekujemy');
				}
			}
		}
	}

	public function thankyou()
	{
		if (empty($this->cart->contents()) && $_SESSION['thankyou'] == false) {
			$this->session->set_flashdata('flashdata_false', '<p class="text-danger font-weight-bold mb-0">Twój koszyk jest pusty.</p>');
			redirect('');
		}
		$data = loadDefaultDataFront();
		$data['hours'] = $this->back_m->get_one('contact', 1);

		$data['subtotal'] = 0;
		foreach ($this->cart->contents() as $k => $v) {
			$data['subtotal'] += $v['price'] * $v['qty'];
		}

		clearCart();
		echo loadViewsFront('thankyou', $data);
		$_SESSION['thankyou'] = false;
	}

	public function add($product_id)
	{
		$CI = &get_instance();
		$CI->load->model('margin_m');

		isset($_POST['qty']) || $_POST['qty'] = 1;

		$product = $this->back_m->get_one('products', $product_id);
		$variant = $this->back_m->get_where_row('variants', ['product_id' => $product_id]);

		$price_brutto = $product->price_brutto;
		$margin = $CI->margin_m->get($price_brutto);
		if ($margin) $price_brutto = ((float)str_replace(',', '', $price_brutto)) * ((100 + $margin->margin) / 100);

		$cart_list = array(
			'id' 					=> md5($product->id . '|' . $variant->sku),
			'product_id' 			=> $product->id,
			'name' 					=> url_title(slug($product->name), '-', true),
			'price' 				=> price($product, $product->price_brutto),
			'before_price'      	=> (float)price($product, $product->price_brutto),
			'rl_price'      		=> (float)number_format($price_brutto, 2, ".", ""),
			'promo_active' 	 		=> $product->promo_active,
			'qty'        			=> $_POST['qty'],
			'barcode' 	 			=> $variant->sku
		);

		$checkAddToCart = checkAvailable($product_id, $product->one_in_cart, $variant->qty, $_POST['qty']);
		if ($checkAddToCart === true) {
			$insert = $this->cart->insert($cart_list);
			$this->session->set_flashdata('flashdata_true', 'Produkt został dodany do koszyka.');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->session->set_flashdata('flashdata_false', $checkAddToCart);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function qty($rowid)
	{
		$cart_list = array(
			'rowid'   => $rowid,
			'qty'     => $_POST['qty'],
		);
		$this->cart->update($cart_list);
	}

	public function remove($rowid)
	{
		$cart_list = array(
			'rowid'   => $rowid,
			'qty'     => 0
		);
		$this->cart->update($cart_list);
	}

	public function discount()
	{
		$this->load->model('cart_m');
		$code = $this->cart_m->discount('discounts', $_POST['discount_code']);
		if (!empty($code)) {
			if ($code->type == 0) {
				$discount = (100 - $code->value) / 100;
			} else {
				$discount = 0 - $code->value;
			}
			$promoAvailable = false;
			foreach ($this->cart->contents() as $v) {
				if ($v['promo_active'] == 0 && $v['rl_price'] == $v['before_price']) {
					if ($code->type == 0) {
						$type = '%';
						$discount = (100 - $code->value) / 100;
						$cart_list = array(
							'rowid'   => $v['rowid'],
							'price'   => $v['before_price'] * $discount,
						);
					} else {
						$type = 'PLN';
						$discount = 0 - $code->value;
						$cart_list = array(
							'rowid'   => $v['rowid'],
							'price'   => $v['before_price'] + $discount,
						);
					}
					$this->cart->update($cart_list);
					$promoAvailable = true;
				} else {
					$cart_list = array(
						'rowid'   => $v['rowid'],
						'discount_refused'   => 'Ten produkt nie jest objęty dodatkowymi rabatami.',
					);
					$this->cart->update($cart_list);
				}
			}
			if ($promoAvailable === false) {
				$this->session->set_flashdata('flashdata_false', 'Produkty nie są objęte kodem rabatowym.');
			} else {
				$_SESSION['used_discount'] = $code->discount_code;
				$_SESSION['value_discount'] = $code->value . ' ' . $type;
				$_SESSION['discount_value'] = $code->value;
				$_SESSION['discount_type'] = $code->type;

				$this->session->set_flashdata('flashdata_true', 'Kod rabatowy został dodany do koszyka.');
			}
		} else {
			$this->session->set_flashdata('flashdata_false', 'Ten kod rabatowy nie jest aktywny.');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
}