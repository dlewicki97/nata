<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

	public function index()
	{
		if (checkAccess()) {
			// DEFAULT DATA
			$data = loadDefaultData();
			echo loadViewsBack('profile', $data);
		} else {
			redirect('panel');
		}
	}

	public function update()
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
				if ($key == 'name_photo_1') {
					if ($this->upload->do_upload('photo_1')) {
						$data = $this->upload->data();
						$insert['avatar'] = $now . '/' . $data['file_name'];
						addMedia($data);
					} elseif ($value == 'usunięte') {
						$insert['avatar'] = '';
					}
				} elseif ($key == 'password') {
					if ($value != '') {
						$insert[$key] = hashPassword($value);
					}
				} else {
					$insert[$key] = $value;
				}
			}
			$this->back_m->update('users', $insert, $_SESSION['id']);
			$this->session->set_flashdata('flashdata', 'Profil został zaktualizowany!');
			redirect('panel/profile');
		} else {
			redirect('panel');
		}
	}
}
