<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'vendor/autoload.php';

use DPD\Services\DPDService;

class Dpd extends CI_Controller
{
	public function send($id)
	{
		if (checkAccess()) {
			$transaction = $this->back_m->get_one('transaction', $id);

			$contact = $this->back_m->get_one('contact_settings', 1);
			$settings = $this->back_m->get_one('settings', 1);
			$dpd = $this->back_m->get_one('shop_settings', 1);

			$now = date('Ymd');

			if ($transaction->payment == 'pobranie') {
				$customerData1 = 'Przesyłka pobraniowa - ' . $_POST['courier_desc'];
				$services = [
					'cod' => [
						'amount' => $transaction->suma,
						'currency' => 'PLN',
					]
				];
			} else {
				$customerData1 = 'Przesyłka standardowa - ' . $_POST['courier_desc'];
				$services = [];
			}
			$sender = [
				'fid' => $dpd->fid,
				'name' => $contact->name,
				'company' => $contact->company,
				'address' => $contact->address,
				'city' => $contact->city,
				'postalCode' => str_replace('-', '', $contact->zip_code),
				'countryCode' => 'PL',
				'email' => $contact->email1,
				'phone' => str_replace(' ', '', $contact->phone1),
			];

			$dpd = new DPDService();
			$dpd->setSender($sender);

			$parcels = [
				0 => [
					'content' => $transaction->name,
					'customerData1' => $customerData1,
					'weight' => $_POST['waga'],
				]
			];

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

			$result = $dpd->sendPackage($parcels, $receiver, 'SENDER', $services);
			$shipment_id = $result->packageId;
			$shipment_number = $result->packageId;
			$shipment_service = $result->packageId;

			$parcels = $result->parcels;
			if (is_array($parcels) && count($parcels) > 0) {
				$shipment_number = $parcels[0]->ParcelId;
				$shipment_service = $parcels[0]->Waybill;
			}

			$pickupAddress = [
				'fid' => $dpd->fid,
				'name' => $contact->name,
				'company' => $contact->company,
				'address' => $contact->address,
				'city' => $contact->city,
				'postalCode' => str_replace('-', '', $contact->zip_code),
				'countryCode' => 'PL',
				'email' => $contact->email1,
				'phone' => str_replace(' ', '', $contact->phone1),
			];

			$speedlabel = $dpd->generateSpeedLabelsByPackageIds([$result->packageId], $pickupAddress);

			if (!is_dir('dpd-label/' . $now . '/' . $transaction->id)) {
				mkdir('dpd-label/' . $now . '/' . $transaction->id, 0777, TRUE);
			}
			file_put_contents('dpd-label/' . $now . '/' . $transaction->id . '/slbl-pid' . $result->packageId . '.pdf', $speedlabel->filedata);

			$protocol = $dpd->generateProtocolByPackageIds([$result->packageId], $pickupAddress);

			file_put_contents('dpd-label/' . $now . '/' . $transaction->id . '/prot-pid' . $result->packageId . '.pdf', $protocol->filedata);

			$insert['status'] = 4;
			$insert['order_id'] = $transaction->id;
			$insert['first_name'] = $transaction->first_name;
			$insert['last_name'] = $transaction->last_name;
			$insert['name'] = $transaction->name;
			$insert['shipment_service'] = $shipment_service;
			$insert['pdf'] = $now . '/' . $transaction->id . '/slbl-pid' . $result->packageId . '.pdf';
			$insert['protocol'] = $now . '/' . $transaction->id . '/prot-pid' . $result->packageId . '.pdf';
			$this->back_m->insert('dpd_label', $insert);


			$insert2['status'] = 5;
			$this->back_m->update('transaction', $insert2, $id);
			//sendPackage($id, $shipment_service); 
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect('panel');
		}
	}
}
