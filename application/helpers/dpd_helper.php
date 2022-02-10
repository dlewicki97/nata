<?php
defined('BASEPATH') or exit('No direct script access allowed');

function getServices($transaction, $post)
{
	if ($transaction->payment == 'pobranie') {
		$customerData1 = 'Przesyłka pobraniowa - ' . $post['message'];
		$services = [
			'cod' => [
				'amount' => $transaction->suma,
				'currency' => 'PLN',
			]
		];
	} else {
		$customerData1 = 'Przesyłka standardowa - ' . $post['message'];
		$services = [];
	}
	return array($customerData1, $services);
}

function getSender($dpdSettings, $contact)
{
	$sender = [
		// 'fid' => $dpdSettings->dpd_fid,
		// 'fid' => ((DPD_MODE == 'sandbox') ? DPD_SANDBOX_FID : DPD_LIVE_FID),
		'fid' => "1495",
		'name' => $contact->name,
		'company' => $contact->company ?? "",
		'address' => $contact->address,
		'city' => $contact->city,
		'postalCode' => str_replace('-', '', $contact->zip_code),
		'countryCode' => 'PL',
		'email' => $contact->email1,
		'phone' => str_replace(' ', '', $contact->phone1),
	];
	return $sender;
}

function getParcels($transaction, $post)
{
	$parcels = [
		0 => [
			'content' => $transaction->name,
			'customerData1' => getServices($transaction, $post)[0],
			'weight' => $post['weight'],
		]
	];
	return $parcels;
}

function getReciver($transaction)
{
	$receiver = [
		'company' => $transaction->company,
		'name' => $transaction->first_name . ' ' . $transaction->last_name,
		'address' => $transaction->street . ' ' . $transaction->housenumber . ' ' . $transaction->flatnumber,
		'city' => $transaction->city,
		'postalCode' => str_replace('-', '', $transaction->zipcode),
		'countryCode' => $transaction->country,
		'phone' => str_replace(' ', '', $transaction->phone),
		'email' => $transaction->email,
	];
	return $receiver;
}

function getShipmentData($result)
{
	$shipment_id = $result->packageId;
	$shipment_number = $result->packageId;
	$shipment_service = $result->packageId;
	$parcels = $result->parcels;
	if (is_array($parcels) && count($parcels) > 0) {
		$shipment_number = $parcels[0]->ParcelId;
		$shipment_service = $parcels[0]->Waybill;
	}
	return array($shipment_id, $shipment_number, $shipment_service);
}

function saveFile($transaction_id, $file, $filename, $packageId)
{
	$now = date('Ymd');
	$filePath = 'dpd-label/' . $now . '/' . $transaction_id;
	if (!is_dir($filePath)) {
		mkdir($filePath, 0777, TRUE);
	}
	file_put_contents($filePath . '/' . $filename . $packageId . '.pdf', $file);
	return $filePath . '/' . $filename . $packageId . '.pdf';
}

function insertPackageToDatabase($transaction, $shipmentService, $labelPath, $protocolPath, $status)
{
	$insert['status'] = $status;
	$insert['order_id'] = $transaction->id;
	$insert['first_name'] = $transaction->first_name;
	$insert['last_name'] = $transaction->last_name;
	$insert['name'] = $transaction->name;
	$insert['shipment_service'] = $shipmentService;
	$insert['pdf'] = $labelPath;
	$insert['protocol'] = $protocolPath;
	$CI = &get_instance();
	$CI->back_m->insert('dpd_label', $insert);
}