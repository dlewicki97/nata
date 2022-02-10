<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Downloads extends CI_Controller
{
    public function index()
    {
        clean_search();
        $data = loadDefaultDataFront();
        $data['downloads'] = $this->back_m->get_where_result('downloads', ['active' => 1]);
        $data['downloads_categories'] = $this->back_m->get_all('downloads_categories');

        echo loadViewsFront('downloads', $data);
    }
    public function show($downloads_category_id)
    {
        clean_search();
        $data = loadDefaultDataFront();
        $data['downloads'] = $this->back_m->get_where_result('downloads', ['active' => 1, "downloads_category_id" => $downloads_category_id]);
        $data['downloads_category'] = $this->back_m->get_one('downloads_categories', $downloads_category_id);
        $data['meta_title'] = $data['downloads_category']->title;

        echo loadViewsFront('download', $data);
    }
}