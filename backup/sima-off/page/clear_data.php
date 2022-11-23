<?php 
$file = '../json/audited.json';

$isi = file_get_contents($file);

$data= json_decode($isi,true);
foreach ($data as $key => $val) {
    // array_splice($data, $key, 1);
    array_splice($data,$key,1000);
}
$json = json_encode($data,JSON_PRETTY_PRINT);

file_put_contents($file,$json);
$file = '../json/unit_temp.json';

$isi = file_get_contents($file);

$data= json_decode($isi,true);
foreach ($data as $key => $val) {
    // array_splice($data, $key, 1);
    array_splice($data,$key,1000);
}
$json = json_encode($data,JSON_PRETTY_PRINT);

file_put_contents($file,$json);
$file = '../json/audit.json';

$isi = file_get_contents($file);

$data= json_decode($isi,true);
foreach ($data as $key => $val) {
    // array_splice($data, $key, 1);
    array_splice($data,$key,1000);
}
$json = json_encode($data,JSON_PRETTY_PRINT);

file_put_contents($file,$json);
?>