<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Furgonetka {

    public function __construct() {

        $this->CI =& get_instance();
        $this->CI->load->helper('shipping');

    }

    public function create_token() {
        $furgonetka_settings = $this->CI->back_m->get_one('shop_settings', 1);
        $username = $furgonetka_settings->furgonetka_login;
        $password = $furgonetka_settings->furgonetka_password;
        $client_id = $furgonetka_settings->furgonetka_client_id;
        $client_secret = $furgonetka_settings->furgonetka_secret;
        if ($furgonetka_settings->furgonetka_sandbox == 1) {
            $url = "https://konto-test.furgonetka.pl/oauth/token";
        } else {
            $url = "https://konto.furgonetka.pl/oauth/token";
        }

        $post_fields = 'grant_type=password&scope=api&username=' . urlencode($username) . '&password=' . urlencode($password) . '&client_id=' . $client_id . '&client_secret=' . $client_secret;
        $headers = ['Authorization' => $furgonetka_settings->furgonetka_auth_head];


        $dat = cUrlGetData($url, $post_fields, $headers);

        if (!$dat['ret']) {
            return false;
        } elseif (!isJson($dat['data'])) {
            return false;
        } else {
            $arr = json_decode($dat['data'], true);
            $token = $arr['access_token'];
            return $token;
        }
    }

    function get_services() {
        $furgonetka_settings = $this->CI->back_m->get_one('shop_settings', 1);
        if ($furgonetka_settings->furgonetka_sandbox == 1) {
            $url = 'http://biznes-test.furgonetka.pl/api/soap/v2?wsdl';
        } else {
            $url = 'http://biznes.furgonetka.pl/api/soap/v2?wsdl';
        }
        try {
            $client = new \SoapClient($url, [
                'trace' => true,
                'cache_wsdl' => false,
            ]);

            $auth = [
                'access_token' => $this->create_token(),
            ];


            $services = $client->getServices([
                        'data' => [
                            'auth' => $auth,
                        ],
                    ])->getServicesResult;

            if (!$services->services) {
                if (!empty($services->errors)) {
                    $errors = $services->errors->item;
                }
                throw new \Exception('Nie zdołano pobrać listy przewoźników.');
            }

            $ret = [];

            for ($i = 0; $i < count($services->services->item); $i++) {
                if (in_array($services->services->item[$i]->type, ['dpd', 'dhl', 'fedex', 'ups', 'gls', 'poczta', 'inpostkurier']) && $services->services->item[$i]->name != 'Testowy') {
                    $services->services->item[$i]->name = mb_strtoupper($services->services->item[$i]->name, 'UTF-8');
                    $ret[] = $services->services->item[$i];
                }
            }

            return $ret;

            var_dump($ret);
        } catch (\Exception $e) {
            return false;
        }
    }

    function generate_shipment($id, $number, $service_type, $parcel_services, $products, $sender, $receiver) {
        $furgonetka_settings = $this->CI->back_m->get_one('shop_settings', 1);
        $ret = true;
        $mess = '';
        $data = NULL;
        if ($furgonetka_settings->furgonetka_sandbox == 1) {
            $url = 'http://biznes-test.furgonetka.pl/api/soap/v2?wsdl';
        } else {
            $url = 'http://biznes.furgonetka.pl/api/soap/v2?wsdl';
        }
        try {
            $client = new \SoapClient($url, [
                //$client = new \SoapClient('http://biznes.furgonetka.pl/api/soap/v2?wsdl', [
                'trace' => true,
                'cache_wsdl' => false,
            ]);

            $auth = [
                'access_token' => $this->create_token(),
            ];

            $services = $this->get_services();
            foreach ($services as $service) {
                if ($service->type === $service_type) {
                    $service_id = $service->id;
                    break;
                }
            }

            if (!isset($service_id)) {
                throw new \Exception('Nie zdołano ustalić service_id dla ' . $service_type);
            }

            // pobieram listę aktualnych regulaminów
            $regulations = $client->getRegulations([
                        'data' => [
                            'auth' => $auth,
                        ],
                    ])->getRegulationsResult;

            if (!$regulations->services) {
                if (!empty($regulations->errors)) {
                    $errors = $regulations->errors->item;
                }
                throw new \Exception('Nie zdołano pobrać listy regulaminów.');
            }

            $regulations = $regulations->services->item;

            // ustalam aktualną wersję regulaminu dla wybranego przewoźnika
            foreach ($regulations as $service) {
                if ($service->service_type === $service_type) {
                    $regulations_accept = $service->version;
                    break;
                }
            }

            if (!isset($regulations_accept)) {
                throw new \Exception('Nie ustalono regulaminu dla ' . $service_type);
            }

            // parametry naszej przesyłki
            $paramsPackages = [
                'data' => [
                    'auth' => $auth,
                    'partner_reference_number' => $number,
                    'service_id' => $service_id,
                    'type' => 'package',
                    'regulations_accept' => $regulations_accept,
                    'sender' => $sender,
                    'receiver' => $receiver,
                    'label' => [
                        'file_format' => 'pdf',
                        'page_format' => 'a6',
                    ],
                    'parcels' => $products,
                    'services' => $parcel_services,
                ],
            ];
            //print_r($sender);
            // wykonuje metodę "validatePackage", która sprawdzi poprawność parametrów przesyłki
            $validate = $client->validatePackage($paramsPackages)->validatePackageResult;

            //print_r($validate); exit;

            if (!empty($validate->errors)) {
                $errors = $validate->errors->item;
                $CI = &get_instance();
                $CI->load->library('session');
                $CI->session->set_flashdata('error_furgonetka', $errors);
                redirect($_SERVER['HTTP_REFERER']);
                exit;
                //throw new \Exception('Popraw parametry przesyłki.');
            }

            // parametry poprawne, wykonuje metodę "createPackage" aby utworzyć przesyłkę
            $package = $client->createPackage($paramsPackages)->createPackageResult;

            if (!empty($package->errors)) {
                $errors = $package->errors->item;
                throw new \Exception('Nie udało się dodać przesyłki.');
            } 


            $count = count($package->parcels->item);

            if($count > 1) :
            $packages_numbers = '';
            foreach ($package->parcels->item as $message) {
                $packages_numbers .= $message->package_no . ',';
            }
            $packages_numbers = rtrim($packages_numbers, ',');
            $data['shipment_tracking_numbers'] =  $packages_numbers;
            else : 
            $data['shipment_tracking_numbers'] =  $package->parcels->item->package_no;
            endif;

            $data['transaction_id'] = $id;
            $data['service'] = $this->CI->uri->segment(5);
            $data['shipment_id'] = $package->id;
            $data['shipment_number'] = $package->partner_reference_number;
            $data['shipment_label'] = $package->documents->label->content;
            $data['shipment_protocol'] = $package->documents->protocol->content;

            $insert['status'] = 4;

		    $this->CI->back_m->update('transaction', $insert, $id);
            $this->CI->back_m->insert_furgonetka('shipment', $data);
            
            $this->CI->session->set_flashdata('flashdata', 'Przesyłka została pomyślnie wygenerowana');

            header('Content-type: application/pdf');
              header('Content-Disposition: attachment; filename='
              . 'etykieta_dla_zamowienia_' . ($package->partner_reference_number) . '.pdf');
              echo \base64_decode($package->documents->label->content);

        } catch (\Exception $e) {

            echo 'Błąd: ', $e->getMessage();

            // lista błędów zwrócona przez metodę z WebAPI Furgonetka Biznes
            if (isset($errors)) {
                \var_dump($errors);
            }
                }
    }

    function cancel_shipment($id) {
        $furgonetka_settings = $this->CI->back_m->get_one('shop_settings', 1);
        if ($furgonetka_settings->furgonetka_sandbox == 1) {
            $url = 'http://biznes-test.furgonetka.pl/api/soap/v2?wsdl';
        } else {
            $url = 'http://biznes.furgonetka.pl/api/soap/v2?wsdl';
        }
        try {
            $client = new \SoapClient($url, [
                'trace' => true,
                'cache_wsdl' => false,
            ]);

            $auth = [
                'access_token' => $this->create_token(),
            ];

            $ret=$client->cancelPackage([
                'data' => [
                    'auth' => $auth,
                    'id' => $id
                ],
            ]);

            $r=true;
            $mess='';
            if(isset($ret->cancelPackageResult->errors->item->message)){
                $r=false;
                $mess=$ret->cancelPackageResult->errors->item->message;
            }
            return ['ret'=>$r,'mess'=>$mess];
        } catch (\Exception $e) {
            return ['ret'=>false,'mess'=>''];
        }
    }

}
