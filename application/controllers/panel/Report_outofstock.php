<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_outofstock extends CI_Controller
{

	public function index2()
	{
		if (checkAccess()) {
			if (!$this->db->table_exists($this->uri->segment(2))) {
				$this->base_m->create_table($this->uri->segment(2));
			}
			// DEFAULT DATA
			$data = loadDefaultData();

			$data['rows'] = $this->back_m->get_all('products');
			echo loadSubViewsBack($this->uri->segment(2), 'index', $data);
		} else {
			redirect('panel');
		}
	}

	public function index($paging = '')
	{
		if (checkAccess()) {
			$this->load->model('products_m');
			if (!$this->db->table_exists($this->uri->segment(2))) {
				$this->base_m->create_table($this->uri->segment(2));
			}
			$data = loadDefaultData();
			if ($paging < 0) {
				$paging = 0;
			}
			$data['count'] = $this->back_m->get_all('products');
			$paging = $this->uri->segment(4);
			$perPage = 10000;
			$data['rows'] = $this->back_m->get_paging('products', $perPage, $paging);
			$this->load->library('pagination');
			$config['base_url'] = base_url('panel/report_outofstock/index');
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
}
