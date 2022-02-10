<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_reminder extends CI_Controller
{
    public function store()
    {
        $this->load->helper("captcha_secret");
        if (!verifyCaptcha(get_captcha_secret(), $_POST['token'], $_SERVER['REMOTE_ADDR'])) {
            $this->session->set_flashdata('flashdata_false', '<p class="text-danger font-weight-bold mb-0">Ochrona antyspamowa!</p>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        if (count($this->back_m->get_where_result('product_reminders', ['product_id' => $_POST['product_id'], 'email' => $_POST['email']])) > 0) {
            $this->session->set_flashdata('flashdata_false', '<p class="text-danger font-weight-bold mb-0">Ten email jest już zapisany do przypomnienia o tym produkcie!</p>');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $insert['email'] = $this->input->post('email');
        $insert['product_id'] = $this->input->post('product_id');
        if ($this->input->post('rodo1') != null) {
            $insert['rodo1'] = '1';
            $_POST['rodo1'] = 'Zaakceptowane';
        } else {
            $insert['rodo1'] = '0';
            $_POST['rodo1'] = 'Niezaakceptowane';
        }
        if ($this->input->post('rodo2') != null) {
            $insert['rodo2'] = '1';
            $_POST['rodo2'] = 'Zaakceptowane';
        } else {
            $insert['rodo2'] = '0';
            $_POST['rodo2'] = 'Niezaakceptowane';
        }
        $this->back_m->insert('product_reminders', $insert);

        $this->session->set_flashdata('flashdata_true', "<p class=\"text-success font-weight-bold mb-0\">Kiedy produkt się pojawi od razu otrzymasz przypomnienie na adres\"{$_POST['email']}\"!</p>");
        redirect($_SERVER['HTTP_REFERER']);
    }
}
