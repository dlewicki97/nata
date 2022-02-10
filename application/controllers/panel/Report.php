<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
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
}
