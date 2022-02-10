<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Filter_lists extends CI_Controller
{

	public function list($id)
	{
		if (checkAccess()) {
			if (!$this->db->table_exists($this->uri->segment(2))) {
				$this->base_m->create_table($this->uri->segment(2));
			}
			// DEFAULT DATA
			$data = loadDefaultData();

			$data['rows'] = $this->back_m->get_all_where($this->uri->segment(2), 'filter_id', $id);
			$data['filter'] = $this->back_m->get_one('filters', $id);
			echo loadSubViewsBack($this->uri->segment(2), 'index', $data);
		} else {
			redirect('panel');
		}
	}

	public function form($type, $filter_id, $id = '')
	{
		if (checkAccess()) {
			// DEFAULT DATA
			$data = loadDefaultData();
			$this->load->helper('panel_dropdown');
			if ($id != '') {
				$data['value'] = $this->back_m->get_one($this->uri->segment(2), $id);
			}
			$data['filter'] = $this->back_m->get_one('filters', $filter_id);
			$data['filters'] = $this->back_m->get_all('filters');
			echo loadSubViewsBack($this->uri->segment(2), 'form', $data);
		} else {
			redirect('panel');
		}
	}

	public function priority()
	{
		$insert['priority'] = $_POST['priority'];
		$this->back_m->update('filter_lists', $insert, $_POST['id']);
	}

	public function fill_lines()
	{
		require 'filters/index.php';

		$lines = get_lines('normy.txt');
		// echo json_encode($lines);
		// die;
		foreach ($lines as $line) {
			// $this->back_m->insert('filter_lists', ['title' => $line, 'filter_id' => 5]);
		}
	}

	public function action($type, $table, $filter_id, $id = '')
	{
		if (checkAccess()) {
			$now = date('Y-m-d');
			if (!is_dir('uploads/' . $now)) {
				mkdir('./uploads/' . $now, 0777, TRUE);
			}
			$config['upload_path'] = './uploads/' . $now;
			$config['allowed_types'] = '*';
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
						$svg_types = ['image/svg', 'image/svg+xml'];
						if (!in_array($data['file_type'], $svg_types) && isOnWebp()) {
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
			redirect("panel/$table/list/$filter_id");
		} else {
			redirect('panel');
		}
	}
}
