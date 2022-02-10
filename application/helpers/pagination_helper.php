<?php
defined('BASEPATH') or exit('No direct script access allowed');


function paginate($data, $perPage, $total_rows, $link)
{
    $CI = &get_instance();

    $CI->load->library('pagination');
    $config['base_url'] = base_url($link);
    $config['total_rows'] = $total_rows;
    $config['per_page'] = $perPage;
    $config['next_link'] = '<img src="' . assets() . 'img/main/arrow-right.svg" alt="">';
    $config['prev_link'] = '<img src="' . assets() . 'img/main/arrow-left.svg" alt="">';
    $config['first_link'] = '<img src="' . assets() . 'img/main/double-left-arrow.svg" alt="" class="invert">';
    $config['last_link'] = '<img src="' . assets() . 'img/main/double-right-arrow.svg" alt="" class="invert">&nbsp;/&nbsp;' . ((int)($total_rows / $perPage));
    $CI->pagination->initialize($config);
}