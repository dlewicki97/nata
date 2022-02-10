<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subpages extends CI_Controller
{

	public function index()
	{
		if (checkAccess()) {
			// DEFAULT DATA
			$data = loadDefaultData();

			$data['subpages'] = $this->back_m->get_all_priority('subpages');
			echo loadSubViewsBack('subpages', 'index', $data);
		} else {
			redirect('panel');
		}
	}

	public function form($type, $id = '')
	{
		if (checkAccess()) {
			// DEFAULT DATA
			$data['mails'] = $this->back_m->get_all('mails');
			$data['user'] = $this->back_m->get_one('users', $_SESSION['id']);
			$data['media'] = $this->back_m->get_all('media');
			$data['settings'] = $this->back_m->get_one('settings', 1);
			$data['contact'] = $this->back_m->get_one('contact_settings', 1);
			// DEFAULT DATA
			if ($id != '') {
				$data['value'] = $this->back_m->get_one('subpages', $id);
			}
			echo loadSubViewsBack('subpages', 'form', $data);
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
				if ($key == 'name_photo_1') {
					if ($this->upload->do_upload('photo_1')) {
						$data = $this->upload->data();
						$insert['photo'] = $now . '/' . $data['file_name'];
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

	public function priority()
	{
		$insert['priority'] = $_POST['priority'];
		$this->back_m->update('subpages', $insert, $_POST['id']);
	}
}
