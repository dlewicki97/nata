<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{


	public function index()
	{
		if (checkAccess()) {
			if (!$this->db->table_exists($this->uri->segment(2))) {
				$this->base_m->create_table($this->uri->segment(2));
			}
			// DEFAULT DATA
			$data = loadDefaultData();

			echo loadSubViewsBack($this->uri->segment(2), 'index', $data);
		} else {
			redirect('panel');
		}
	}

	public function form($type, $id = '')
	{

		if (checkAccess()) {
			// DEFAULT DATA
			$data = loadDefaultData();

			if ($id != '') {

				$data['value'] = $this->back_m->get_one($this->uri->segment(2), $id);
				$data['shipment_data'] = $this->back_m->get_shipment_data('shipment', $id);
			}
			echo loadSubViewsBack($this->uri->segment(2), 'form', $data);
		} else {
			redirect('panel');
		}
	}

	public function action($type, $table, $id = '')
	{
		if (checkAccess()) {
			$now = date('Y-m-d');
			if (!is_dir('uploads/' . $now)) {
				mkdir('./uploads/' . $now, 0777, TRUE);
			}
			$config['upload_path'] = './uploads/' . $now;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = 0;
			$config['max_width'] = 0;
			$config['max_height'] = 0;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			foreach ($_POST as $key => $value) {

				if (!$this->db->field_exists($key, $table)) {
					$this->base_m->create_column($table, $key);
				}

				if ($key == 'name_photo_1') {
					if ($this->upload->do_upload('photo_1')) {
						$data = $this->upload->data();
						$insert['photo'] = $now . '/' . $data['file_name'];
						if ($data['file_type'] != 'image/svg' && isOnWebp()) {
							//WebP Converter
							$photoWebP = convertImageToWebP($insert['photo']);
							$keyFieldPhotoWebP = 'photo_webp';
							if ($photoWebP[0] == true) {
								$insert[$keyFieldPhotoWebP] = $now . '/' . $photoWebP[1];
								createWebPField($table, $keyFieldPhotoWebP);
							} else {
								$this->session->set_flashdata('flashdata', 'Zdjęcie nie zostało poprawnie zoptymalizowane!');
							}
							//WebP Converter 
						}
						addMedia($data);
					} elseif ($value == 'usunięte') {
						$insert['photo'] = '';
					}
				} else {
					$insert[$key] = $value;
				}
			}
			if ($type == 'insert') {
				$this->back_m->insert($table, $insert);
				$this->session->set_flashdata('flashdata', 'Rekord został dodany!');
			} else {
				$this->back_m->update($table, $insert, $id);
				$this->session->set_flashdata('flashdata', 'Rekord został zaktualizowany!');
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect('panel');
		}
	}

	public function generate_pdf($id)
	{

		$data = loadDefaultData();
		$data['transaction_details'] = $this->back_m->get_one($this->uri->segment(2), $id);
		$data['date_of_issue'] = $_POST['date_of_issue'];
		if ($_POST['payment_deadline'] ?? null) :
			$data['payment_deadline'] = $_POST['payment_deadline'];
		endif;
		require_once 'vendor/autoload.php';
		$mpdf = new \Mpdf\Mpdf();
		$html = $this->load->view('back/pdf/invoice', $data, true);
		$mpdf->WriteHTML($html);

		$invoice = 'FA_' . $id . '_' . date('Y') . rand(0, 9999) . '_' . date('d-m-Y') . '_invoice';
		if (!is_dir('mailer/attachment/invoices/')) {
			mkdir('./mailer/attachment/invoices/', 0777, TRUE);
		}
		$pathInvoice = 'mailer/attachment/invoices/' . $invoice . '.pdf';

		$mpdf->Output($pathInvoice, 'F');

		sendInvoice($data['transaction_details'], $pathInvoice);

		$this->session->set_flashdata('flashdata', 'Faktura została wysłana! Podejrzyj ją klikając <a href="' . base_url($pathInvoice) . '" target="_blank">tutaj</a>.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function activePayment()
	{
		$insert['paid'] = $_POST['value'];
		$insert['updated'] = date("Y-m-d h:i:sa");
		// sendStatus($_POST['id']);
		$this->back_m->update($_POST['table'], $insert, $_POST['id']);
	}

	public function changestatus()
	{
		$this->load->helper('transaction');
		$insert['status'] = $_POST['value'];
		$this->back_m->update($_POST['table'], $insert, $_POST['id']);

		sendChange($_POST['id']);
	}

	public function inpost($id)
	{
		$this->load->library('inpost_lib');
		$shipmentId = $this->inpost_lib->generateShipment($id);
		$this->labelsShipment($shipmentId, 'inpost', $id);
		sleep(15);
		$trackingNumber = $this->inpost_lib->getTrackingNumber($shipmentId);
		sendPackage($id, 'inpost', $trackingNumber);
		$this->session->set_flashdata('flashdata', 'Przesyłka została wygenerowana');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function inpost_label($package_id)
	{
		$this->load->library('inpost_lib');
		$this->inpost_lib->label($package_id);
	}

	public function dpd($id)
	{
		$this->load->library('dpd_lib');
		$shipmentId = $this->dpd_lib->generateShipment($id);
		$this->labelsShipment($shipmentId, 'dpd', $id);
		sendPackage($id, 'dpd', $shipmentId);
		$this->session->set_flashdata('flashdata', 'Przesyłka została wygenerowana');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function dpd_label($id)
	{
		$this->load->library('dpd_lib');
		$this->dpd_lib->generateShipment($id);
	}

	public function labelsShipment($package_id, $courier, $transaction_id)
	{
		$insert['transaction_id'] = $transaction_id;
		$insert['package_id'] = $package_id;
		$insert['courier'] = $courier;
		$this->back_m->insert('transaction_shipment', $insert);
	}

	public function test()
	{
		$this->load->library('dpd_lib');
		$this->dpd_lib->generateShipment(20);
	}
	public function test2()
	{
		$this->load->library('inpost_lib');
		$this->inpost_lib->findPackage();
	}
}