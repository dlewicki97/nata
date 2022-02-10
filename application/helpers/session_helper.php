<?php
defined('BASEPATH') or exit('No direct script access allowed');

function checkAccess($access_group = ['administrator', 'redaktor'], $role = "")
{
    if (!$role) $role = $_SESSION['rola'] ?? "";
    return in_array($role, $access_group);
}