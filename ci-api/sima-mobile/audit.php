<?php
require "partial.php";
set_time_limit(0);
try {
    if($_GET['audit']=='post'){
        $post = json_decode(file_get_contents('php://input'),true);
        // $post = $_GET;
        $data=[
            'idjadwal_audit' => $post['idjadwal'],
            'tanggal' => $post['tanggal'],
            'waktu' => $post['waktu'],
            'auditor' => $post['auditor'],
            'idjenis_audit' => $post['jenis_audit'],
            'id_cabang' => $post['cabang'],
            'user' => $post['user']
        ];
        $respon = $client3->request('POST', 'audit',[
            'form_params' => $data
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif ($_GET['audit'] =='get') {
        $get = json_decode(file_get_contents('php://input'),true);
        $offset = $get['offset'];
        $respon = $client3->request('GET', 'audit',[
            'query'=>[
                'offset' => $offset
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif ($_GET['audit'] =='getjadwal') {
        $get = json_decode(file_get_contents('php://input'),true);
        $id = $get['idjadwal_audit'];
        $respon = $client3->request('GET', 'audit',[
            'query'=>[
                'id' => $id
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif($_GET['audit']=='getunit'){
        $get = json_decode(file_get_contents('php://input'),true);
        // $get = $_GET;
        $cabang = $get['cabang'];
        $offset = $get['offset'];
        $respon = $client3->request('GET', 'tounit',[
            'query'=>[
                'id_cabang' => $cabang,
                'offset' => $offset
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif($_GET['audit']=='getunitvalid'){
        $get = json_decode(file_get_contents('php://input'),true);
        // $get = $_GET;
        $cabang = $get['cabang'];
        $respon = $client3->request('GET', 'unitvalid',[
            'query'=>[
                'id_cabang' => $cabang,
                'offset'=>null
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif($_GET['audit']=='searchunit'){
        $get = json_decode(file_get_contents('php://input'),true);
        $id = $get['id'];
        $cabang = $get['cabang'];
        $respon = $client3->request('GET', 'cariunit',[
            'query'=>[
                'id' => $id,
                'id_cabang' => $cabang
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif($_GET['audit']=='searchnrfs'){
        $get = json_decode(file_get_contents('php://input'),true);
        $id = $get['id'];
        $cabang = $get['cabang'];
        $respon = $client3->request('GET', 'cariunitnrfs',[
            'query'=>[
                'id' => $id,
                'id_cabang' => $cabang
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif($_GET['audit']=='postready'){
        $post = json_decode(file_get_contents('php://input'),true);
    
        $data=[
            'part_number' => $post['part_number'],
            'no_mesin' => $post['no_mesin'],
            'no_rangka' =>$post['no_rangka'],
            'id_lokasi' =>$post['id_lokasi'],
            'id_cabang' =>$post['id_cabang'],
            'keterangan' =>$post['keterangan'],
            'kondisi' => $post['kondisi'],
            'penanggung_jawab' => $post['penanggung_jawab']
        ];
        $respon = $client3->request('POST', 'unitready',[
            'form_params'=>$data
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif($_GET['audit']=='searchaudit'){
        $get = json_decode(file_get_contents('php://input'),true);
        $id = $get['id'];
        $respon = $client3->request('GET', 'cariaudit',[
            'query'=>[
                'id' => $id
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif($_GET['audit']=='getdet'){
        $post = json_decode(file_get_contents('php://input'),true);
        // $post = $_GET;
        $id = $post['id'];
        $cabang = $post['cabang'];
        // $id = $_GET['id'];
        // $cabang = $_GET['cabang'];
        $respon = $client3->request('GET', 'listaud',[
            'query' =>[
                'id' => $id,
                'id_cabang' => $cabang
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif($_GET['audit']=='detpost'){
        $post = json_decode(file_get_contents('php://input'),true);
        // $post = $_GET;
        // var_dump($post);
        $data=[
            'id_unit' => $post['idunit'],
            'no_mesin' => $post['nomesin'],
            'no_rangka' => $post['norangka'],
            'umur_unit' => $post['umur'],
            'tahun' => $post['tahun'],
            'id_cabang' => $post['id_cabang'],
            'id_lokasi' => $post['id_lokasi'],
            'buku_service' => $post['buku'],
            'helm' => $post['helm'],
            'aki' => $post['aki'],
            'tools' => $post['tools'],
            'spion' => $post['spion'],
            'status' => $post['status'],
            'is_ready' => $post['is_ready'],
            'foto' => $post['foto'],
            'type' => $post['type'],
            'kode_item' => $post['kode_item']
        ];
        $respon = $client3->request('POST', 'listaud',[
            'form_params' => $data
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
        // echo json_encode($data,true);
    }elseif($_GET['audit']=='detput'){
        $post = json_decode(file_get_contents('php://input'),true);
        // $post = $_GET;
        // var_dump($post);
        $data=[
            'id' => $post['nomesin'],
            'no_mesin' => $post['nomesin'],
            'no_rangka' => $post['norangka'],
            'umur_unit' => $post['umur'],
            'tahun' => $post['tahun'],
            'id_cabang' => $post['id_cabang'],
            'id_lokasi' => $post['id_lokasi'],
            'buku_service' => $post['buku'],
            'helm' => $post['helm'],
            'aki' => $post['aki'],
            'tools' => $post['tools'],
            'spion' => $post['spion'],
            'status' => $post['status'],
            'is_ready' => $post['is_ready'],
            'foto' => $post['foto'],
            'type' => $post['type'],
            'keterangan'=> $post['keterangan'],
            'kode_item' => $post['kode_item']
        ];
        $respon = $client3->request('PUT', 'listaud',[
            'form_params' => $data
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif($_GET['audit']=='list'){
        $get = json_decode(file_get_contents('php://input'),true);
        // $get = $_GET;
        $id = $get['cabang'];
        $respon = $client3->request('GET', 'list',[
            'query'=>[
                'id_cabang' => $id
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif($_GET['audit']=='liststatus'){
        $get = json_decode(file_get_contents('php://input'),true);
        $status = $get['status_unit'];
        $cabang = $get['cabang'];
        $respon = $client3->request('GET', 'liststatus',[
            'query' => [
                'status_unit' => $status,
                'id_cabang' => $cabang
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif($_GET['audit']=='searchstatus'){
        $get = json_decode(file_get_contents('php://input'),true);
        $id = $get['id'];
        $status = $get['status'];
        $cabang = $get['cabang'];
        $respon = $client3->request('GET', 'searchstatus',[
            'query' => [
                'id' => $id,
                'status_unit' => $status,
                'id_cabang' => $cabang
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif($_GET['audit']=='getlist'){
        $post = json_decode(file_get_contents('php://input'),true);
    
        $id = $post['id'];
        $cabang = $post['cabang'];
        // $id = $_GET['id'];
        $respon = $client3->request('GET', 'list',[
            'query'=>[
                'id'=> $id,
                'id_cabang' => $cabang
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif($_GET['audit']=='getauditbefore'){
        $get = json_decode(file_get_contents('php://input'),true);
        $cabang = $get['cabang'];
        $respon = $client3->request('GET', 'auditbefore',[
            'query'=>[
                'id_cabang' => $cabang
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif ($_GET['audit']=='auditend') {
        $get = json_decode(file_get_contents('php://input'),true);
        $cabang = $get['cabang'];
        $respon = $client3->request('GET', 'auditend',[
            'query'=>[
                'id_cabang' => $cabang
            ]
        ]);
    
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
    }elseif ($_GET['audit']=='putmethod') {
        $post = json_decode(file_get_contents('php://input'),true);
        $data=[
            'idjadwal_audit' => $post['idjadwal_audit'],
            'method' => $post['method'],
        ];
        $respon = $client3->request('PUT', 'auditmed',[
            'form_params' => $data
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif ($_GET['audit']=='getcabang') {
        $respon = $client3->request('GET', 'cabang');
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif ($_GET['audit']=='getlokasi') {
        $get = json_decode(file_get_contents('php://input'),true);
        // $get =$_GET;
    
        $cabang = $get['cabang'];
        $respon = $client->request('GET', 'lokasicabang',[
            'query'=>[
                'id_cabang' => $cabang
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif ($_GET['audit']=='getverify') {
        $get = json_decode(file_get_contents('php://input'),true);
        // $get =$_GET;
    
        $id = $get['id'];
        $cabang= $get['cabang'];
        $respon = $client3->request('GET', 'list',[
            'query'=>[
                'id' => $id,
                'id_cabang'=> $cabang
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif ($_GET['audit']=='countid') {
        $respon = $client3->request('GET', 'jadwalauditcount');
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif ($_GET['audit']=='countaksesoris') {
        $get = json_decode(file_get_contents('php://input'),true);
        $lokasi= $get['id_lokasi'];
        $cabang= $get['id_cabang'];
        $respon = $client3->request('GET', 'countaksesoris',[
            'query' =>[
                'id_lokasi' => $lokasi,
                'id_cabang' => $cabang
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif ($_GET['audit']=='postaksesoris') {
        $get = json_decode(file_get_contents('php://input'),true);
        $data =[
            'id_cabang' => $get['id_cabang'],
            'id_lokasi' => $get['id_lokasi'],
            'aki' => $get['aki'],
            'spion' => $get['spion'],
            'tools' => $get['tools'],
            'buku_service' => $get['buku_service'],
            'helm' => $get['helm']
        ];
        $respon = $client3->request('POST', 'aksesoris',[
            'form_params' => $data
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif ($_GET['audit']=='downloadunit') {
        $get = json_decode(file_get_contents('php://input'),true);
        // $get = $_GET;
        $cabang = $get['cabang'];
        $respon = $client3->request('GET', 'dataunit',[
            'query' =>[
                'id_cabang' => $cabang
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
        
        
    }elseif ($_GET['audit']=='countunitstatus') {
        $get = json_decode(file_get_contents('php://input'),true);
        // $get = $_GET;
        $status = $get['status'];
        $cabang = $get['cabang'];
        $respon = $client3->request('GET', 'countdataunit',[
            'query' =>[
                'status' => $status,
                'id_cabang' => $cabang
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif ($_GET['audit']=='counttempunit') {
        $get = json_decode(file_get_contents('php://input'),true);
        $cabang = $get['cabang'];
        $respon = $client3->request('GET', 'counttempunit',[
            'query'=>[ 
                'id_cabang' => $cabang
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif ($_GET['audit']=='unitready') {
        $get = json_decode(file_get_contents('php://input'),true);
        // $get = $_GET;
        $cabang = $get['cabang'];
        $respon = $client3->request('GET', 'readyunit',[
            'query' =>[
                'id_cabang' => $cabang
            ]
        ]);
    
        $result = $respon->getBody()->getContents();
        echo $result;
    }elseif ($_GET['audit']=='uploadfoto') {
        $target = "uploads/";
        $baru="compress.jpg";
        $target_path = $target.basename( $_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
    
        $im_src = imagecreatefromjpeg($target_path);
        $src_width = imagesx($im_src);
        $src_width = imagesy($im_src);
    
        $dst_width = 200;
        $dst_height = ($dst_width/$src_width)*$src_height;
    
        $im = imagecreatetruecolor($dst_width,$dst_height);
        imagecopyresampled($im, $im_src,0,0,0,0,$dst_width,$dst_height,$src_width,$src_height);
        
        imagejpeg($im, $target.basename($baru),50);
        imagedestroy($im_src);
        imagedestroy($im);
    
    }
} catch ( RuntimeException $e) {
    $result =[
        'status' => false,
        'data' => 'Check Connection'
    ];
    echo json_encode($result,true);
}