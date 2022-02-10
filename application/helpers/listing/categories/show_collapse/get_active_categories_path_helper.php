<?php
defined('BASEPATH') or exit('No direct script access allowed');


function get_active_categories_path(): array
{
    $CI = &get_instance();
    $active_category_id = $CI->uri->segment(4);
    if (!$active_category_id) return [];

    $active_categories_path = [];
    do {
        $parent_category = $CI->back_m->get_one('categories', $active_category_id);
        if (!$parent_category->parent_category_id) break;
        $active_categories_path[] = $parent_category->parent_category_id;
        $active_category_id = $parent_category->parent_category_id;
    } while ($parent_category->parent_category_id);

    return $active_categories_path;
}