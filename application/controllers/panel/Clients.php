<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clients extends CI_Controller
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

	public function form($type, $id = '')
	{
		if (checkAccess()) {
			// DEFAULT DATA
			$data = loadDefaultData();

			if ($id != '') {
				$data['groups'] = $this->back_m->get_all('clients_groups');
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
				} elseif ($key == 'password') {
					if ($value != '') {
						send_new_password($id, $_POST['first_name'], $_POST['email']);
						$insert[$key] = hashPassword($value);
					}
				} else {
					$insert[$key] = $value;
				}
			}
			if ($type == 'insert') {
				$this->back_m->insert($table, $insert);
				$this->session->set_flashdata('flashdata', 'Rekord został dodany!');
			} else {
				$client = $this->back_m->get_one('clients', $id);
				if ($client->discount != $_POST['discount']) {
					$this->load->helper('clients/discount_notification');
					send_discount_notification_to_client($client);
				}
				$this->back_m->update($table, $insert, $id);
				$this->session->set_flashdata('flashdata', 'Rekord został zaktualizowany!');
			}
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect('panel');
		}
	}

	public function resendActive($id)
	{
		if (checkAccess()) {
			$client = $this->back_m->get_one($this->uri->segment(2), $id);
			resendActive($client->id, $client->email, $client->created);
			$this->session->set_flashdata('flashdata', 'Przypomnienie zostało wysłane!');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect('panel');
		}
	}
}
