<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Footer_lists extends CI_Controller
{

	public function list($id)
	{
		if (checkAccess()) {
			if (!$this->db->table_exists($this->uri->segment(2))) {
				$this->base_m->create_table($this->uri->segment(2));
			}
			// DEFAULT DATA
			$data = loadDefaultData();

			$data['rows'] = $this->back_m->get_all_where($this->uri->segment(2), 'footer_id', $id);
			$data['footer'] = $this->back_m->get_one('footer', $id);
			echo loadSubViewsBack($this->uri->segment(2), 'index', $data);
		} else {
			redirect('panel');
		}
	}

	public function form($type, $footer_id, $id = '')
	{
		if (checkAccess()) {
			// DEFAULT DATA
			$data = loadDefaultData();
			$this->load->helper('panel_dropdown');
			if ($id != '') {
				$data['value'] = $this->back_m->get_one($this->uri->segment(2), $id);
			}
			$data['footer'] = $this->back_m->get_one('footer', $footer_id);
			$data['footer_items'] = $this->back_m->get_all('footer');
			echo loadSubViewsBack($this->uri->segment(2), 'form', $data);
		} else {
			redirect('panel');
		}
	}

	public function priority()
	{
		if (!$this->db->field_exists('priority', 'footer_lists')) {
			$this->base_m->create_column('footer_lists', 'priority');
		}
		$insert['priority'] = $_POST['priority'];
		$this->back_m->update('footer_lists', $insert, $_POST['id']);
	}

	public function action($type, $table, $footer_id, $id = '')
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

			$insert['bold'] = isset($_POST['bold']) ? 1 : 0;
			$insert['blank'] = isset($_POST['blank']) ? 1 : 0;

			if ($type == 'insert') {
				$this->back_m->insert($table, $insert);
				$this->session->set_flashdata('flashdata', 'Rekord został dodany!');
			} else {
				$this->back_m->update($table, $insert, $id);
				$this->session->set_flashdata('flashdata', 'Rekord został zaktualizowany!');
			}
			redirect("panel/$table/list/$footer_id");
		} else {
			redirect('panel');
		}
	}
}
