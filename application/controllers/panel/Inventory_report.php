<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory_report extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('shop_m');
	}

	public function test()
	{
		require_once 'vendor/autoload.php';
		$pdf = new \Mpdf\Mpdf();
		$files = ['assets/pdf1.pdf', 'assets/pdf2.pdf', 'assets/mpdf.pdf'];
		$fileNumber = 1;
		foreach ($files as $file) {

			$pagecount = $pdf->SetSourceFile($file);
			for ($i = 1; $i <= $pagecount; $i++) {
				$import_page = $pdf->ImportPage($i);
				$pdf->UseTemplate($import_page);

				if ($i < $pagecount) $pdf->AddPage();

				if (($fileNumber < count($files)) || ($i != $pagecount)) {
					$pdf->WriteHTML('<pagebreak />');
				}
			}
			$fileNumber++;
		}
		$pdf->Output();
	}

	public function index($paging = '')
	{
		if (checkAccess()) {
			$this->load->model('products_m');

			$data = loadDefaultData();

			if ($paging < 0) {
				$paging = 0;
			}
			$data['count'] = $this->back_m->get_panel_products();
			$paging = $this->uri->segment(4);
			$perPage = $_COOKIE['panelProductsCount'] ?? 10;
			$data['rows'] = $this->back_m->get_paging('products', $perPage, $paging);
			$this->load->library('pagination');
			$config['base_url'] = base_url('panel/inventory_report/index');
			$config['total_rows'] = count($data['count']);
			$config['per_page'] = $perPage;
			$config['next_link'] = '<i class="fas fa-angle-right"></i>';
			$config['prev_link'] = '<i class="fas fa-angle-left"></i>';
			$config['first_link'] = '<i class="fas fa-angle-double-left"></i>';
			$config['last_link'] = '<i class="fas fa-angle-double-right"></i>';
			$this->pagination->initialize($config);
			echo loadSubViewsBack($this->uri->segment(2), 'index', $data);
		} else {
			redirect('panel');
		}
	}


	public function generate_pdf_segment($paging = 0)
	{
		$paging = (int) $paging;
		$this->load->model('products_m');
		$firstPageLimit = 41;
		$perPage = $paging === 0 ? $firstPageLimit : 1007;

		$addition = ($paging === 0 ? 0 : $firstPageLimit);


		$data['rows'] = $this->back_m->get_inventory_paging('products', $perPage, $paging * $perPage + $addition);

		// ini_set('display_errors', 0);
		// ini_set('display_startup_errors', 0);
		require_once 'vendor/autoload.php';
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->setFooter('{PAGENO}');
		$html = $this->load->view('back/pdf/inventory_report', $data, true);
		$html = $mpdf->WriteHTML($html);

		// $mpdf->Output();
	}
}