<?php
defined("BASEPATH") or exit("No direct script access allowed");

function set_product_categories($categories, $product_id)
{
    $CI = &get_instance();

    $saved_categories = $CI->shop_m->get_product_categories($product_id);

    foreach ($saved_categories as $saved) {
        if (!in_array($saved->category_id, $categories)) {
            $CI->back_m->delete('products_categories', $saved->id);
        }
    }

    foreach ($categories as $category_id) {
        if (count($CI->shop_m->is_category_exist($category_id, $product_id)) > 0) continue;
        $CI->back_m->insert('products_categories', ['product_id' => $product_id, 'category_id' => $category_id]);
    }
}

function is_category_selected($category_id, $product_id)
{
    $CI = &get_instance();

    return count($CI->shop_m->is_category_exist($category_id, $product_id)) > 0;
}

function is_filter_list_selected($filter_list_id, $product_id)
{
    $CI = &get_instance();

    return count($CI->shop_m->is_filter_list_exist($filter_list_id, $product_id)) > 0;
}

function set_filter_list($filter_list_ids, $product_id)
{
    $CI = &get_instance();

    $saved_filter_lists = $CI->back_m->get_all_where('products_filter_lists', 'product_id', $product_id);

    foreach ($saved_filter_lists as $saved) {
        // if (is_producer_filter($saved)) continue;
        if (!in_array($saved->filter_list_id, $filter_list_ids)) {
            $CI->back_m->delete('products_filter_lists', $saved->id);
        }
    }

    foreach ($filter_list_ids as $filter_list_id) {
        if (count($CI->shop_m->is_filter_list_exist($filter_list_id, $product_id)) > 0) continue;
        $CI->back_m->insert('products_filter_lists', ['product_id' => $product_id, 'filter_list_id' => $filter_list_id]);
    }
}

function set_producer($producer_id, $product_id)
{
    $CI = &get_instance();

    $producer_filter = get_producer_filter($product_id);
    $data = ['filter_list_id' => $producer_id, 'product_id' => $product_id];
    $producer_filter ? $CI->back_m->update('products_filter_lists', $data, $producer_filter->id) : $CI->back_m->insert('products_filter_lists', $data);
}

function is_producer_filter($products_filter_lists)
{
    $CI = &get_instance();

    $filter_list = $CI->back_m->get_one('filter_lists', $products_filter_lists->filter_list_id);
    $filter = $CI->back_m->get_one('filters', $filter_list->filter_id);

    return $filter->sort_key === 'producer';
}
function get_producer_filter($product_id)
{
    $CI = &get_instance();

    $saved_filter_lists = $CI->back_m->get_all_where('products_filter_lists', 'product_id', $product_id);

    $producer_filter = null;

    foreach ($saved_filter_lists as $saved) {
        $filter_list = $CI->back_m->get_one('filter_lists', $saved->filter_list_id);
        $filter = $CI->back_m->get_one('filters', $filter_list->filter_id);
        if ($filter->sort_key == 'producer') $producer_filter = $saved;
    }



    return $producer_filter;
}


function prepare_filter_list($filter_sort_key, $product_id)
{
    $CI = &get_instance();

    $filter = $CI->back_m->get_where('filters', 'sort_key', $filter_sort_key);

    $products_filter_lists = $CI->back_m->get_all_where('products_filter_lists', 'product_id', $product_id);
    $filter_lists = [];
    foreach ($products_filter_lists as $list) {
        $filter_list = $CI->back_m->get_one('filter_lists', $list->filter_list_id);

        if ($filter_list->filter_id === $filter->id) array_push($filter_lists, $filter_list);
    }
    $rnd_filter_lists = $CI->shop_m->get_filter_lists($filter->id);

    return array_merge($filter_lists, $rnd_filter_lists);
}