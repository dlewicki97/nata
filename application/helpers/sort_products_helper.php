<?php
defined("BASEPATH") or exit("No direct script access allowed");

function sort_products()
{
    $CI = &get_instance();

    $where = [];
    $like = [];
    $order_by = [];
    $where_in = [];

    if (isset($_COOKIE['filters'])) {
        $where_in = filter_products();
    }
    if (isset($_COOKIE['priceSort'])) {
        $CI->load->model('margin_m');
        $priceSort = json_decode($_COOKIE['priceSort']);

        $minPrice = $priceSort[0];
        $maxPrice = $priceSort[1];

        $minMargin = $CI->margin_m->get(number_format($minPrice, 2));
        $maxMargin = $CI->margin_m->get(number_format($maxPrice, 2));

        if ($minMargin) $minPrice = $minPrice * ((100 + (int)$minMargin->margin) / 100);
        if ($maxMargin) $maxPrice = $maxPrice * ((100 + (int)$maxMargin->margin) / 100);

        if (isset($_SESSION['discount']) && $_SESSION['discount'] > 0) {
            $minPrice *= ((100 - $_SESSION['discount']) / 100);
            $maxPrice *= ((100 - $_SESSION['discount']) / 100);
        }

        // $CI->db->where(['price_brutto >=' => $minPrice, 'price_brutto <=' => $maxPrice]);
        $where[] = ['price_brutto >=' => $minPrice, 'price_brutto <=' => $maxPrice];
    }

    // $CI->db->where('active', 1);
    // $CI->db->where('price_brutto >', 0);
    array_push($where, ['active' => 1], ['price_brutto >' => 0]);
    if (isset($_COOKIE['search'])) {
        // $CI->db->group_start();
        // $CI->db->like('products.name', $_COOKIE['search']);
        // $CI->db->or_like('products.linia', $_COOKIE['search']);
        // $CI->db->or_like('products.grupa', $_COOKIE['search']);
        // $CI->db->or_like('products.plec', $_COOKIE['search']);
        // $CI->db->or_like('products.typoferty', $_COOKIE['search']);
        // $CI->db->group_end();

        array_push($like, ['products.name' => $_COOKIE['search']], ['products.linia' => $_COOKIE['search']], ['products.grupa' => $_COOKIE['search']], ['products.plec' => $_COOKIE['search']], ['products.typoferty' => $_COOKIE['search']]);
        // $pro$CI->db->query('SELECT ')
    }
    if (isset($_COOKIE['sort'])) {
        $col = explode('|', $_COOKIE['sort'])[0];
        $type = explode('|', $_COOKIE['sort'])[1];
        // $CI->db->order_by($col === 'price' ? 'price_brutto' : $col, $type);
        $order_by = ['col' => $col === 'price' ? 'price_brutto' : $col, 'type' => $type];
    } else {
        // $CI->db->order_by("created", "desc");
        $order_by = ['col' => "created", 'type' => "desc"];
    }

    if (!empty($where_in)) $CI->db->where_in('products.id', $where_in);

    foreach ($where as $arr) {
        $CI->db->where($arr);
    }

    foreach ($like as $i => $arr) {
        foreach ($arr as $key => $value) {

            if ($i === 0) {
                $CI->db->group_start();
                $CI->db->like($key, $value);
            } elseif ($i === count($like) - 1) {
                $CI->db->group_end();
            } else {
                $CI->db->or_like($key, $value);
            }
        }
    }

    if (!empty($order_by)) $CI->db->order_by($order_by['col'], $order_by['type']);
}

function filter_products()
{
    $CI = &get_instance();
    $cookie_filters = explode(',', $_COOKIE['filters']) ?? [];
    $products_ids = [];

    foreach ($cookie_filters as $filter) {
        $products_filter_lists = $CI->back_m->get_all_where('products_filter_lists', 'filter_list_id', $filter);
        foreach ($products_filter_lists as $list) {
            array_push($products_ids, $list->product_id);
        }
    }

    if (!empty($products_ids)) {
        // $CI->db->where_in('products.id', $products_ids);
    }
    return $products_ids;
}