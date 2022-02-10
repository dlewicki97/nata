<?php
defined('BASEPATH') or exit('No direct script access allowed');

function getTransactionStatus($status)
{
    switch ($status) {
        case 0:
            return ['message' => "W trakcie realizacji", 'color' => "during"];
            break;
        case 1:
            return ['message' => "Anulowane przez administratora", 'color' => "warning"];
            break;
        case 2:
            return ['message' => "Anulowane przez klienta", 'color' => "warning"];
            break;
        case 3:
            return ['message' => "Zatwierdzone", "color" => "during"];
            break;
        case 4:
            return ['message' => "Wysłane", "color" => "during"];
            break;
        case 5:
            return ['message' => 'Zrealizowane', "color" => 'success'];
            break;
        default:
            return ["message" => "", "color" => ""];
            break;
    }
}