<?php

require "partial.php";

if($_GET['audit']=='post'){
    $post = json_decode(file_get_contents('php://input'),true);
    // $post = $_GET;
    $data=[
        'idjadwal_audit' => $post['idjadwal'],
        'tanggal' => $post['tanggal'],
        'waktu' => $post['waktu'],
        'auditor' => $post['auditor'],
        'idjenis_audit' => $post['jenis_audit'],
        'id_cabang' => $post['cabang']
    ];
    $respon = $client3->request('POST', 'audit',[
        'form_params' => $data
    ]);

    $result = $respon->getBody()->getContents();
    echo $result;
}elseif ($_GET['audit'] =='get') {
    $respon = $client3->request('GET', 'audit');

    $result = $respon->getBody()->getContents();
    echo $result;
}elseif($_GET['audit']=='getunit'){
    $respon = $client3->request('GET', 'tempunit');

    $result = $respon->getBody()->getContents();
    echo $result;
}elseif($_GET['audit']=='getdet'){
    $post = json_decode(file_get_contents('php://input'),true);

    $id = $post['id'];
    $respon = $client3->request('GET', 'listaud',[
        'query' =>[
            'id' => $id
        ]
    ]);

    $result = $respon->getBody()->getContents();
    echo $result;
}elseif($_GET['audit']=='detpost'){
    $post = json_decode(file_get_contents('php://input'),true);
    $data=[
        'id_unit' => $post['idunit'],
        'no_motor' => $post['nomesin'],
        'no_rangka' => $post['norangka'],
        'buku_service' => $post['buku'],
        'umur_unit' => $post['umur'],
        'helm' => $post['helm'],
        'aki' => $post['aki'],
        'tools' => $post['tools'],
        'spion' => $post['spion'],
        'status' => $post['status'],
        'keterangan' => $post['keterangan'],
    ];
    $respon = $client3->request('POST', 'listaud',[
        'form_params' => $data
    ]);

    $result = $respon->getBody()->getContents();
    echo $result;
}elseif($_GET['audit']=='list'){
    $respon = $client3->request('GET', 'list');

    $result = $respon->getBody()->getContents();
    echo $result;
}elseif($_GET['audit']=='getlist'){
    $post = json_decode(file_get_contents('php://input'),true);

    $id = $post['id'];
    // $id = $_GET['id'];
    $respon = $client3->request('GET', 'list',[
        'query'=>[
            'id'=> $id
        ]
    ]);

    $result = $respon->getBody()->getContents();
    echo $result;
}elseif($_GET['audit']=='getauditbefore'){
    $respon = $client3->request('GET', 'auditbefore');

    $result = $respon->getBody()->getContents();
    echo $result;
}elseif ($_GET['audit']=='auditend') {
    $respon = $client3->request('GET', 'auditend');

    $result = $respon->getBody()->getContents();
    echo $result;
}elseif ($_GET['audit']=='putaudit') {
    $post = json_decode(file_get_contents('php://input'),true);
    $data=[
        'idjadwal_audit' => $post['idjadwal_audit'],
        'keterangan' => $post['keterangan'],
    ];
    $respon = $client3->request('PUT', 'auditket',[
        'form_params' => $data
    ]);

    $result = $respon->getBody()->getContents();
    echo $result;
}