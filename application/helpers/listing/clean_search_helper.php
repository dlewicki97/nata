<?php defined('BASEPATH') or exit('No direct script access allowed');

function clean_search()
{
    unset($_COOKIE['search']);
    setcookie('search', null, -1, '/');
}