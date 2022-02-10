<?php
defined('BASEPATH') or exit('No direct script access allowed');

function isJson($string)
{
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

function cUrlGetData($url, $post_fields = null, $headers = null)
{
    $ret = false;
    $mess = '';
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($post_fields && !empty($post_fields)) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    }
    if ($headers && !empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    if (curl_errno($ch)) {
        $ret = false;
        $mess = curl_error($ch);
    } else {
        $ret = true;
    }
    curl_close($ch);
    return ['ret' => $ret, 'mess' => $mess, 'data' => $data];
}

function furgonetka_extra_services($code)
{
    $arr = [
        'cod' => 'Pobranie przy doręczeniu',
        'cod_express' => 'Pobranie przy doręczeniu Express',
        'guarantee_0930' => 'Doręczenie do godziny 9:30',
        'guarantee_1200' => 'Doręczenie do godziny 12:00',
        'saturday_delivery' => 'Doręczenie przesyłki w sobotę. W celu realizacji usługi przesyłka powinna być nadana w piątek.',
        'rod' => 'Dokumenty zwrotne',
        'fragile' => 'Usługa "Ostrożnie"',
        'sms_predelivery_information' => 'Awizacja SMS-owa dostawy',
        'ups_saver' => 'UPS Express Saver',
        'private_shipping' => 'Doręczenie do osoby prywatnej',
        'fedex_priority' => 'FedEx Priority',
        'sending_at_point' => 'Nadanie w punkcie (DPD Pickup, UPS Access Point)',
        'insurance' => 'Usługa "Ostrożnie"',
        'self_pickup' => 'Nadanie w oddziale. Paczka z tą usługą nie może być anulowana po zamówieniu',
        'additional_handling' => 'Dodatkowa obsługa'
    ];
    if (array_key_exists($code, $arr)) {
        return $arr[$code];
    } else {
        return $code;
    }
}
