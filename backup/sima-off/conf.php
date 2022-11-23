<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'http://192.168.100.7/ci_api/api/'
]);