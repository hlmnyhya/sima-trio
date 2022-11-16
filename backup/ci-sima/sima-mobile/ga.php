<?php 

require 'partial.php';
// var_dump($client);die;
if($_GET['aksi']=='getjenisinv'){
    $respon = $client->request( 'GET', 'jenisinv');
    
    $result = $respon->getBody()->getContents();
    echo $result;

}elseif ($_GET['aksi'] =='getsubinv') {
    $respon = $client->request( 'GET', 'subinv');
    
    $result = $respon->getBody()->getContents();
    echo $result;
}elseif ($_GET['aksi'] =='getjenaudit') {
    $respon = $client->request( 'GET', 'jenisaudit');
    
    $result = $respon->getBody()->getContents();
    echo $result;
}elseif ($_GET['aksi']=='getinv') {
    $respon = $client2->request( 'GET', 'inv');
    
    $result = $respon->getBody()->getContents();
    echo $result;
}elseif ($_GET['aksi']=='getcabang') {
    $respon = $client->request( 'GET', 'cabang');
    
    $result = $respon->getBody()->getContents();
    echo $result;
}elseif ($_GET['aksi']=='getlokasi') {
    $respon = $client->request( 'GET', 'lokasi');
    
    $result = $respon->getBody()->getContents();
    echo $result;
}elseif($_GET['aksi']=='getsubinv'){
    $respon = $client->request( 'GET', 'subinv');
    
    $result = $respon->getBody()->getContents();
    echo $result;
}elseif($_GET['aksi']=='getjenisinv'){
    $respon = $client->request( 'GET', 'jenisinv');
    
    $result = $respon->getBody()->getContents();
    echo $result;
}elseif($_GET['aksi']=='getstatusinv'){
    $respon = $client->request( 'GET', 'statusinv');
    
    $result = $respon->getBody()->getContents();
    echo $result;
}elseif($_GET['aksi']=='getvendor'){
    $respon = $client->request( 'GET', 'vendor');
    
    $result = $respon->getBody()->getContents();
    echo $result;
    
}