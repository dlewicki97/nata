<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'vendor/autoload.php';

use DPD\Services\DPDService;

class DPD_lib
{
	private $CI;
	private $contact;
	private $settings;
	private $dpdSettings;

	public function __construct()
	{
		$this->CI = &get_instance();
		$this->CI->load->helper('dpd_helper');
		$this->contact = $this->CI->back_m->get_one('contact_settings', 1);
		$this->settings = $this->CI->back_m->get_one('settings', 1);
		$this->dpdSettings = $this->CI->back_m->get_one('shop_settings', 1);
	}

	public function generateShipment($id)
	{
		$transaction = $this->CI->back_m->get_one('transaction', $id);
		$dpd = new DPDService();

		$sender = getSender($this->dpdSettings, $this->contact);
		$parcels = getParcels($transaction, $_POST);
		$receiver = getReciver($transaction);
		$services = getServices($transaction, $_POST)[1];

		$dpd->setSender($sender);

		$result = $dpd->sendPackage($parcels, $receiver, 'SENDER', $services, $id);
		$shipmentData = getShipmentData($result);

		$speedlabel = $dpd->generateSpeedLabelsByPackageIds([$shipmentData[0]], $sender, 'DOMESTIC', 'PDF', 'LBL_PRINTER');
		$protocol = $dpd->generateProtocolByPackageIds([$shipmentData[0]], $sender);

		$labelPath = saveFile($transaction->id, $speedlabel->filedata, 'label', $shipmentData[0]);
		$protocolPath = saveFile($transaction->id, $protocol->filedata, 'protocol', $shipmentData[0]);

		$statusTransaction = 4;
		insertPackageToDatabase($transaction, $shipmentData[2], $labelPath, $protocolPath, $statusTransaction);
		updateStatusTransaction($transaction->id, $statusTransaction);

		return $shipmentData[2];
	}
}