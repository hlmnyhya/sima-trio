<?php 

require 'partial.php';
    $post= json_decode(file_get_contents('php://input'),true);

    $username= $post['username'];
    $password=$post['password'];
    // $password =$_GET['password'];
    // $username = $_GET['username'];
    $respon = $login->request('GET','login',[
        'query' =>[
            'username' => $username,
            'password' => $password,
        ]
    ]);
            
    $result = $respon->getBody()->getContents();
    echo $result;
    // $result=file_get_contents('php://input');
    // echo $result;



