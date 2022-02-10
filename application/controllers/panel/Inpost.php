<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inpost extends CI_Controller {

    public function create($id) {

    	$order = $this->back_m->get_one('transaction', $id);
    	$settings = $this->back_m->get_one('settings', 1);
    	$contact = $this->back_m->get_one('contact_settings', 1);
    	$inpost = $this->back_m->get_one('shop_settings', 1);

		$sandbox = false;
		if ($sandbox == true) {
		    $org_id = $inpost->inpost_login;
		    $token = $inpost->inpost_token;
			$url = 'https://sandbox-api-shipx-pl.easypack24.net/v1/organizations/'.$org_id.'/shipments';
		} else {
		    $org_id = $inpost->inpost_login;
		    $token = $inpost->inpost_token;
			$url = 'https://api-shipx-pl.easypack24.net/v1/organizations/'.$org_id.'/shipments';
		}

		if($order->payment != 'pobranie') {
		$payload = array(
			'receiver' => array(
				'name' 			=> $order->name,
				'company_name' 	=> $order->company,
				'first_name' 	=> $order->first_name,
				'last_name' 	=> $order->last_name,
				'email' 		=> $order->email,
				'phone' 		=> str_replace(' ', '', $order->phone),
				'address' 		=> array(
					'street' 			=> $order->street,
					'building_number' 	=> $order->housenumber,
					'city' 				=> $order->city,
					'post_code' 		=> $order->zipcode,
					'country_code' 		=> $order->country
				)
			),
			'parcels' => array(
				'id' 			=> 'small package',
				'dimensions' 	=> array(
					'length' 		=> $_POST['length'],
					'width' 		=> $_POST['width'],
					'height' 		=> $_POST['height'],
					'unit' 			=> 'mm'
				),
				'weight' 		=> array(
					'amount' 		=> $_POST['waga'],
					'unit' 			=> 'kg'
				),
				'is_non_standard' => false 
			),
			'insurance' => array(
				'amount'	=> $order->suma,
				'currency'	=> 'PLN'
			),
			'cod' => array(
				'amount' 	=> $order->suma,
				'currency'	=> 'PLN'
			),
			'custom_attributes'		=> array(
				'target_point' => $order->inpost_code,
        		'dropoff_point' => $_POST['pacz_code'],
			),
			'service' 				=> 'inpost_locker_standard',
			'reference' 			=> $id,
			'comments' 				=> $_POST['opis_kuriera'],
			'external_customer_id' 	=> '8877'.$id,
		);
		} else {
		$payload = array(
			'receiver' => array(
				'name' 			=> $order->name,
				'company_name' 	=> $order->company,
				'first_name' 	=> $order->first_name,
				'last_name' 	=> $order->last_name,
				'email' 		=> $order->email,
				'phone' 		=> str_replace(' ', '', $order->phone),
				'address' 		=> array(
					'street' 			=> $order->street,
					'building_number' 	=> $order->housenumber,
					'city' 				=> $order->city,
					'post_code' 		=> $order->zipcode,
					'country_code' 		=> $order->country
				)
			),
			'parcels' => array(
				'id' 			=> 'small package',
				'dimensions' 	=> array(
					'length' 		=> $_POST['length'],
					'width' 		=> $_POST['width'],
					'height' 		=> $_POST['height'],
					'unit' 			=> 'mm'
				),
				'weight' 		=> array(
					'amount' 		=> $_POST['waga'],
					'unit' 			=> 'kg'
				),
				'is_non_standard' => false 
			),
			'insurance' => array(
				'amount'	=> $order->suma,
				'currency'	=> 'PLN'
			),
			'custom_attributes'		=> array(
				'target_point' => $order->inpost_code,
        		'dropoff_point' => $_POST['pacz_code'],
			),
			'service' 				=> 'inpost_locker_standard',
			'reference' 			=> $id,
			'comments' 				=> $_POST['opis_kuriera'],
			'external_customer_id' 	=> '8877'.$id,
		);
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($payload));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Content-Type: application/json',
		    'Authorization: Bearer '.$token
		));
		$arr = curl_exec($ch);
		curl_close($ch);

		$jsonArrayResponse = json_decode($arr);
		//header('Content-Type: application/json');

		$insert['status'] = 4;
		$insert['order_id'] = $order->id;
		$insert['first_name'] = $order->first_name;
		$insert['last_name'] = $order->last_name;
		$insert['name'] = $order->name;
		$insert['package_id'] = $jsonArrayResponse->id;
		$this->back_m->insert('inpost_label', $insert);

		$insert2['status'] = 5;
		$this->back_m->update('transakcje', $insert2, $id);

		//sendPackage($id, $insert['package_id']); 
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function label($id) {
    	$inpost = $this->back_m->get_one('shop_settings', 1);
		$sandbox = false;
		if ($sandbox == true) {
		    $org_id = $inpost->inpost_login;
		    $token = $inpost->inpost_token;
			$url = 'https://sandbox-api-shipx-pl.easypack24.net/v1/organizations/'.$org_id.'/shipments/labels';
		} else {
		    $org_id = $inpost->inpost_login;
		    $token = $inpost->inpost_token;
			$url = 'https://api-shipx-pl.easypack24.net/v1/organizations/'.$org_id.'/shipments/labels';
		}


		$payload = array(
			'format' 		=> 'pdf',
			'shipment_ids' 	=> array(
				0 => $id
			),
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($payload));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Content-Type: application/json',
		    'Authorization: Bearer '.$token
		));
		$arr = curl_exec($ch);
		curl_close($ch);

		$jsonArrayResponse = json_decode($arr);
		header('Content-Type: application/pdf');
		header('Content-Disposition: inline; filename=test.pdf');
		echo $arr;
	}
}