<?php
defined('BASEPATH') or exit('No direct script access allowed');

function decrementVariant($product_id, $qty)
{
    $CI = &get_instance();
    $variant = $CI->back_m->get_where('variants', 'product_id', $product_id);
    $new_qty = $variant->qty - $qty;
    if ($new_qty < 0) $new_qty = 0;
    $CI->back_m->update('variants', ['qty' => $new_qty] , $variant->id);
}