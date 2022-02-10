<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Downloads extends CI_Controller
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
                $data['value'] = $this->back_m->get_one($this->uri->segment(2), $id);
            }
            $data['downloads_categories'] = $this->back_m->get_all('downloads_categories');
            echo loadSubViewsBack($this->uri->segment(2), 'form', $data);
        } else {
            redirect('panel');
        }
    }

    public function active()
    {
        $insert['active'] = $_POST['value'];
        $this->back_m->update($_POST['table'], $insert, $_POST['id']);
    }

    public function delete_file($id)
    {
        $this->load->helper('panel/downloads/delete_file');

        delete_file($id);

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_record($id)
    {
        $this->load->helper('panel/downloads/delete_file');

        delete_file($id);
        $this->back_m->delete('downloads', $id);
        $this->session->set_flashdata('flashdata', 'Rekord został usunięty!');

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function action($type, $table, $id = '')
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

                if (!$this->db->field_exists($key, $table)) $this->base_m->create_column($table, $key);

                if ($key == 'name_file_1') {
                    if ($this->upload->do_upload('file_1')) {
                        $data = $this->upload->data();

                        $insert['name'] = $data['file_name'];
                        $insert['raw_name'] = $data['raw_name'];
                        $insert['type'] = $data['file_type'];
                        $insert['size'] = $data['file_size'];
                        $insert['full_path'] = $data['full_path'];
                        $insert['file_path'] = $data['file_path'];
                        $insert['path'] = "$now/{$insert['name']}";
                        $insert['ext'] = $data['file_ext'];

                        foreach (array_keys($insert) as $insert_key) {
                            if (!$this->db->field_exists($insert_key, $table)) $this->base_m->create_column($table, $insert_key);
                        }
                        $webp_types = ['image/png', 'image/jpg', 'image/jpeg', 'image/jfif'];

                        if ($data['file_type'] != 'image/svg' && isOnWebp() && in_array($data['file_type'], $webp_types)) {
                            //WebP Converter
                            $photoWebP = convertImageToWebP($now . '/' . $insert['name']);
                            $keyFieldPhotoWebP = 'photo_webp';
                            if ($photoWebP[0] == true) {
                                $insert[$keyFieldPhotoWebP] = $now . '/' . $photoWebP[1];
                                createWebPField($table, $keyFieldPhotoWebP);
                            } else {
                                $this->session->set_flashdata('flashdata', 'Zdjęcie nie zostało poprawnie zoptymalizowane!');
                            }
                            //WebP Converter
                        }
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