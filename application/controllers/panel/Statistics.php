<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Statistics extends CI_Controller
{

	public function index()
	{
		if (checkAccess()) {
			$this->load->model('statistics_m');
			if (!$this->db->table_exists($this->uri->segment(2))) {
				$this->base_m->create_table($this->uri->segment(2));
			}
			// DEFAULT DATA
			$data = loadDefaultData();

			$data['rows'] = $this->back_m->get_all($this->uri->segment(2));
			if (!isset($_POST['date']) || $_POST['date'] == '') {
				unset($_SESSION['date']);
				$data['char'] = $this->back_m->get_all('transaction');
				$data['trans'] = $this->back_m->get_all('transaction');
				$data['unique_usr'] = $this->statistics_m->get_disctinct('transaction', 'email');
				$data['months'] = $this->statistics_m->get_mounth('transaction');
			} else {
				$_SESSION['date'] = $_POST['date'];
				$data['char'] = $this->back_m->get_all('transaction');
				$data['trans'] = $this->statistics_m->get_by_filtr('transaction', $_POST['date']);
				$data['lq'] = $this->db->last_query();
				$data['unique_usr'] = $this->statistics_m->get_disctinct_by_filtr('transaction', 'email', $_POST['date']);
				$data['months'] = $this->statistics_m->get_mounth('transaction', $_POST['date']);
			}
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
								$this->session->set_flashdata('flashdata', 'Zdj??cie nie zosta??o poprawnie zoptymalizowane!');
							}
							//WebP Converter 
						}
						addMedia($data);
					} elseif ($value == 'usuni??te') {
						$insert['photo'] = '';
					}
				} else {
					$insert[$key] = $value;
				}
			}
			if ($type == 'insert') {
				$this->back_m->insert($table, $insert);
				$this->session->set_flashdata('flashdata', 'Rekord zosta?? dodany!');
			} else {
				$this->back_m->update($table, $insert, $id);
				$this->session->set_flashdata('flashdata', 'Rekord zosta?? zaktualizowany!');
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect('panel');
		}
	}
}
