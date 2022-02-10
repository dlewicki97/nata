<?php
defined('BASEPATH') or exit('No direct script access allowed');



function addTransaction($post, $session)
{

	$CI = &get_instance();
	$product_id = '';
	$name = '';
	$photo = '';
	$qty = '';
	$price = '';
	$price_brutto = '';
	$price_netto = '';
	// $promo_price_brutto = '';
	// $promo_price_netto = '';
	$price_hurt_brutto = '';
	$price_hurt_netto = '';
	$promo_active = '';
	$weight = '';
	$length = '';
	$width = '';
	$height = '';
	$delivery_cost = '';
	$barcode = '';
	$one_in_cart = '';
	$additional_parameters = '';
	$additional_parameters_2 = '';
	$suma = 0;
	foreach ($CI->cart->contents() as $value) {
		$product = $CI->back_m->get_one('products', $value['product_id']);
		$product_id .= $value['product_id'] . '|';
		$name .= $value['name'] . '|';
		$photo .= $product->photo . '|';
		$qty .= $value['qty'] . '|';
		$price .= $value['price'] . '|';
		$price_brutto .= $product->price_brutto . '|';
		$price_netto .= $product->price_netto . '|';
		// $promo_price_brutto .= $product->promo_price_brutto . '|';
		// $promo_price_netto .= $product->promo_price_netto . '|';
		$price_hurt_brutto .= $product->price_hurt_brutto . '|';
		$price_hurt_netto .= $product->price_hurt_netto . '|';
		$promo_active .= $value['promo_active'] . '|';
		$weight .= $product->weight . '|';
		$length .= $product->length . '|';
		$width .= $product->width . '|';
		$height .= $product->height . '|';
		$delivery_cost .= $product->delivery_cost . '|';
		$barcode .= $value['barcode'] . '|';
		$one_in_cart .= $product->one_in_cart . '|';
		$suma += $value['price'] * $value['qty'];
	}
	$product_id = rtrim($product_id, "|");
	$name = rtrim($name, "|");
	$photo = rtrim($photo, "|");
	$qty = rtrim($qty, "|");
	$price = rtrim($price, "|");
	$price_brutto = rtrim($price_brutto, "|");
	$price_netto = rtrim($price_netto, "|");
	// $promo_price_brutto = rtrim($promo_price_brutto, "|");
	// $promo_price_netto = rtrim($promo_price_netto, "|");
	$price_hurt_brutto = rtrim($price_hurt_brutto, "|");
	$price_hurt_netto = rtrim($price_hurt_netto, "|");
	$promo_active = rtrim($promo_active, "|");
	$weight = rtrim($weight, "|");
	$length = rtrim($length, "|");
	$width = rtrim($width, "|");
	$height = rtrim($height, "|");
	$delivery_cost = rtrim($delivery_cost, "|");
	$barcode = rtrim($barcode, "|");
	$one_in_cart = rtrim($one_in_cart, "|");

	if ($CI->session->userdata('client')) {
		$_POST['client_id'] = $CI->session->userdata('client')->id;
	}

	$_POST['product_id'] = $product_id;
	$_POST['name'] = $name;
	$_POST['photo'] = $photo;
	$_POST['qty'] = $qty;
	$_POST['price'] = $price;
	$_POST['price_brutto'] = $price_brutto;
	$_POST['price_netto'] = $price_netto;
	// $_POST['promo_price_brutto'] = $promo_price_brutto;
	// $_POST['promo_price_netto'] = $promo_price_netto;
	$_POST['price_hurt_brutto'] = $price_hurt_brutto;
	$_POST['price_hurt_netto'] = $price_hurt_netto;
	$_POST['promo_active'] = $promo_active;
	$_POST['weight'] = $weight;
	$_POST['length'] = $length;
	$_POST['width'] = $width;
	$_POST['height'] = $height;
	$_POST['delivery_cost'] = $delivery_cost;
	$_POST['barcode'] = $barcode;
	$_POST['one_in_cart'] = $one_in_cart;
	$_POST['additional_parameters'] = $additional_parameters;
	$_POST['additional_parameters_2'] = $additional_parameters_2;

	$_POST['first_name'] = $session['first_name'];
	$_POST['last_name'] = $session['last_name'];
	$_POST['email'] = $session['email'];
	$_POST['phone'] = $session['phone'];
	$_POST['country'] = $session['country'];
	$_POST['city'] = $session['city'];
	$_POST['zipcode'] = $session['zipcode'];
	$_POST['street'] = $session['street'];
	$_POST['housenumber'] = $session['housenumber'];

	if (isset($session['flatnumber']) && $session['flatnumber'] != null) {
		$_POST['flatnumber'] = $session['flatnumber'];
	}
	if (isset($session['company']) && $session['company'] != null) {
		$_POST['company'] = $session['company'];
	}
	if (isset($session['nip']) && $session['nip'] != null) {
		$_POST['nip'] = $session['nip'];
	}
	if (isset($session['zipcode_company']) && $session['zipcode_company'] != null) {
		$_POST['zipcode_company'] = $session['zipcode_company'];
	}
	if (isset($session['city_company']) && $session['city_company'] != null) {
		$_POST['city_company'] = $session['city_company'];
	}
	if (isset($session['address_company']) && $session['address_company'] != null) {
		$_POST['address_company'] = $session['address_company'];
	}
	if (isset($session['country_company']) && $session['country_company'] != null) {
		$_POST['country_company'] = $session['country_company'];
	}
	if (isset($session['discount']) && $session['discount'] != null) {
		$_POST['discount'] = $session['discount'];
	}
	if (isset($session['discount_value']) && $session['discount_value'] != null) {
		$_POST['discount_value'] = $session['discount_value'];
	}
	if (isset($session['discount_type']) && $session['discount_type'] != null) {
		$_POST['discount_type'] = $session['discount_type'];
	}
	if (isset($session['used_discount']) && $session['used_discount'] != null) {
		$_POST['used_discount'] = $session['used_discount'];
	}
	if (isset($_SESSION['client_login']) && $_SESSION['client_login'] === true && isset($_SESSION['type_client']) && $_SESSION['type_client'] != null) {
		$_POST['type_client'] = $_SESSION['type_client'];
	}
	if (isset($session['delivery']) && $session['delivery'] != null) {
		$_POST['delivery'] = $session['delivery'];
	}
	if (isset($session['delivery_cost']) && $session['delivery_cost'] != null) {
		$_POST['delivery_cost'] = $session['delivery_cost'];
	}
	if (isset($session['delivery_cost_on_delivery']) && $session['delivery_cost_on_delivery'] != null) {
		$_POST['delivery_cost_on_delivery'] = $session['delivery_cost_on_delivery'];
	}
	if (isset($session['payment']) && $session['payment'] != null) {
		$_POST['payment'] = $session['payment'];
	}
	if (isset($session['inpost_code']) && $session['inpost_code'] != null) {
		$_POST['inpost_code'] = $session['inpost_code'];
		$_POST['inpost_parcel'] = $session['inpost_parcel'];
	}

	$_POST['suma'] = $suma + $_POST['delivery_cost'];

	foreach ($_POST as $key => $value) {
		if (!$CI->db->field_exists($key, 'transaction')) {
			$CI->base_m->create_column('transaction', $key);
		}
	}
	if ($CI->back_m->insert('transaction', $_POST)) {
		$last_id = $CI->db->insert_id();
		sendTransaction($last_id);
		return $last_id;
	}
	return false;
}

function sendTransaction($last_id)
{

	$CI = &get_instance();
	$data['contact'] = $CI->back_m->get_one('contact_settings', 1);
	$data['settings'] = $CI->back_m->get_one('settings', 1);

	$paymentType['tradycyjny'] = 'Przelew tradycyjny';
	$paymentType['p24'] = 'Przelewy24';
	$paymentType['payu'] = 'PayU';
	$paymentType['pobranie'] = 'Płatność za pobraniem';
	$paymentType['odbiorze'] = 'Płatność przy odbiorze';
	$deliveryType['kurier'] = 'Kurier';
	$deliveryType['pobranie'] = 'Kurier za pobraniem';
	$deliveryType['osobisty'] = 'Odbiór osobisty';
	$deliveryType['paczkomat'] = 'Paczkomat';
	$deliveryType['paczkomat_pobranie'] = 'Paczkomat pobranie';

	$transaction = $CI->back_m->get_one('transaction', $last_id);

	$discount_type[0] = '%';
	$discount_type[1] = 'PLN';

	$_POST['base_url'] = base_url();
	$_POST['company'] = $data['contact']->company;
	$_POST['logo'] = $data['settings']->logo_mail;

	$_POST['first_name'] = $transaction->first_name;
	$_POST['last_name'] = $transaction->last_name;
	$_POST['email'] = $transaction->email;
	$_POST['phone'] = $transaction->phone;
	$_POST['country'] = $transaction->country;
	$_POST['city'] = $transaction->city;
	$_POST['zipcode'] = $transaction->zipcode;
	$_POST['street'] = $transaction->street;
	$_POST['housenumber'] = $transaction->housenumber;
	if ($transaction->flatnumber != null) {
		$_POST['flatnumber'] = '/' . $transaction->flatnumber;
	} else {
		$_POST['flatnumber'] = '';
	}

	if ($transaction->company != null) {
		$_POST['company_client'] = '<p>Nazwa firmy: <br><b>' . $transaction->company . '</b></p>';
	} else {
		$_POST['company_client'] = '';
	}
	if ($transaction->nip != null) {
		$_POST['nip'] = '<p>NIP: <br><b>' . $transaction->nip . '</b></p>';
	} else {
		$_POST['nip'] = '';
	}
	if ($transaction->country_company != null) {
		$_POST['address_company'] = '<p>Adres firmy: <br><b>' . $transaction->country_company . ', ' . $transaction->city_company . ' ' . $transaction->zipcode_company . '<br>' . $transaction->address_company . '</b></p>';
	} else {
		$_POST['address_company'] = '';
	}

	if ($transaction->discount > 0 && $transaction->discount != null) {
		$_POST['discount'] = '<p>Zniżka: <br><b>' . $transaction->discount . '%</b></p>';
	} else if ($transaction->discount_value > 0 && $transaction->discount_value != null) {
		$_POST['discount'] = '<p>Zniżka: <br><b>' . $transaction->discount_value . ' ' . $discount_type[$transaction->discount_value] . '</b> Użyty kod rabatowy: ' . $transaction->used_discount . '</b></p>';
	} else {
		$_POST['discount'] = '';
	}

	$_POST['delivery'] = $deliveryType[$transaction->delivery];
	$_POST['delivery_cost'] = $transaction->delivery_cost;
	$_POST['payment'] = $paymentType[$transaction->payment];
	$_POST['suma'] = single_price_cart($transaction->suma);

	if ($transaction->payment_url != null && $transaction->paid == 0) {
		$_POST['payment_url'] = '<div style="text-align: center; margin: 40px auto 20px auto;"><a href="' . $transaction->payment_url . '" style="background-color: #225d93; padding: 15px; color: #fff; box-shadow: 0 .5rem 1rem rgba(0,0,0,.15);">ZAPŁAĆ ZA ZAMÓWIENIE</a></div>';
	} elseif ($transaction->payment == 'tradycyjny' && $transaction->paid == 0) {
		$_POST['payment_url'] = '<br><hr><br>Prosimy o wpłatę kwoty <strong>' . $_POST['suma'] . '</strong> PLN na numer konta:<br><strong>' . $data['settings']->bank_account . '</strong><br>Do tytułu przelewu prosimy wpisać - <strong>' . $_POST['first_name'] . ' ' . $_POST['last_name'] . ' ' . date('d.m.Y', strtotime($transaction->created)) . '</strong><br>Po zaksięgowaniu wpłaty zamówienie zostanie zrealizowane.<br><br><hr><br>';
	} else {
		$_POST['payment_url'] = '';
	}

	$_POST['cart'] = '<table style="width: 100%; border-spacing: 0; font-size: 10px">';
	$_POST['sumaCart'] = 0;

	$price = explode('|', $transaction->price);
	$qty = explode('|', $transaction->qty);
	$photo = explode('|', $transaction->photo);
	$name = explode('|', $transaction->name);
	$additional_parameters = explode('|', $transaction->additional_parameters);
	$additional_parameters_2 = explode('|', $transaction->additional_parameters_2);

	foreach (explode('|', $transaction->product_id) as $k => $v) {
		$_POST['sumaCart'] += $price[$k] * $qty[$k];
		if ($k % 2 == 0) {
			$_POST['cart'] .= '<tr>';
		} else {
			$_POST['cart'] .= '<tr style="background: #eaeaea;">';
		}
		if (isset($photo[$k])) $_POST['cart'] .= '<td style="padding: 10px;"><img src="' . $photo[$k] . '" width="128" /></td>';
		if (isset($name[$k])) $_POST['cart'] .= '<td>' . $name[$k] . '</td>';
		if (isset($additional_parameters[$k])) $_POST['cart'] .= '<td>Dodatkowa opcja: ' . $additional_parameters[$k] . '</td>';
		if (isset($additional_parameters_2[$k])) $_POST['cart'] .= '<td>Dodatkowa opcja: ' . $additional_parameters_2[$k] . '</td>';
		$_POST['cart'] .= '<td>Ilość: ' . $qty[$k] . ' szt.<br>Cena jedn.: ' . single_price_cart($price[$k]) . ' PLN</td>';
		$_POST['cart'] .= '<td>' . single_price_cart($price[$k] * $qty[$k]) . ' PLN</td>';
		$_POST['cart'] .= '</tr>';
	}
	$_POST['cart'] .= '</table>';
	$_POST['sumaCart'] = single_price_cart($_POST['sumaCart']);

	require 'application/libraries/mailer/config.php';
	require 'application/libraries/mailer/functions.php';
	require 'application/libraries/mailer/PHPMailerAutoload.php';
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
	$mail->setFrom($cfg['smtp_user'], $data['contact']->company .  ' - Twoje zamówienie');
	$mail->AddBCC($_POST['email']);
	$mail->AddBCC($data['contact']->email3);
	if (!empty($_POST['email'])) {
		$mail->addReplyTo($_POST['email']);
	}
	$mail->isHTML(true);
	$mail->CharSet = 'UTF-8';
	$now = date('Y-m-d');
	$mail->Subject = $data['contact']->company .  " - Zamówienie nr #$transaction->id z dnia $now - $transaction->first_name $transaction->last_name";
	$mail->Body    = build_mail_body($_POST, 'order.php');
	if (!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		exit;
	}
}

function sendChange($id)
{
	require 'application/libraries/mailer/config.php';
	require 'application/libraries/mailer/functions.php';
	require 'application/libraries/mailer/PHPMailerAutoload.php';
	$CI = &get_instance();
	$data['contact'] = $CI->back_m->get_one('contact_settings', 1);
	$data['settings'] = $CI->back_m->get_one('settings', 1);

	$status[0] = 'w trakcie realizacji';
	$status[1] = 'Anulowane przez administratora';
	$status[2] = 'Anulowane przez klienta';
	$status[3] = 'Zatwierdzone';
	$status[4] = 'Wysłane';
	$status[5] = 'Zrealizowane';

	$paymentType['tradycyjny'] = 'Przelew tradycyjny';
	$paymentType['p24'] = 'Przelewy24';
	$paymentType['payu'] = 'PayU';
	$paymentType['pobranie'] = 'Płatność za pobraniem';
	$paymentType['odbiorze'] = 'Płatność przy odbiorze';
	$deliveryType['kurier'] = 'Kurier';
	$deliveryType['pobranie'] = 'Kurier za pobraniem';
	$deliveryType['osobisty'] = 'Odbiór osobisty';
	$transaction = $CI->back_m->get_one('transaction', $id);

	$_POST['base_url'] = base_url();
	$_POST['company'] = $data['contact']->company;
	$_POST['logo'] = $data['settings']->logo_mail;
	$_POST['nr_order'] = $transaction->id;
	$_POST['first_name'] = $transaction->first_name;
	$_POST['last_name'] = $transaction->last_name;
	$_POST['email'] = $transaction->email;
	$_POST['phone'] = $transaction->phone;
	$_POST['country'] = $transaction->country;
	$_POST['city'] = $transaction->city;
	$_POST['zipcode'] = $transaction->zipcode;
	$_POST['street'] = $transaction->street;
	$_POST['housenumber'] = $transaction->housenumber;
	if ($transaction->flatnumber != null) {
		$_POST['flatnumber'] = '/' . $transaction->flatnumber;
	} else {
		$_POST['flatnumber'] = '';
	}

	if ($transaction->company != null) {
		$_POST['company_client'] = '<p>Nazwa firmy: <br><b>' . $transaction->company . '</b></p>';
	} else {
		$_POST['company_client'] = '';
	}
	if ($transaction->nip != null) {
		$_POST['nip'] = '<p>NIP: <br><b>' . $transaction->nip . '</b></p>';
	} else {
		$_POST['nip'] = '';
	}
	if ($transaction->country_company != null) {
		$_POST['address_company'] = '<p>Adres firmy: <br><b>' . $transaction->country_company . ', ' . $transaction->city_company . ' ' . $transaction->zipcode_company . '<br>' . $transaction->address_company . '</b></p>';
	} else {
		$_POST['address_company'] = '';
	}

	if ($transaction->discount > 0 && $transaction->discount != null) {
		$_POST['discount'] = '<p>Zniżka: <br><b>' . $transaction->discount . '%</b></p>';
	} else if ($transaction->discount_value > 0 && $transaction->discount_value != null) {
		$_POST['discount'] = '<p>Zniżka: <br><b>' . $transaction->discount_value . ' ' . $discount_type[$transaction->discount_value] . '</b> Użyty kod rabatowy: ' . $transaction->used_discount . '</b></p>';
	}

	$_POST['delivery'] = $deliveryType[$transaction->delivery];
	$_POST['delivery_cost'] = $transaction->delivery_cost;
	$_POST['status'] = $status[$transaction->status];
	$_POST['payment'] = $paymentType[$transaction->payment];
	$_POST['suma'] = number_format($transaction->suma, 2);

	if ($transaction->payment_url != null && $transaction->paid == 0) {
		$_POST['payment_url'] = '<div style="text-align: center; margin: 40px auto 20px auto;"><a href="' . $transaction->payment_url . '" style="background-color: #225d93; padding: 15px; color: #fff; box-shadow: 0 .5rem 1rem rgba(0,0,0,.15);">ZAPŁAĆ ZA ZAMÓWIENIE</a></div>';
	} elseif ($transaction->payment == 'tradycyjny' && $transaction->paid == 0) {
		$_POST['payment_url'] = '<br><hr><br>Prosimy o wpłatę kwoty <strong>' . $_POST['suma'] . '</strong> PLN na numer konta:<br><strong>' . $data['settings']->bank_account . '</strong><br>Do tytułu przelewu prosimy wpisać - <strong>' . $_POST['first_name'] . ' ' . $_POST['last_name'] . ' ' . date('d.m.Y', strtotime($transaction->created)) . '</strong><br>Po zaksięgowaniu wpłaty zamówienie zostanie zrealizowane.<br><br><hr><br>';
	} else {
		$_POST['payment_url'] = '';
	}

	$_POST['cart'] = '<table style="width: 100%; border-spacing: 0; font-size: 10px">';
	$_POST['sumaCart'] = 0;
	foreach (explode('|', $transaction->product_id) as $k => $v) {
		$_POST['sumaCart'] += explode('|', $transaction->price)[$k] * explode('|', $transaction->qty)[$k];
		if ($k % 2 == 0) {
			$_POST['cart'] .= '<tr>';
		} else {
			$_POST['cart'] .= '<tr style="background: #eaeaea;">';
		}
		$_POST['cart'] .= '<td style="padding: 10px;"><img src="' . explode('|', $transaction->photo)[$k] . '" width="128" /></td>';
		$_POST['cart'] .= '<td>' . explode('|', $transaction->name)[$k] . '</td>';
		$_POST['cart'] .= '<td>Dodatkowa opcja: ' . explode('|', $transaction->additional_parameters)[$k] . '</td>';
		$_POST['cart'] .= '<td>Dodatkowa opcja: ' . explode('|', $transaction->additional_parameters_2)[$k] . '</td>';
		$_POST['cart'] .= '<td>Ilość: ' . explode('|', $transaction->qty)[$k] . ' szt.<br>Cena jedn.: ' . explode('|', $transaction->price)[$k] . ' PLN</td>';
		$_POST['cart'] .= '<td>' . explode('|', $transaction->price)[$k] * explode('|', $transaction->qty)[$k] . ' PLN</td>';
		$_POST['cart'] .= '</tr>';
	}
	$_POST['cart'] .= '</table>';
	$_POST['sumaCart'] = number_format($_POST['sumaCart'], 2);
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
	if ($transaction->status == 3) {
		$_POST['status_title'] = 'Twoje zamówienie NR.' . $transaction->id . ' zostało przekazane do realizacji';
		$_POST['status_desc'] = 'Poinformujemy Cię, gdy zostanie skompletowane i przekazane do wysyłki';
		$mail->setFrom($cfg['smtp_user'], $data['contact']->company . ' - Przekazane do realizacji');
	} elseif ($transaction->status == 5) {
		$_POST['status_title'] = 'Twoje zamówienie NR.' . $transaction->id . ' zostało zrealizowane';
		$_POST['status_desc'] = '';
		$mail->setFrom($cfg['smtp_user'], $data['contact']->company . ' - Zrealizowane');
	} else {
		$_POST['status_desc'] = '';
		$_POST['status_title'] = 'Twoje zamówienie  NR.' . $transaction->id . ' zostało ' . $status[$transaction->status];
		$mail->setFrom($cfg['smtp_user'], $data['contact']->company . ' - ' . $status[$transaction->status]);
	}
	$mail->AddBCC($_POST['email']);
	// $mail->AddBCC('k.zygadlo@adawards.pl');
	// $mail->AddBCC('karol.zygadlo9713@gmail.com');
	$mail->isHTML(true);
	$mail->CharSet = 'UTF-8';
	if ($transaction->status == 3) {
		$mail->Subject = $data['contact']->company .  ' Zmiana statusu zamówienia - Przekazane do realizacji';
	} elseif ($transaction->status == 5) {
		$mail->Subject = $data['contact']->company .  ' Zmiana statusu zamówienia - Zrealizowane';
	} else {
		$mail->Subject = $data['contact']->company . ' Zmiana statusu zamówienia - ' . $status[$transaction->status];
	}

	$mail->Body = build_mail_body($_POST, 'status_order.php');
	if (!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		exit;
	}
}