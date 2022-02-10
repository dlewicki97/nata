<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Filter_lists extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('shop_m');
    }
    public function search()
    {
        $search = $_POST['search'];
        $filter_id = $_POST['filter_id'];
        $data = $this->shop_m->get_filter_lists_like('title', $search, $filter_id);

        echo json_encode($data);
    }

    public function search_panel()
    {
        $search = $_POST['search'];
        $filter_sort_key = $_POST['filter_sort_key'];

        $filter = $this->back_m->get_where('filters', 'sort_key', $filter_sort_key);

        $data = $this->shop_m->get_filter_lists_like('title', $search, $filter->id);

        echo json_encode($data);
    }

    public function get_by_filter_id($filter_id, $category_id)
    {
        $this->load->model('products_categories_m');
        $this->load->model('products_filter_lists_m');

        $products_ids = $this->products_categories_m->get_products_ids_api($category_id);

        $products_ids = array_reduce($products_ids, function ($total, $product_id) {
            return array_merge($total, [$product_id->product_id]);
        }, []);
        $products_filter_lists = $this->products_filter_lists_m->get_by_products_ids(array_values($products_ids), 0);

        $products_filter_lists = array_reduce($products_filter_lists, function ($total, $row) use ($filter_id) {
            return $row->filter_id == $filter_id ? array_merge($total, [$row]) : $total;
        }, []);

        echo json_encode($products_filter_lists);
    }
}
