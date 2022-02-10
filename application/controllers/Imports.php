<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imports extends CI_Controller {

	public function index() {
		$products = base_url('assets/products.csv');
		$this->load->library('imports_lib');
		$this->imports_lib->get_products($products);
	}

	public function categories() {
		
		$table = 'products';

		$this->load->model('products_m');

		$value = $this->back_m->get_one('products', 514);
		foreach ($products as $key => $value) {
			foreach (explode(',', $value->categories) as $v) {
				if ($v == 'Meble do salonu') {
					$category['category'] = 2;
					$category['subcategory'] = 4;
			    	$this->back_m->update($table, $category, $value->id);
				} else if ($v == 'Meble do biura') {
					$category['category'] = 3;
					$category['subcategory'] = 5;
			    	$this->back_m->update($table, $category, $value->id);
				} else if ($v == 'Meble do sypialni') {
					$category['category'] = 4;
					$category['subcategory'] = 2;
			    	$this->back_m->update($table, $category, $value->id);
				} else if ($v == 'Akcesoria') {
					$category['category'] = 7;
					$category['subcategory'] = 8;
			    	$this->back_m->update($table, $category, $value->id);
				} else if ($v == 'Meble tapicerowane') {
					$category['category'] = 4;
					$category['subcategory'] = 7;
			    	$this->back_m->update($table, $category, $value->id);
				} else if ($v == 'Meble kuchenne') {
					$category['category'] = 5;
					$category['subcategory'] = 11;
			    	$this->back_m->update($table, $category, $value->id);
				} else if ($v == 'Meble łazienkowe') {
					$category['category'] = 10;
					$category['subcategory'] = 12;
			    	$this->back_m->update($table, $category, $value->id);
				} else if ($v == 'Tekstylia') {
					$category['category'] = 7;
					$category['subcategory'] = 10;
			    	$this->back_m->update($table, $category, $value->id);
				} else if ($v == 'Zestawy') {
					$category['category'] = 9;
					$category['subcategory'] = 3;
			    	$this->back_m->update($table, $category, $value->id);
				} else if ($v == 'Meble młodzieżowe') {
					$category['category'] = 6;
					$category['subcategory'] = 1;
			    	$this->back_m->update($table, $category, $value->id);
				} else if ($v == 'Meble do salonu') {
					$category['category'] = 2;
					$category['subcategory'] = 4;
			    	$this->back_m->update($table, $category, $value->id);
				} else {
					$category['category'] = 9;
					$category['subcategory'] = 9;
			    	$this->back_m->update($table, $category, $value->id);
				}
			}
		}
	}

}