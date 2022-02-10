<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Handmades extends CI_Controller
{

    public function show($id)
    {
        clean_search();
        $data = loadDefaultDataFront();
        $data['handmade'] = $this->back_m->get_one('handmades', $id);
        $data['gallery'] = $this->back_m->get_images('gallery', 'handmades', $id);
        $data['meta_title'] = $data['handmade']->title;
        $data['meta_description'] = $data['handmade']->meta_description;
        $data['contact_icons'] = $this->back_m->get_all('contact_icons');
        $data['contact_desc'] = $this->back_m->get_one('contact_desc', 1);

        echo loadViewsFront('handmades/show', $data);
    }
}