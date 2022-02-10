<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{

	public function index()
	{
		if (checkAccess()) {
			if (!$this->db->field_exists($_POST['field'], $_POST['table'])) {
				$this->base_m->create_column($_POST['table'], $_POST['field']);
			}
			$insert[$_POST['field']] = $_POST['value'];
			$this->back_m->update($_POST['table'], $insert, 1);
		} else {
			redirect('panel');
		}
	}

	public function updateAlt()
	{
		if (checkAccess()) {
			$insert['alt'] = $_POST['value'];
			$this->back_m->update($_POST['table'], $insert, $_POST['id']);
		} else {
			redirect('panel');
		}
	}

	public function photo()
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
			$this->upload->do_upload('photo_logo');
			$data = $this->upload->data();
			addMedia($data);
			$insert['logo'] = $now . '/' . $data['file_name'];
			$this->back_m->update($_POST['table'], $insert, 1);
		} else {
			redirect('panel');
		}
	}
	public function favicon()
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
			$this->upload->do_upload('favicon');
			$data = $this->upload->data();
			addMedia($data);
			$insert['favicon'] = $now . '/' . $data['file_name'];
			$this->back_m->update($_POST['table'], $insert, 1);
		} else {
			redirect('panel');
		}
	}
	public function logo_mail()
	{
		if (checkAccess()) {
			if (!$this->db->field_exists('logo_mail', $_POST['table'])) {
				$this->base_m->create_column($_POST['table'], 'logo_mail');
			}
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
			$this->upload->do_upload('logo_mail');
			$data = $this->upload->data();
			addMedia($data);
			$insert['logo_mail'] = $now . '/' . $data['file_name'];
			$this->back_m->update($_POST['table'], $insert, 1);
		} else {
			redirect('panel');
		}
	}

	public function privace()
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
			$this->upload->do_upload('privace');
			$data = $this->upload->data();
			addMedia($data);
			$insert['privace'] = $now . '/' . $data['file_name'];
			$this->back_m->update($_POST['table'], $insert, 1);
		} else {
			redirect('panel');
		}
	}

	public function gallery($table, $id)
	{
		if (checkAccess()) {
			// DEFAULT DATA
			$data = loadDefaultData();

			$data['rows'] = $this->back_m->get_images('gallery', $table, $id);
			echo loadSubViewsBack('gallery', 'index', $data);
		} else {
			redirect('panel');
		}
	}

	public function gallery_action($table, $id)
	{
		if (checkAccess()) {
			$now = date('Y-m-d');
			$files = $_FILES;
			$cpt = count($_FILES['gallery']['name']);
			for ($i = 0; $i < $cpt; $i++) {
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

				$name = $files['gallery']['name'][$i];
				$name = slug_photo($name);
				$_FILES['gallery']['name'] = $name;
				$_FILES['gallery']['type'] = $files['gallery']['type'][$i];
				$_FILES['gallery']['tmp_name'] = $files['gallery']['tmp_name'][$i];
				$_FILES['gallery']['error'] = $files['gallery']['error'][$i];
				$_FILES['gallery']['size'] = $files['gallery']['size'][$i];
				if (!($this->upload->do_upload('gallery')) || $files['gallery']['error'][$i] != 0) {
					echo $this->upload->display_errors();
				} else {
					$data = $this->upload->data();
					addMedia($data);
					$insert['photo'] = $now . '/' . $name;
					$insert['table_name'] = $table;
					$insert['item_id'] = $id;

					//WebP Converter
					$photoWebP = convertImageToWebP($insert['photo']);
					$keyFieldPhotoWebP = 'photo_webp';
					if ($photoWebP[0] == true) {
						$insert[$keyFieldPhotoWebP] = $now . '/' . $photoWebP[1];
						createWebPField('gallery', $keyFieldPhotoWebP);
					} else {
						$this->session->set_flashdata('flashdata', 'Zdjęcie nie zostało poprawnie zoptymalizowane!');
					}
					//WebP Converter

					//webp_convert($insert['photo']);
					$this->back_m->insert('gallery', $insert);
				}
			}
			$this->session->set_flashdata('flashdata', 'Rekord został dodany!');
			redirect('panel/settings/gallery/' . $table . '/' . $id);
		} else {
			redirect('panel');
		}
	}

	public function delete($table, $id)
	{
		if (checkAccess()) {
			$this->session->set_flashdata('flashdata', 'Rekord został usunięty!');
			$this->back_m->delete($table, $id);
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect('panel');
		}
	}
	public function delete_photos($table, $id)
	{
		if (checkAccess()) {
			$this->session->set_flashdata('flashdata', 'Rekord został usunięty!');
			$this->back_m->delete('gallery', $id);
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect('panel');
		}
	}
}
