<?php
defined('BASEPATH') or exit('No direct script access allowed');


function show_collapse(int $active_category_id): bool
{
    $CI = &get_instance();
    $CI->load->helper('listing/categories/show_collapse/get_active_categories_path');

    $active_categories_path = get_active_categories_path();

    return in_array($active_category_id, $active_categories_path);
}
