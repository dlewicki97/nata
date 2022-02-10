<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function addMedia($data = '') {
    $CI = &get_instance();
    $media['name'] = $data['file_name']; 
	$media['raw_name'] = $data['raw_name'];   
	$media['type'] = $data['file_type'];   
	$media['size'] = $data['file_size'];   
	$media['full_path'] = $data['full_path'];   
	$media['file_path'] = $data['file_path'];  
	if($CI->back_m->insert('media', $media)){
        return true;
    } else {
        return false;
    }
}

function randomPhotoName() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    $pass[] = 1;
    return implode($pass);
}