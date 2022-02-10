<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_weights extends CI_Controller
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

	public function test()
	{
		$data = [
			'plecak' => 0.5,
			'torba' => 0.2,
			'czapka' => 0.3,
			'daszki' => 0.1,
			'chusta' => 0.05,
			'kapelusik' => 0.3,
			'polar' => 0.7,
			'top' => 0.2,
			'kurtka' => 1.5,
			'koszulka' => 0.2,
			'bluza' => 0.5,
			'kamizelka' => 0.4,
			'sukienka' => 0.3,
			'wiatrowka' => 0.5,
			'ogrodniczki' => 0.7,
			'szorty' => 0.3,
			'koszula' => 0.3,
			'spodnie' => 0.5,
			'koc' => 0.5,
			'szalik' => 0.2,
			'sandały' => 1.0,
			'spodnica' => 0.4,
			'legginsy' => 0.4,
			'kalesony' => 0.3,
			'recznik' => 1.0,
		];

		foreach ($data as $key => $value) $this->back_m->insert($this->uri->segment(2), ['title' => $key, 'weight' => $value]);
	}

	public function form($type, $id = '')
	{
		if (checkAccess()) {
			// DEFAULT DATA
			$data = loadDefaultData();

			if ($id != '') {
				$data['value'] = $this->back_m->get_one($this->uri->segment(2), $id);
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
			redirect('panel/' . $table);
		} else {
			redirect('panel');
		}
	}
}