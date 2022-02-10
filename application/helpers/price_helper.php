<?php
defined('BASEPATH') or exit('No direct script access allowed');

function price_text(object $product, $price, $rl_price = '', $enter = ''): string
{
	$CI = &get_instance();
	$CI->load->model('margin_m');

	$old_price = $price;

	$price_format = number_format($price, 2);
	$margin = $CI->margin_m->get($price_format);



	if ($margin) {
		$price = $price * ((100 + (int)$margin->margin) / 100);
		$price = (float)$price;
		$old_price = $price;
	}

	if (
		$product->promo_active == 1 &&
		$product->promo_start <= date('Y-m-d') &&
		$product->promo_end >= date('Y-m-d')
	) {
		$price *= ((100 - $product->promo_discount) / 100);
	} else if (isset($_SESSION['discount']) && $_SESSION['discount'] > 0) {
		$price *= ((100 - $_SESSION['discount']) / 100);
	}

	ob_start();
	var_dump(['margin' => $margin->margin, 'old_price' => $old_price, 'price' => $price]);
	// var_dump($CI->db->last_query());
	$result = ob_get_clean();
	echo "<pre class=\"d-none\">$result</pre>";

	$price_format = number_format($price, 2);

	if ((float)$old_price != (float)$price && (float)$old_price) {
		$print_price = '<s class="product-card-price--old-price d-block"><small class="mr-2">' . number_format($old_price, 2) . ' zł</small></s>' . $enter . str_replace(',', '', $price_format) . ' zł';
	} else {
		$print_price = str_replace(',', '', $price_format) . ' zł';
	}

	return "$print_price BRUTTO";
}

function price_cart($price, $rl_price = '', $enter = '')
{
	$price = (float)$price;

	if ($rl_price != $price && $rl_price != '') {

		$print_price = '<s class="product-card-price--old-price"><small class="mr-2">' . str_replace(',', '', $rl_price) . ' zł</small></s>' . $enter . str_replace(',', '', number_format($price, 2)) . ' zł';
	} else {

		$print_price = str_replace(',', '', number_format($price, 2)) . ' zł';
	}
	return $print_price;
}

function single_price_cart(float $price): string
{
	$CI = &get_instance();
	$CI->load->model('margin_m');

	// $margin = $CI->margin_m->get($price);
	// if ($margin) $price = ((float)str_replace(',', '', $price)) * ((100 + $margin->margin) / 100);

	return str_replace(',', '', number_format($price, 2)) . ' zł';
}

function price(object $product, $price, $numbers = 2): string
{
	$CI = &get_instance();
	$CI->load->model('margin_m');

	if (
		$product->promo_active == 1 &&
		$product->promo_start <= date('Y-m-d') &&
		$product->promo_end >= date('Y-m-d')
	) {
		$price *= ((100 - $product->promo_discount) / 100);
	} else if (isset($_SESSION['discount']) && $_SESSION['discount'] > 0) {
		$price *=  ((100 - $_SESSION['discount']) / 100);
	}

	$margin = $CI->margin_m->get($price);
	if ($margin) $price = ((float)str_replace(',', '', $price)) * ((100 + $margin->margin) / 100);

	return str_replace(',', '', number_format($price, $numbers)) .  " BRUTTO";
}

function price_summary($rl_price, $price, $delivery_cost)
{
	$CI = &get_instance();

	echo "<pre class=\"d-none\">$rl_price, $price, $delivery_cost</pre>";



	if ($rl_price != $price) {
		$print_price = '<s class="product-card-price--old-price"><small class="mr-2">' . str_replace(',', '', number_format($rl_price + $delivery_cost, 2)) . ' zł</small></s><br>' . str_replace(',', '', number_format($price + $delivery_cost, 2)) . ' zł';
	} else {
		$print_price = str_replace(',', '', number_format($price + $delivery_cost, 2)) . ' zł';
	}
	return $print_price;
}

function price_format($price)
{
	$CI = &get_instance();
	$CI->load->model('margin_m');

	$margin = $CI->margin_m->get($price);
	if ($margin) $price = ((float)str_replace(',', '', $price)) * ((100 + $margin->margin) / 100);

	return str_replace(',', '', number_format($price, 2));
}