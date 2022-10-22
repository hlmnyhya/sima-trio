<?php 

require 'partial.php';
// var_dump($client);die;
set_time_limit(0);
try {
if($_GET['aksi']=='getjenisinv'){
    $respon = $client->request( 'GET', 'jenisinv');
    
    $result = $respon->getBody()->getContents();
    echo $result;

}elseif ($_GET['aksi'] =='getsubinv') {
    $respon = $client->request( 'GET', 'subinv');
    
    $result = $respon->getBody()->getContents();
    echo $result;
}elseif ($_GET['aksi'] =='getsubinvjenis') {
    $get = json_decode(file_get_contents('php://input'),true);
    $id = $get['id'];
    $respon = $client->request( 'GET', 'subinvjenis',[
        'query' =>[
            'id' => $id
        ]
    ]);
    
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
}elseif ($_GET['aksi']=='getlokasiid') {
    $get = json_decode(file_get_contents('php://input'),true);
    $id = $get['id'];
    $respon = $client->request( 'GET', 'lokasicabang',[
        'query'=>[
            'id_cabang' => $id
        ]
    ]);
    
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
    
}elseif($_GET['aksi']=='searchjenisinv'){
    $get = json_decode(file_get_contents('php://input'),true);
    $id = $get['id'];
    $respon = $client->request('GET', 'carijenisinv',[
        'query'=>[
            'jenisinv' => $id
        ]
    ]);

    $result = $respon->getBody()->getContents();
    echo $result;
}elseif($_GET['aksi']=='searchsubinv'){
    $get = json_decode(file_get_contents('php://input'),true);
    $id = $get['id'];
    $respon = $client->request('GET', 'carisubinv2',[
        'query'=>[
            'id' => $id
        ]
    ]);

    $result = $respon->getBody()->getContents();
    echo $result;
}elseif($_GET['aksi']=='searchjenisaudit'){
    $get = json_decode(file_get_contents('php://input'),true);
    $id = $get['id'];
    $respon = $client->request('GET', 'carijenisaudit',[
        'query'=>[
            'jenisaudit' => $id
        ]
    ]);

    $result = $respon->getBody()->getContents();
    echo $result;
}elseif($_GET['aksi']=='searchinv'){
    $get = json_decode(file_get_contents('php://input'),true);
    $id = $get['id'];
    $respon = $client2->request('GET', 'cariinv',[
        'query'=>[
            'id' => $id
        ]
    ]);

    $result = $respon->getBody()->getContents();
    echo $result;
}elseif($_GET['aksi']=='postinv'){
    $post = json_decode(file_get_contents('php://input'),true);
    $data =[
        'idtransaksi_inv' => $post['idtransaksi_inv'],
        'idstatus_inventory' => $post['idstatus_inventory'],
        'idjenis_inventory' =>$post['idjenis_inventory'],
        'idsub_inventory' => $post['idsub_inventory'],
        'nilai_awal' => $post['nilai_awal'],
        'ddp' => $post['ddp'],
        'nilai_asset' => $post['nilai_asset'],
        'nilai_total_keseluruhan' => $post['nilai_total_keseluruhan' ],
        'tanggal_barang_diterima' =>$post['tanggal_barang_diterima'],
        'id_vendor' => $post['id_vendor' ],
        'id_cabang' => $post['id_cabang' ],
        'id_lokasi' => $post['id_lokasi' ],
        'jenis_pembayaran' => $post['jenis_pembayaran'],
        'id_lokasi' => $post['id_lokasi' ],
        'nama_pengguna' => $post['nama_pengguna' ],              
        'keterangan' => $post['keterangan' ],
        'stok' => $post['stok' ],
        'ppn' => $post['ppn' ],
        'merk' => $post['merk'],
        'serial_number' => $post['serial_number' ],
        'uang_muka' => $post['uang_muka'],
        'cicilan_perbulan' => $post['cicilan_perbulan'],
        'tenor' => $post['tenor'],
        'nilai_total' => $post['nilai_total'],
        'no_mesin' => $post['no_mesin'],
        'no_rangka' => $post['no_rangka']
    
];
    $respon = $client2->request('POST', 'inv',[
        'form_params'=>$data
    ]);

    $result = $respon->getBody()->getContents();
    echo $result;
}elseif ($_GET['aksi']=='countinv') {
    $respon = $client2->request('GET', 'countOffice');

    $result = $respon->getBody()->getContents();
    echo $result;
}
} catch ( RuntimeException $e) {
    $result =[
        'status' => false,
        'data' => 'Check Connection'
    ];
    echo json_encode($result,true);
}