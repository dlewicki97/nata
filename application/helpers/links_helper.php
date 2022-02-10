<?php
defined('BASEPATH') or exit('No direct script access allowed');


function base($path = "")
{
    return base_url($path);
}

function file_url($path)
{
    return base_url('uploads/' . $path);
}

function assets($uri = "")
{
    return base_url("assets/front/$uri");
}