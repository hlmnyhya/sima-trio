<?php

require 'partial.php';

if($_GET['aksi']=='get'){
    $respon = $config->request('GET', 'config');

    $result = $respon->getBody()->getContents();

    // var_dump(json_decode(json_encode($result), True));
    $res =json_decode($result, True);
    // var_dump(is_array($res),is_object($res));
    foreach($res['data'] as $d) {
        // var_dump($d);
        $ip = $d['ip'];
        $ip2 = 'IPADDRESS';
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$ip2);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $ip = base64_decode($ip);
        $ip = openssl_decrypt($ip, $encrypt_method, $key, 0, $iv);

        $uname = $d['username'];
        $uname2 = 'USERNAME';
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$uname2);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $uname = base64_decode($uname);
        $username = openssl_decrypt($uname, $encrypt_method, $key, 0, $iv);

        $pass = $d['password'];
        $pass2 = 'PASSWORD';
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$pass2);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $pass = base64_decode($pass);
        $password = openssl_decrypt($pass, $encrypt_method, $key, 0, $iv);

        $db = $d['db'];
        $db2 = 'DATABASE';
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$db2);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $db = base64_decode($db);
        $database = openssl_decrypt($db, $encrypt_method, $key, 0, $iv);
    }
    $data =[
        'hostname' => $ip,
        'username' => $username,
        'password' => $password,
        'database' => $database
    ];
    $result=[
        'status' => true,
        'data' =>$data
    ];
    echo json_encode($result,true);
}elseif($_GET['aksi']=='put'){
    $post = json_decode(file_get_contents('php://input'),true);
    $data=[
        'id' =>$post['id'],
        'ip' =>$post['ip'],
        'username'=>$post['username'],
        'password'=>$post['password'],
        'db' =>$post['database']
    ];

    $respon = $config->request('PUT', 'config',[
        'form_params'=>$data
    ]);

    $result = $respon->getBody()->getContents();
    echo $result;
}