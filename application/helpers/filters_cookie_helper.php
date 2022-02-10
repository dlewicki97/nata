<?php
defined('BASEPATH') or exit('No direct script access allowed');

function get_filters_cookie()
{
    $CI = &get_instance();
    if (!isset($_COOKIE['filters'])) return [];
    $cookie_filters = explode(',', $_COOKIE['filters']);
    ob_start();
    var_dump($cookie_filters);
    $result = ob_get_clean();
    echo "<pre class=\"d-none\">$result</pre>";

    $filter_lists = [];
    foreach ($cookie_filters as $cookie) {
        array_push($filter_lists, $CI->back_m->get_one('filter_lists', $cookie));
    }

    return $filter_lists;
}