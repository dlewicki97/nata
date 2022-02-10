<?php
defined('BASEPATH') or exit('No direct script access allowed');

function checkAvailable($id, $one_in_cart, $availableQty, $qty)
{
	$CI = &get_instance();
	if (empty($CI->cart->contents())) {
		if ($one_in_cart == 0) {
			if ($availableQty >= $qty) {
				return true;
			}
			return 'Brak odpowiedniej ilości tego produktu w magazynie.';
		} else {
			if ($qty == 1) {
				return true;
			}
			return 'Produkt tego typu może być wyłącznie tylko jeden w koszyku.';
		}
	} else {
		if ($one_in_cart == 0) {
			foreach ($CI->cart->contents() as $k => $v) {
				if ($v['product_id'] == $id && @$v['one_in_cart'] == 0) {
					if (($v['qty'] + $qty) <= $availableQty) {
						return true;
					}
					return 'Brak odpowiedniej ilości tego produktu w magazynie lub w koszyku może znajdować się tylko jeden produkt tego typu.';
				}
			}
			return true;
		}
		return 'Produkt tego typu może być wyłącznie tylko jeden w koszyku.';
	}
}

function availableProduct($cart = [])
{
	$CI = &get_instance();
	$cart || $cart = $CI->cart->contents();
	foreach ($cart as $v) {
		$variant = $CI->shop_m->variant('variants', $v['product_id']);
		if ($v['qty'] > $variant->qty) {
			$CI->session->set_flashdata('flashdata_false', 'Zmienił się stan magazynowy produktu ' . $v['name']);
			$cart_list = array(
				'rowid'   => $v['rowid'],
				'qty'     => $variant->qty,
			);
			$CI->cart->update($cart_list);
		}
	}
}

function emptyCart()
{
	$CI = &get_instance();
	if (empty($CI->cart->contents())) {
		$CI->session->set_flashdata('flashdata_false', '<p class="text-danger font-weight-bold mb-0">Twój koszyk jest pusty.</p>');
		redirect('');
	}
	return false;
}

function clearCart()
{
	$CI = &get_instance();
	$CI->load->helper('variants');
	foreach ($CI->cart->contents() as $v) {
		decrementVariant($v['product_id'], $v['qty']);
		$CI->cart->remove($v['rowid']);
	}
}
function getMaximumBoxWeight(): int
{
	return 30;
}

function getBoxes(): int
{
	$CI = &get_instance();
	$product_min_weight_to_box = $CI->back_m->get_one('product_min_weight_to_box', 1);

	$complete_boxes = 0;
	$rest_weight = 0.0;
	foreach ($CI->cart->contents() as $product) {
		$db_product = $CI->back_m->get_one('products', $product['product_id']);
		if ($db_product->karton && $product['qty'] % $db_product->karton === 0 && $db_product->weight >= $product_min_weight_to_box->weight) $complete_boxes += round($product['qty'] / $db_product->karton);
		else $rest_weight += ($product['qty'] * $db_product->weight_opak);
	}

	$boxes = $complete_boxes + ceil($rest_weight / getMaximumBoxWeight());

	return $boxes ? $boxes : 1;
}
