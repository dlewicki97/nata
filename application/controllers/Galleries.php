<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galleries extends CI_Controller
{
    public function index()
    {
        clean_search();
        $data = loadDefaultDataFront();
        $data['galleries'] = $this->back_m->get_where_result('galleries', []);

        echo loadViewsFront('galleries', $data);
    }
    public function show($gallery_id)
    {
        clean_search();
        $data = loadDefaultDataFront();
        $data['images'] = $this->back_m->get_images('gallery', 'galleries', $gallery_id);
        $data['gallery'] = $this->back_m->get_one('galleries', $gallery_id);
        $data['meta_title'] = $data['gallery']->title;

        echo loadViewsFront('gallery', $data);
    }
}
