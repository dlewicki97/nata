<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['lang'])) {
            $_SESSION['lang'] = 'pl';
        }

        clean_search();
    }

    public function test()
    {
        // $products_categories = $this->back_m->get_all('products_categories');
    }

    public function hash()
    {
        echo hashPassword('123sniadecki123');
    }

    public function testOrderEmail()
    {
        $this->load->helper('transaction');
        sendTransaction(58);
    }



    public function index()
    {
        $data = loadDefaultDataFront();
        $data['slider'] = $this->back_m->get_all('slider');
        $data['producents_desc'] = $this->back_m->get_one('producents_desc', 1);
        $data['advertising_slider'] = $this->back_m->get_all('advertising_slider');
        $data['producers'] = $this->back_m->get_where_result('filter_lists', ['filter_id' => 1, 'photo!=' => NULL]);
        $data['contact_company'] = $this->back_m->get_one('contact', 1);
        $data['awarded'] = $this->back_m->get_random_one_awarded('products');
        $data['news'] = $this->back_m->get_random_news('products');
        $data['handmades'] = $this->back_m->get_where_result('handmades', ['home' => 1]);
        $data['categories_page'] = $this->back_m->get_where_result('categories', ['active' => 1, 'dimension' => 0]);
        $data['subcategories_page'] = $this->back_m->get_all_priority('subcategory', 'active');

        echo loadViewsFront('index', $data);
    }

    public function render_search($like)
    {
        $data['all'] = $this->back_m->get_like('products', 'name', urldecode($like), $limit = 15);
        $this->load->view('front/elements/search_list', $data);
    }

    public function about()
    {
        $data = loadDefaultDataFront();
        $data['about'] = $this->back_m->get_all_priority('about', 'active');
        $data['producents'] = $this->back_m->get_all_priority('producents', 'active');
        $data['contact_company'] = $this->back_m->get_one('contact', 1);
        echo loadViewsFront('about', $data);
    }

    public function contact()
    {
        $data = loadDefaultDataFront();
        $data['contact_company'] = $this->back_m->get_one('contact', 1);
        echo loadViewsFront('contact', $data);
    }



    public function regulations($id)
    {
        $data = loadDefaultDataFront();
        $data['row'] = $this->back_m->get_one('regulations', $id);
        echo loadViewsFront('regulations', $data);
    }

    public function producents()
    {
        $data = loadDefaultDataFront();
        $data['producents'] = $this->back_m->get_all_priority('producents', 'active');
        $data['contact_company'] = $this->back_m->get_one('contact', 1);
        echo loadViewsFront('producents', $data);
    }

    public function change($lang)
    {
        $_SESSION['lang'] = $lang;
    }

    public function remove_desc()
    {
        foreach ($this->back_m->get_all('products') as $key => $value) {
            $insert['description'] = '';
            $this->back_m->update('products', $insert, $value->id);
        }
    }

    public function delete_filters_if_not_exist()
    {
        $products = $this->back_m->get_where_result('products', ['id <' => 4000]);

        for ($i = 0; $i < count($products); $i++) {
            $products_filter_lists = $this->back_m->get_where_result('products_filter_lists', ['product_id' => $products[$i]->id]);
            foreach ($products_filter_lists as $list) {
                if (!$this->back_m->get_one('filter_lists', $list->filter_list_id)) {
                    $this->back_m->delete('products_filter_lists', $list->id);
                } else {
                    echo "$i<br>";
                }
            }
        }
    }
}