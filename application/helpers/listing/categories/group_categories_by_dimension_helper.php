<?php
defined('BASEPATH') or exit('No direct script access allowed');


function group_categories_by_dimension(array $categories): array
{
    $groupped_categories = [];

    for ($i = 0; $i < count($categories); $i++) {
        $category = $categories[$i];

        $groupped_categories[$category->dimension][] = $category;
    }

    return $groupped_categories;
}