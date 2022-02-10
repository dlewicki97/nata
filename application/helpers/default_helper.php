<?php
defined('BASEPATH') or exit('No direct script access allowed');

function loadDefaultData()
{
	$CI = &get_instance();
	$data['mails'] = $CI->back_m->get_all('mails');
	$data['user'] = $CI->back_m->get_one('users', $_SESSION['id']);
	$data['media'] = $CI->back_m->get_all('media');
	$data['settings'] = $CI->back_m->get_one('settings', 1);
	$data['invoice_settings'] = $CI->back_m->get_one('shop_settings', 1);
	$data['contact'] = $CI->back_m->get_one('contact_settings', 1);
	$data['groups'] = $CI->back_m->get_all('clients_groups');

	if ($CI->uri->segment(2) != 'products') {

		unset($_COOKIE['panelProductsCount']);
		setcookie('panelProductsCount', null, -1, '/');
		unset($_COOKIE['panelProductsSearch']);
		setcookie('panelProductsSearch', null, -1, '/');
	}

	return $data;
}

function loadDefaultDataFront()
{

	$CI = &get_instance();
	$CI->load->helper('icons');
	$CI->load->helper('headers');
	$CI->load->helper('scripts');

	$data['settings'] = $CI->back_m->get_one('settings', 1);
	$data['contact'] = $CI->back_m->get_one('contact_settings', 1);

	$data['logo_header'] = $CI->back_m->get_one('logos', 1);
	$data['logo_footer'] = $CI->back_m->get_one('logos', 1);
	$data['code_header'] = $CI->back_m->get_one('scripts_editor', 1);
	$data['code_footer'] = $CI->back_m->get_one('scripts_editor', 2);
	$data['code_product'] = $CI->back_m->get_one('scripts_editor', 3);
	$data['code_cart'] = $CI->back_m->get_one('scripts_editor', 4);
	$data['code_summary'] = $CI->back_m->get_one('scripts_editor', 5);
	$data['menu'] = $CI->back_m->get_all_priority('subpages');
	$data['categories'] = $CI->back_m->get_all_priority('categories');
	$data['services'] = $CI->back_m->get_all('services');
	$data['header_handmades'] = $CI->back_m->get_all_where('handmades', 'menu', 1);
	$data['subcategory'] = $CI->back_m->get_all_priority('subcategory');
	$data['subpages'] = $CI->back_m->get_all_priority('subpages', 'active');
	$data['subpage_lists'] = $CI->back_m->get_all_priority('subpage_lists');
	$data['icons'] = load_icons();
	$data['newsletter_desc'] = $CI->back_m->get_one('newsletter_desc', 1);
	$data['footer'] = $CI->back_m->get_all_priority('footer');
	$data['footer_lists'] = $CI->back_m->get_all_priority('footer_lists');
	$data['headers'] = load_headers();
	$data['scripts_editor'] = load_scripts();
	$data['lightbox_links'] = ['aktualnosci', 'o-nas', 'blog', 'uslugi', 'produkcja-wlasna', 'galeria'];
	$data['auth_links'] = ['logowanie', 'rejestracja', 'resetowanie-hasla'];

	if ($CI->uri->segment(1) == 'produkt') {
		$seo = $CI->back_m->get_one('products', $CI->uri->segment(3));
		$data['current_subpage'] = $seo;
		$data['meta_title'] = $seo->title_seo;
		$data['meta_description'] = $seo->description_seo;
	} else {
		$seo = $CI->back_m->get_where('subpages', 'link', $CI->uri->segment(1) ? $CI->uri->segment(1) : "");
		$data['current_subpage'] = $seo;
		$data['meta_title'] = $seo->title;
		$data['meta_description'] = $seo->meta_description;
	}
	$data['breadcrumb'] = $CI->back_m->get_one('breadcrumb', 1);





	return $data;
}


function updateStatusTransaction($transaction_id, $status)
{
	$insert['status'] = $status;
	$CI = &get_instance();
	$CI->back_m->update('transaction', $insert, $transaction_id);
}
