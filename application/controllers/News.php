<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['lang'])) {
            $_SESSION['lang'] = 'pl';
        }
        $this->load->helper('date');
        clean_search();
    }



    public function index($page = 0)
    {
        $this->load->model('shop_m');
        $data = loadDefaultDataFront();
        $perPage = 10;
        $data['news'] = $this->news_m->get_orderBy_pagging('news', $perPage, $page);

        $this->load->library('pagination');
        $config['base_url'] = base('aktualnosci');
        $config['total_rows'] = $this->db->count_all('news');
        $config['per_page'] = $perPage;
        $config['next_link'] = '<img data-src="' . assets() . 'img/main/arrow-right.svg" alt="" class="lazy">';
        $config['prev_link'] = '<img data-src="' . assets() . 'img/main/arrow-left.svg" alt="" class="lazy">';
        $config['first_link'] = '<img data-src="' . assets() . 'img/main/double-left-arrow.svg" alt="" class="invert lazy">';
        $config['last_link'] = '<img data-src="' . assets() . 'img/main/double-right-arrow.svg" alt="" class="invert lazy">';

        $this->pagination->initialize($config);

        echo loadViewsFront('news/list', $data);
    }
    public function show($id)
    {
        $data = loadDefaultDataFront();
        $data['info'] = $this->back_m->get_one('news', $id);
        $data['meta_title'] = $data['info']->title;
        $data['breadcrumb_title'] = $data['info']->title;
        $data['meta_description'] = $data['info']->meta_description;
        $data['gallery'] = $this->back_m->get_images('gallery', 'news', $id);

        echo loadViewsFront('news/show', $data);
    }
}