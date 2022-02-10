<?php
defined('BASEPATH') or exit('No direct script access allowed');

function get_product_variants(object $product): array
{
    $CI = &get_instance();
    $variants = [];

    if (!$product->id_commodity) return [];

    $variants = $CI->back_m->get_where_result('products', ['id_commodity' => $product->id_commodity]);
    usort($variants, function ($a, $b) {
        return $a->name > $b->name ? 1 : -1;
    });

    return $variants;
}