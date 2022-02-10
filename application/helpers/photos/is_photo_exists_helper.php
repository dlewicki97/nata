<?php
defined('BASEPATH') or exit('No direct script access allowed');


function is_photo_exists(string $url): bool
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $code < 400;
}
