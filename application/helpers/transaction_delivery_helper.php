<?php
defined('BASEPATH') or exit('No direct script access allowed');

function getTransactionDelivery($delivery)
{
    switch ($delivery) {
        case "kurier":
            return "Kurier";
            break;
        case "pobranie":
            return "Kurier za pobraniem";
            break;
        case "osobisty":
            return "Odbiór osobisty";
            break;
        default:
            return "";
            break;
    }
}