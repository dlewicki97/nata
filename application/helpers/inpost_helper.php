<?php
defined('BASEPATH') or exit('No direct script access allowed');

function getReciver($transaction)
{
	$reciver = array(
		'receiver' => array(
			'name' 			=> $transaction->name,
			'company_name' 	=> $transaction->company,
			'first_name' 	=> $transaction->first_name,
			'last_name' 	=> $transaction->last_name,
			'email' 		=> $transaction->email,
			'phone' 		=> str_replace(' ', '', $transaction->phone),
			'address' 		=> array(
				'street' 			=> $transaction->street,
				'building_number' 	=> $transaction->housenumber,
				'city' 				=> $transaction->city,
				'post_code' 		=> $transaction->zipcode,
				'country_code' 		=> $transaction->country
			)
		)
	);
	return $reciver;
}

function getParcels($transaction, $post)
{
	$parcels = [
		'parcels' => [
			// [
			'id' 			=> $post['package_size'] . ' package',
			'dimensions' 	=> [
				'length' 		=> (float)($post['length'] * 10),
				'width' 		=> (float)($post['width'] * 10),
				'height' 		=> (float)($post['height'] * 10),
				'unit' 			=> 'mm'
			],
			'weight' 		=> [
				'amount' 		=> $post['weight'],
				'unit' 			=> 'kg'
			],
			'is_non_standard' => false
			// ]
		]
	];
	return $parcels;
}

function getInsurance($transaction)
{
	$insurance = array(
		'insurance' => array(
			'amount'	=> round($transaction->suma) ? round($transaction->suma) : 1,
			'currency'	=> 'PLN'
		)
	);
	return $insurance;
}

function getCod($transaction)
{
	$cod = array(
		'cod' => array(
			'amount' 	=> number_format($transaction->suma),
			'currency'	=> 'PLN'
		)
	);
	return $cod;
}

function getCustomAttributes($transaction, $post)
{
	if ($post['package_type'] == 'inpost_locker_standard') {
		$custom_attributes = array(
			'custom_attributes' => array(
				'target_point' => $transaction->inpost_code, //$transaction->inpost_code,
				'dropoff_point' => $post['dropoff_point'] //$post['pacz_code'],
			)
		);
	} else {
		$custom_attributes = array(
			'custom_attributes' => array(
				'sending_method' => 'dispatch_order'
			)
		);
	}
	return $custom_attributes;
}

function getAdditionalServices($transaction, $post, $service)
{
	$additionals = array(
		'service' => $service,
		'reference' => $post['comment'],
		'comments'	=> $post['comment'],
		'external_customer_id'	=> '8877' . $transaction->id . rand(0, 999999999999),
	);
	return $additionals;
}