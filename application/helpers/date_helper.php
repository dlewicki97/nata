<?php
defined('BASEPATH') or exit('No direct script access allowed');

function format_date($date)
{
    $months = ['stycznia', 'lutego', 'marca', 'kwietnia', 'maja', 'czerwca', 'lipca', 'sierpnia', 'września', 'października', 'listopada', 'grudnia'];
    $day = date("d", strtotime($date));
    $month = $months[intval(date("m", strtotime($date))) - 1];
    $year = date("Y", strtotime($date));
    return "$day $month $year";
}