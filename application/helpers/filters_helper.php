<?php
defined('BASEPATH') or exit('No direct script access allowed');

function load_filter_lists($filters, $category_id = null)
{
    $CI = &get_instance();
    $CI->load->model('products_categories_m');
    $CI->load->model('products_filter_lists_m');

    $filter_lists = [];

    $products_ids = $CI->products_categories_m->get_products_ids($category_id);
    $products_ids = array_reduce($products_ids, function ($total, $product_id) {
        return array_merge($total, [$product_id->product_id]);
    }, []);
    $products_filter_lists = $CI->products_filter_lists_m->get_by_products_ids(array_values($products_ids), 0);

    foreach ($filters as $filter) {
        $filter_lists[$filter->id] = array_slice(array_reduce($products_filter_lists, function ($total, $products_filter_list) use ($filter) {
            return $products_filter_list->filter_id == $filter->id ? array_merge($total, [$products_filter_list]) : $total;
        }, []), 0, 4);
    }
    return $filter_lists;
}