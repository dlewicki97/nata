<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_products extends CI_Controller
{

	public function index()
	{
		if (checkAccess()) {
			if (!$this->db->table_exists($this->uri->segment(2))) {
				$this->base_m->create_table($this->uri->segment(2));
			}
			// DEFAULT DATA
			$data = loadDefaultData();

			$data['rows'] = $this->back_m->get_all($this->uri->segment(2));
			echo loadSubViewsBack($this->uri->segment(2), 'index', $data);
		} else {
			redirect('panel');
		}
	}
	public function render()
	{
		if (checkAccess()) {
			ini_set('display_errors', 0);
			ini_set('display_startup_errors', 0);
			$data['report'] = $this->back_m->get_report('transaction', $_GET['date_start'], $_GET['date_end']);
			$this->load->view('back/reports/report_products', $data);
		} else {
			redirect('panel');
		}
	}
}
