<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payu_lib  
{
	private $CI;

	public function __construct() {
		$this->CI =& get_instance();
	}

	public function payu_payment($session, $transaction_id) {
		require_once 'vendor/openpayu/openpayu/lib/openpayu.php';
		require_once 'vendor/openpayu/openpayu/examples/config.php';

		$order = array();
		$order['notifyUrl'] = base_url('cart/status/'.$transaction_id);
		$order['continueUrl'] = base_url('dziekujemy');
		$order['customerIp'] = '127.0.0.1';
		$order['merchantPosId'] = OpenPayU_Configuration::getOauthClientId() ? OpenPayU_Configuration::getOauthClientId() : OpenPayU_Configuration::getMerchantPosId();

		if(isset($post['message']) && $post['message'] != null) {
			$order['description'] = $post['message'];
		} else {
			$order['description'] = 'brak opisu';
		}

		$i=0;
		$suma = 0;
		foreach ($this->CI->cart->contents() as $key => $value) {
			$order['products'][$i]['name'] = $value['name'];
			$order['products'][$i]['unitPrice'] = $value['price'];
			$order['products'][$i]['quantity'] = $value['qty'];
			$suma += $value['price'] * $value['qty'];
			$i++;
		}

		$order['currencyCode'] = 'PLN';
		$order['totalAmount'] = ($suma + $session['delivery_cost']) * 100;
		$order['extOrderId'] = uniqid('', true);

		$order['buyer']['email'] = $session['email'];
		$order['buyer']['phone'] = $session['phone'];
		$order['buyer']['firstName'] = $session['first_name'];
		$order['buyer']['lastName'] = $session['last_name'];
		$order['buyer']['language'] = 'pl';

		$response = OpenPayU_Order::create($order);

		return $response->getResponse()->redirectUri;
	}
}