<?php 
$file = '../json/audited.json';

$isi = file_get_contents($file);

$data= json_decode($isi,true);
$data[]=array(
        "no_mesin"=> $_POST['no_mesin'],
        "no_rangka"=> $_POST['no_rangka'],
        "id_cabang"=> $_POST['id_cabang'],
        "id_lokasi"=> $_POST['id_lokasi'],
        "kode_item"=> $_POST['kode_item'],
        "type"=> $_POST['type'],
        "tahun"=> $_POST['tahun'],
        "status_unit" => $_POST['status'],
        "keterangan" => $_POST['ket'],
        "is_ready" => $_POST['rfs']
);

$json = json_encode($data,JSON_PRETTY_PRINT);

file_put_contents($file,$json);
$data= array(
    'status' => true
);
echo json_encode($data,true);
