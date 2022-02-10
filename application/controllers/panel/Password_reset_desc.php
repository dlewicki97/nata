<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Password_reset_desc extends CI_Controller
{

	public function index()
	{
		if (checkAccess()) {
			redirect('panel/password_reset_desc/form/update/1');
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
