<?php
defined('BASEPATH') or exit('No direct script access allowed');

function get_sort_uri(): String
{
    $CI = &get_instance();

    if ($CI->uri->segment(2) == 'kategoria') return "/kategoria/{$CI->uri->segment(4)}/" . ($CI->uri->segment(5) ?? 0);
    else if ($CI->uri->segment(1) == 'nowosci') return "/nowosci/" . ($CI->uri->segment(2) ?? 0);
    else if ($CI->uri->segment(1) == 'outlet') return "/outlet/" . ($CI->uri->segment(2) ?? 0);
    else return "/{$CI->uri->segment(2)}";
}