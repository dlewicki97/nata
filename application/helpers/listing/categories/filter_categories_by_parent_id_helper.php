<?php
defined('BASEPATH') or exit('No direct script access allowed');


function filter_categories_by_parent_id(array $categories, int $parent_id): array
{
    return array_filter($categories, function ($category) use ($parent_id) {
        return $category->parent_category_id == $parent_id;
    });
}
