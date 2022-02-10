<?php
defined('BASEPATH') or exit('No direct script access allowed');

function load_headers()
{
    $CI = &get_instance();
    $headers = $CI->back_m->get_all('headers');

    $data['categories'] = $headers[0];
    $data['recommended'] = $headers[1];
    $data['handmade'] = $headers[2];
    $data['brands'] = $headers[3];

    return $data;
}