<?php
defined('BASEPATH') or exit('No direct script access allowed');

function isSelected($parent_id, $option_id, $current_value)
{
    return (@$current_value->subpage_id == $option_id || $parent_id == $option_id);
}