<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: multipart/form-data');
require 'vendor/autoload.php';

use GuzzleHttp\Client;
// $base_url = "http://168.168.2.124/";
// $host = getHostByName(getHostName()) ;
// $base_url = "http://".$host."/ci-api/";
$base_url = "http://168.168.0.114/ci-api/api/";
$client = new Client([
'base_uri' => $base_url.'master/'
]);
$client2 = new Client([
    'base_uri' => $base_url.'transaksi/'
]);
$client3 = new Client([
    'base_uri' => $base_url.'audit/'
]);
$config = new Client([
    'base_uri' => $base_url.'config/'
]);
$login = new Client([
    'base_uri' => $base_url
]);