<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mpdf extends CI_Controller
{

	public function report()
	{

		if (checkAccess()) {

			$data['report'] = $this->back_m->get_report('transaction', $_POST['date_start'], $_POST['date_end']);
			$data['start'] = $_POST['date_start'];
			$data['end'] = $_POST['date_end'];
			$data['contact'] = $this->back_m->get_one('contact_settings', 1);
			$data['settings'] = $this->back_m->get_one('settings', 1);

			ini_set('display_errors', 0);
			ini_set('display_startup_errors', 0);
			require_once 'vendor/autoload.php';
			$mpdf = new \Mpdf\Mpdf();

			$mpdf->setFooter('{PAGENO}');

			$html = $this->load->view('back/pdf/report', $data, true);

			$mpdf->WriteHTML($html);
			ini_set('date.timezone', 'Europe/London');
			$now = date('Y-m-d-His');

			$mpdf->Output();
		} else {
			redirect('panel');
		}
	}

	public function report_products()
	{

		if (checkAccess()) {

			$data['report'] = $this->back_m->get_report('transaction', $_POST['date_start'], $_POST['date_end']);
			$data['start'] = $_POST['date_start'];
			$data['end'] = $_POST['date_end'];
			$data['contact'] = $this->back_m->get_one('contact_settings', 1);
			$data['settings'] = $this->back_m->get_one('settings', 1);

			ini_set('display_errors', 0);
			ini_set('display_startup_errors', 0);
			require_once 'vendor/autoload.php';
			$mpdf = new \Mpdf\Mpdf();

			$mpdf->setFooter('{PAGENO}');

			$html = $this->load->view('back/pdf/report_products', $data, true);

			$mpdf->WriteHTML($html);
			ini_set('date.timezone', 'Europe/London');
			$now = date('Y-m-d-His');

			$mpdf->Output();
		} else {
			redirect('panel');
		}
	}

	public function report_magazine()
	{

		if (checkAccess()) {

			$data['rows'] = $this->back_m->get_all('products');
			$data['contact'] = $this->back_m->get_one('contact_settings', 1);
			$data['settings'] = $this->back_m->get_one('settings', 1);

			ini_set('display_errors', 0);
			ini_set('display_startup_errors', 0);
			require_once 'vendor/autoload.php';
			$mpdf = new \Mpdf\Mpdf();

			$mpdf->setFooter('{PAGENO}');

			$html = $this->load->view('back/pdf/report_magazine', $data, true);

			$mpdf->WriteHTML($html);
			ini_set('date.timezone', 'Europe/London');
			$now = date('Y-m-d-His');

			$mpdf->Output();
		} else {
			redirect('panel');
		}
	}
}
