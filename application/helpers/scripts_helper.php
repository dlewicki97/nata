<?php
defined('BASEPATH') or exit('No direct script access allowed');

function load_scripts()
{
    $CI = &get_instance();

    $scripts = $CI->back_m->get_all('scripts_editor');

    return [
        'head' => $scripts[0],
        'footer' => $scripts[1],
        'product' => $scripts[2],
        'cart' => $scripts[3],
        'summary' => $scripts[4]
    ];
}