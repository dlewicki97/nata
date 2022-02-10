<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imports_lib  
{
	private $CI;

	public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->model('products_m');
	}

	public function get_products($products) {
		$row = 1;
		if (($handle = fopen($products, "r")) !== FALSE) {
		  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		    $num = count($data);
		    echo "<p> $num fields in line $row: <br /></p>\n";
		    $row++;
		    for ($c=0; $c < $num; $c++) {
		        echo $data[$c] . "<br />\n";
		    }
		  }
		  fclose($handle);
		}
	}



}