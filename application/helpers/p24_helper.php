<?php
defined('BASEPATH') or exit('No direct script access allowed');

function p24($post, $session, $sandbox, $transaction_id)
{

	$CI = &get_instance();
	$settings = $CI->back_m->get_one('shop_settings', 1);
	$_POST['first_name'] = $session['first_name'];
	$_POST['last_name'] = $session['last_name'];
	$_POST['p24_email'] = $session['email'];
	$_POST['phone'] = $session['phone'];
	$_POST['p24_address'] = $session['street'];
	$_POST['p24_zip'] = $session['zipcode'];
	$_POST['p24_city'] = $session['city'];
	$_POST['p24_country'] = $session['country'];
	$_POST['redirect'] = 'off';
	$_POST['p24_merchant_id'] = '145193';
	$_POST['p24_pos_id'] = '145193';
	$_POST['p24_session_id'] = session_id();

	$suma = 0;
	foreach ($CI->cart->contents() as $v) {
		$suma += $v['price'] * $v['qty'];
	}
	// $margin = $CI->margin_m->get($price);

	$_POST['p24_amount'] = ($suma + $session['delivery_cost']) * 100;
	$_POST['p24_currency'] = 'PLN';

	$_POST['env'] = $settings->p24_sandbox;
	$_POST['salt'] = $settings->p24_crc;
	
	$_POST['p24_sign'] = md5(session_id() . '|'.$settings->p24_id.'|' . $_POST['p24_amount'] . '|' . $_POST['p24_currency'] . '|'.$settings->p24_crc);


	if (isset($post['message']) && $post['message'] != null) {
		$_POST['p24_description'] = $post['message'];
	} else {
		$_POST['p24_description'] = 'brak opisu';
	}

	$_POST['p24_url_status'] = base_url('p24/status/' . $transaction_id);
	$_POST['p24_url_return'] = base_url('dziekujemy');
	$_POST['p24_api_version'] = '3.2';
	$_POST['p24_quantity_1'] = count($CI->cart->contents());
	$_POST['p24_wait_for_result'] = 0;

	return $_POST;
}