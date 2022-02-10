<?php

function remove_subcategory_prefix(string $subcategoryName): string {
    preg_match('/([A-Z0-9]){2,3} \-/', $subcategoryName, $matches);

    return str_replace($matches[0] ?? "", "", $subcategoryName) ;
}