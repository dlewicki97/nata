<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Inpost_lib
{
	private object $CI;
	private object $contact;
	private object $settings;
	private object $inpostSettings;
	private string $sandboxApi;
	private string $tokenInpost;

	public function __construct()
	{
		$this->CI = &get_instance();
		$this->CI->load->helper('inpost_helper');
		$this->contact = $this->CI->back_m->get_one('contact_settings', 1);
		$this->settings = $this->CI->back_m->get_one('settings', 1);
		$this->inpostSettings = $this->CI->back_m->get_one('shop_settings', 1);
		$this->tokenInpost = $this->inpostSettings->inpost_token;
		$this->sandboxApi = ($this->inpostSettings->inpost_sandbox == 1)
			? 'https://sandbox-api-shipx-pl.easypack24.net/v1'
			: 'https://api-shipx-pl.easypack24.net/v1';
	}

	public function generateShipment($id)
	{
		$transaction = $this->CI->back_m->get_one('transaction', $id);
		$reciver = getReciver($transaction);
		$parcels = getParcels($transaction, $_POST);
		$insurance = getInsurance($transaction);
		if ($transaction->payment == 'pobranie') {
			$cod = getCod($transaction);
			$reciver = array_merge($reciver, $cod);
		}



		$customAttributes = getCustomAttributes($transaction, $_POST);
		$additionalServices = getAdditionalServices($transaction, $_POST, $_POST['package_type']);
		$payload = array_merge($reciver, $parcels, $insurance, $customAttributes, $additionalServices);

		// unset($payload['comments']);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->sandboxApi . '/organizations/' . $this->inpostSettings->inpost_login . '/shipments');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->tokenInpost
		));
		$arr = curl_exec($ch);
		curl_close($ch);
		$jsonArrayResponse = json_decode($arr);
		if ($jsonArrayResponse->status != 'created') {
			ob_start();
			var_dump(['sent_data' => $payload, 'inpost_response' => $jsonArrayResponse]);
			$responseDump = ob_get_clean();
			$this->CI->session->set_flashdata('shipment_validation_errors', "<pre>$responseDump</pre>");
		} else $this->CI->session->unmark_flash('shipment_validation_errors');

		updateStatusTransaction($id, 4);
		return $jsonArrayResponse->id;
	}

	public function getTrackingNumber($shipment_id)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->sandboxApi . '/shipments/' . $shipment_id);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->tokenInpost
		));
		$arr = curl_exec($ch);
		curl_close($ch);
		//echo $arr;
		$jsonArrayResponse = json_decode($arr);
		return $jsonArrayResponse->tracking_number;
	}

	public function label($package_id)
	{
		$payload = array(
			'format' 		=> 'pdf',
			'shipment_ids' 	=> array(
				0 => $package_id
			),
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->sandboxApi . '/shipments/' . $package_id . '/label?format=pdf&type=A6');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->tokenInpost
		));
		$arr = curl_exec($ch);
		curl_close($ch);
		//echo $arr;
		$jsonArrayResponse = json_decode($arr);
		header('Content-Type: application/pdf');
		header('Content-Disposition: inline; filename=test' . $package_id . '.pdf');
		echo $arr;
	}

	public function findPackage()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->sandboxApi . '/shipments/11617606');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->tokenInpost
		));
		$arr = curl_exec($ch);
		curl_close($ch);

		$jsonArrayResponse = json_decode($arr);
		echo $arr;
	}

	public function deletePackage($package_id = '494669712')
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api-shipx-pl.easypack24.net/v1/shipments/' . $package_id);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->tokenInpost
		));
		$arr = curl_exec($ch);
		curl_close($ch);

		$jsonArrayResponse = json_decode($arr);
		echo $arr;
	}
}