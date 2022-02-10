<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Services extends CI_Controller
{
    public function show($id)
    {
        clean_search();
        $data = loadDefaultDataFront();
        $data['service'] = $this->back_m->get_one('services', $id);
        $data['gallery'] = $this->back_m->get_images('gallery', 'services', $id);
        $data['meta_title'] = $data['service']->title;
        $data['meta_description'] = $data['service']->meta_description;
        $data['contact_icons'] = $this->back_m->get_all('contact_icons');
        $data['contact_desc'] = $this->back_m->get_one('contact_desc', 1);

        echo loadViewsFront('services/show', $data);
    }
}
