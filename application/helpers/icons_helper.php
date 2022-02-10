<?php
defined('BASEPATH') or exit('No direct script access allowed');

function load_icons()
{
    $CI = &get_instance();
    $icons = $CI->back_m->get_all('icons');
    $data['magnify-black'] = $icons[0];
    $data['heart-outline-black'] = $icons[1];
    $data['cart-black'] = $icons[2];
    $data['arrow-left-white'] = $icons[3];
    $data['arrow-right-white'] = $icons[4];
    $data['cart-white'] = $icons[5];

    return $data;
}