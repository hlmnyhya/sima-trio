<?php

require 'partial.php';

if ($_GET['aksi']=='getuser') {
    $get = json_decode(file_get_contents('php://input'),true);
    // $get = $_GET;
    $id = $get['id'];
    $password = $get['password'];
    $respon = $client->request('GET' ,'userpass',[
        'query' =>[
            'id' => $id,
            'password' => $password
        ]
    ]);

    $result = $respon->getBody()->getContents();
    echo $result;
}elseif ($_GET['aksi']=='putpassword') {
    $put = json_decode(file_get_contents("php://input"),true);
    $id = $put['id'];
    $password = $put['password'];
    $respon = $client->request('PUT' ,'userpass',[
        'form_params' =>[
            'id' => $id,
            'password' => $password
        ]
    ]);

    $result = $respon->getBody()->getContents();
    echo $result;
}