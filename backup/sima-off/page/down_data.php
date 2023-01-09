<?php 
$cabang = $_POST['id_cabang'];
$tgl = date('Y-m-d');

$file = '../json/audit.json';

$isi = file_get_contents($file);

$data= json_decode($isi,true);
$data[]=array(
    'id_cabang' => $cabang,
    'tanggal_audit' => $tgl
);

$json = json_encode($data,JSON_PRETTY_PRINT);

file_put_contents($file,$json);

// phpinfo();
$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,"http://localhost/ci-api/api/audit/dataunit2?id_cabang=".$cabang);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$output = json_decode(curl_exec($ch),true);
 
// print_r($output['data']);
foreach ($output['data'] as $res) {
   $get = '../json/unit_temp.json';
   
   $isi2 = file_get_contents($get);
   $data2= json_decode($isi2,true);
   $data2[] =[
       'no_mesin' => $res['no_mesin'],
       'no_rangka' => $res['no_rangka'],
       'id_cabang' => $res['kd_dealer'],
       'id_lokasi' => $res['kd_gudang'],
       'kode_item' => $res['kd_item'],
       'type' => $res['sub_kategori'],
       'tahun' => $res['THN_PERAKITAN']
   ];
   
   
   $json = json_encode($data2,JSON_PRETTY_PRINT);
   
   file_put_contents($get,$json);
}
curl_close($ch);

header('location:audit_unit.php')

?>