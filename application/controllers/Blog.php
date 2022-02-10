<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
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
        $this->load->model('blog_m');
        $data = loadDefaultDataFront();
        $perPage = 10;
        $data['blogs'] = $this->blog_m->get_orderBy_pagging('blogs', $perPage, $page);

        $this->load->library('pagination');
        $config['base_url'] = base('blog');
        $config['total_rows'] = $this->db->count_all('blogs');
        $config['per_page'] = $perPage;
        $config['next_link'] = '<img data-src="' . assets() . 'img/main/arrow-right.svg" alt="" class="lazy">';
        $config['prev_link'] = '<img data-src="' . assets() . 'img/main/arrow-left.svg" alt="" class="lazy">';
        $config['first_link'] = '<img data-src="' . assets() . 'img/main/double-left-arrow.svg" alt="" class="invert lazy">';
        $config['last_link'] = '<img data-src="' . assets() . 'img/main/double-right-arrow.svg" alt="" class="invert lazy">';

        $this->pagination->initialize($config);

        echo loadViewsFront('blogs/list', $data);
    }

    public function show($id)
    {
        $data = loadDefaultDataFront();
        $data['blog'] = $this->back_m->get_one('blogs', $id);
        $data['meta_title'] = $data['blog']->title;
        $data['breadcrumb_title'] = $data['blog']->title;
        $data['meta_description'] = $data['blog']->meta_description;
        $data['gallery'] = $this->back_m->get_images('gallery', 'blogs', $id);

        echo loadViewsFront('blogs/show', $data);
    }
}