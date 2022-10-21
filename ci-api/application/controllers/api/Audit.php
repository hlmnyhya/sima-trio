<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

    require(APPPATH . 'libraries/REST_Controller.php');
    use Restserver\Libraries\REST_Controller;
    class Audit extends REST_Controller {
private $_tgl;
public $ip_address;
public $username;
public $password;
public $database;
function __construct() {
    parent::__construct();
    ini_set('max_execution_time', 0);
    $this->load->model('audit/m_audit','maudit');
    $this->load->model('audit/m_aksesoris','maksesoris');
    $this->load->model('audit/m_part','mpart');
    $this->load->model('audit/m_unit','munit');
    $this->load->model('audit/m_tempunit','mtempunit');
    $this->load->model('audit/m_temppart','mtemppart');
    $this->load->model('master/m_cabang','mcabang');
    $this->load->model('master/m_jenis_audit','mjenisaudit');
    $this->load->model('master/m_count','mcount');
    $this->load->model('laporan/m_laporan_audit','mlapdat');
    
    $this->_tgl = date('Y-m-d');
    $this->load->model('config/m_config','mconfig');
        // $data = $this->mconfig->getUserConfig();
        // foreach ($data as $d ) {
        //     $ip = $d->ip;
        //     $ip2 = 'IPADDRESS';
        //     $iv_key = 'honda12345';
        //     $encrypt_method = "AES-256-CBC";
        //     $key = hash('sha256',$ip2);
        //     $iv = substr(hash('sha256', $iv_key), 0, 16);
        //     $ip = base64_decode($ip);
        //     $ip = openssl_decrypt($ip, $encrypt_method, $key, 0, $iv);

        //     $uname = $d->username;
        //     $uname2 = 'USERNAME';
        //     $iv_key = 'honda12345';
        //     $encrypt_method = "AES-256-CBC";
        //     $key = hash('sha256',$uname2);
        //     $iv = substr(hash('sha256', $iv_key), 0, 16);
        //     $uname = base64_decode($uname);
        //     $this->username = openssl_decrypt($uname, $encrypt_method, $key, 0, $iv);

        //     $pass = $d->password;
        //     $pass2 = 'PASSWORD';
        //     $iv_key = 'honda12345';
        //     $encrypt_method = "AES-256-CBC";
        //     $key = hash('sha256',$pass2);
        //     $iv = substr(hash('sha256', $iv_key), 0, 16);
        //     $pass = base64_decode($pass);
        //     $this->password = openssl_decrypt($pass, $encrypt_method, $key, 0, $iv);

        //     $db = $d->db;
        //     $db2 = 'DATABASE';
        //     $iv_key = 'honda12345';
        //     $encrypt_method = "AES-256-CBC";
        //     $key = hash('sha256',$db2);
        //     $iv = substr(hash('sha256', $iv_key), 0, 16);
        //     $db = base64_decode($db);
        //     $this->database = openssl_decrypt($db, $encrypt_method, $key, 0, $iv);
        // }
        // $config_app = db_master($ip,$this->username,$this->password, $this->database);
        $this->load->model('audit/m_tempunit','mtempunit');
        // $this->mtempunit->app_db = $this->load->database($config_app,TRUE);
    }

    public function Audit_get(){
        $id= $this->get('id');
        $offset = $this->get('offset');
        
        if ($id===null) {
            $audit= $this->maudit->GetAudit(null,$offset);
            
        }else{
            $audit= $this->maudit->GetAudit($id);

        }
        if ($audit) {
            $this->response([
                'status' => true,
                'data' => $audit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Audit_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => 'need id'
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->maudit->delAudit($id)) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'data'=> 'deleted.'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else{
                $this->response([
                    'status' => false,
                    'data' => 'ID not found.'
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function Audit_post()
    {
        $data=[
                'idjadwal_audit' => $this->post('idjadwal_audit',true),
                'auditor' => $this->post('auditor',true),
                'tanggal' => $this->post('tanggal'),
                'waktu' => $this->post('waktu'),
                'idjenis_audit' => $this->post('idjenis_audit'),
                'id_cabang' => $this->post('id_cabang'),
                'keterangan' => 'waiting',
                'input_by' => $this->post('user',true),
                'tanggal_input' => $this->_tgl
        ];

        if ($this->maudit->AddAudit($data)) {
            $this->response([
                'status' => true,
                'data' => "Data Audit has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_OK);
        }
    }
    public function Audit_put()
    {
        $id =$this->put('idjadwal_audit');

        $data=[
            'tanggal' => $this->put('tanggal'),
                'waktu' => $this->put('waktu'),
                'idjenis_audit' => $this->put('idjenis_audit'),
                'id_lokasi' => $this->put('id_lokasi'),
                'id_cabang' => $this->put('id_cabang'),
                'keterangan' => 'waiting',
                'tanggal_edit' => $this->_tgl
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else {
            if ($this->maudit->editAudit($data, $id)) {
                $this->response([
                    'status' => true,
                    'data' => "Data Audit has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
    }
    public function Auditket_put()
    {
        $id =$this->put('idjadwal_audit');

        $data=[
                'keterangan' => $this->put('keterangan',true),
                'tanggal_edit' => $this->_tgl
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else {
            if ($this->maudit->editAuditket($data, $id)) {
                $this->response([
                    'status' => true,
                    'data' => "Data Audit has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
    }
    public function Auditmed_put()
    {
        $id =$this->put('idjadwal_audit');

        $data=[
                'method' => $this->put('method',true)
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else {
            if ($this->maudit->editAuditket($data, $id)) {
                $this->response([
                    'status' => true,
                    'data' => "Data Audit has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function Part_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $part= $this->mpart->GetPart();
            
        }else{
            $part= $this->mpart->GetPart($id);

        }
        if ($part) {
            $this->response([
                'status' => true,
                'data' => $part
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK); 
        }
    }

    public function Unit_get()
    {
        $id= $this->get('id');
        $offset = $this->get('offset');
        
        if ($id===null) {
            $unit= $this->munit->GetUnit(null,$offset);
            
        }else{
            $unit= $this->munit->GetUnit($id);

        }
        if ($unit) {
            $this->response([
                'status' => true,
                'data' => $unit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    //====================AUDIT UNIT
    public function listaud_get()
    {
        $id = $this->get('id');
        $cabang = $this->get('id_cabang');
        if ($id===null) {
            $aud = $this->maudit->GetList();
        }else{
            $aud = $this->maudit->GetList($id,$cabang);
        }

        if ($aud) {
            $this->response([
                'status' => true,
                'data' => $aud
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function listaud_post()
    {
        $id = $this->post('no_mesin');
             
        $data =[
            'no_mesin' => $this->post('no_mesin'),
            'no_rangka' => $this->post('no_rangka'),
            'umur_unit' => $this->post('umur_unit'),
            'tahun' => $this->post('tahun'),
            'id_lokasi' => $this->post('id_lokasi'),
            'id_cabang' => $this->post('id_cabang'),
            'type' => $this->post('type'),
            'kode_item' => $this->post('kode_item'),
            'aki' => $this->post('aki'),
            'spion' => $this->post('spion'),
            'tools' => $this->post('tools'),
            'buku_service' => $this->post('buku_service'),
            'helm' => $this->post('helm'),
            'status_unit' => $this->post('status_unit'),
            'keterangan' => $this->post('keterangan'),
            'is_ready' => $this->post('is_ready'),
            'audit_by' => $this->post('user',true),
            'foto' => $this->post('foto'),
            'tanggal_audit' => $this->_tgl,
            'idjadwal_audit' => $this->post('idjadwal_audit'),
            // 'is_audit' => '0'
        ];
        if ($id===null) {
            $listaud = null;
        }else{
            $listaud = $this->maudit->AddList($data);
        }
        if ($listaud) {
            $this->response([
                'status' => true,
                'data' => "Data Audit has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_OK);
        }
        
    }
    public function listaud_put()
    {
        $id= $this->put('id_unit');
        $foto = $this->put('foto');
        if ($foto==null) {
            $data =[
                'no_mesin' => $this->put('no_mesin'),
                'no_rangka' => $this->put('no_rangka'),
                'umur_unit' => $this->put('umur_unit'),
                'tahun' => $this->put('tahun'),
                'type' => $this->put('type'),
                'kode_item' => $this->put('kode_item'),
                'id_lokasi' => $this->put('id_lokasi'),
                'id_cabang' => $this->put('id_cabang'),
                'aki' => $this->put('aki'),
                'spion' => $this->put('spion'),
                'tools' => $this->put('tools'),
                'buku_service' => $this->put('buku_service'),
                'helm' => $this->put('helm'),
                'is_ready' => $this->put('is_ready'),
                'status_unit' => $this->put('status'),
                'keterangan' => $this->put('keterangan'),
                'edit_by' => $this->put('user'),
                'tanggal_edit' => $this->_tgl
            ];
        }else{
            $data =[
                'no_mesin' => $this->put('no_mesin'),
                'no_rangka' => $this->put('no_rangka'),
                'umur_unit' => $this->put('umur_unit'),
                'tahun' => $this->put('tahun'),
                'type' => $this->put('type'),
                'kode_item' => $this->put('kode_item'),
                'id_lokasi' => $this->put('id_lokasi'),
                'id_cabang' => $this->put('id_cabang'),
                'aki' => $this->put('aki'),
                'spion' => $this->put('spion'),
                'tools' => $this->put('tools'),
                'buku_service' => $this->put('buku_service'),
                'helm' => $this->put('helm'),
                'status_unit' => $this->put('status'),
                'keterangan' => $this->put('keterangan'),
                'foto' => $this->put('foto'),
                'edit_by' => $this->put('user'),
                'tanggal_edit' => $this->_tgl
            ];
            
        }
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->maudit->EditList($id,$data)) {
                $this->response([
                    'status' => true,
                    'data' => "Data Audit has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
        
    }
    //========================AUDIT PART
    public function listaudPart_get()
    {
        $id = $this->get('id');
        $cabang = $this->get('id_cabang');
        $idjadwal_audit = $this->get('idjadwal_audit');
        if ($id===null) {
            $aud = $this->maudit->GetListPart();
        }else{
            $aud = $this->maudit->GetListPart($id,$cabang,$idjadwal_audit);
        }

        if ($aud) {
            $this->response([
                'status' => true,
                'data' => $aud
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function listaudPart_post()
    {
        $id = $this->post('part_number');
        $data =[
            'id_cabang' => $this->post('id_cabang'),
            'id_lokasi' => $this->post('id_lokasi'),
            'part_number' => $this->post('part_number'),
            'kd_lokasi_rak' => $this->post('kd_lokasi_rak'),
            'deskripsi' => $this->post('deskripsi'),
            'status' => $this->post('status'),
            'qty' => $this->post('qty'),
            'audit_by' => $this->post('user'),
            'tanggal_audit' => $this->_tgl,
            'idjadwal_audit' => $this->post('idjadwal_audit')
        ];
        // var_dump($data);die;
        if ($id===null) {
            $listaud = null;
        }else{
            $listaud = $this->maudit->AddListPart($data);
        }
        if ($listaud) {
            $this->response([
                'status' => true,
                'data' => "Data Audit has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_OK);
        }
        
    }
    public function listaudpart_put()
    {
        $id= $this->put('id');
            $data =[
                'qty' =>$this->put('qty'),
                'edit_by' => $this->put('user'),
                'tanggal_edit' => $this->_tgl
            ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->maudit->EditListPart($id,$data)) {
                $this->response([
                    'status' => true,
                    'data' => "Data Audit has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
        
    }
    //======================LIST AUDIT UNIT
    public function List_get()
    {
        $id = $this->get('id');
        $cabang = $this->get('id_cabang');
        $idjadwal_audit = $this->get('idjadwal_audit');
        if ($id=== null) {
            $list= $this->maudit->GetAuList(null,$cabang,$idjadwal_audit);
            
        }else{
            $list= $this->maudit->GetAuList($id,$cabang,$idjadwal_audit);
        }
        
        if ($list) {
            $this->response([
                'status' => true,
                'data' => $list
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    //======================LIST AUDIT PART
    public function ListPart_get()
    {
        $id = $this->get('id');
        $cabang = $this->get('id_cabang');
        $lokasi = $this->get('id_lokasi');
        $rakbin = $this->get('kd_lokasi_rak');
        $kondisi = $this->get('kondisi');
        $idjadwal_audit = $this->get('idjadwal_audit');
        if ($id=== null) {
            $list= $this->maudit->GetAuListPart(null,$cabang,$idjadwal_audit);
            
        }else{
            $list= $this->maudit->GetAuListPart($id,$cabang,$lokasi,$rakbin, $kondisi,$idjadwal_audit);
        }
        
        if ($list) {
            $this->response([
                'status' => true,
                'data' => $list
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function ListStatus_get()
    {
        $status = $this->get('status_unit');
        $cabang = $this->get('id_cabang');
        $list= $this->maudit->GetListStatus($status,$cabang);
        
        if ($list) {
            $this->response([
                'status' => true,
                'data' => $list
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function SearchStatus_get()
    {
        $id = $this->get('id');
        $status = $this->get('status_unit');
        $cabang = $this->get('id_cabang');
        $list= $this->maudit->GetSearchStatus($id,$status,$cabang);
        
        if ($list) {
            $this->response([
                'status' => true,
                'data' => $list
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }


    public function TempUnit_get()
    {
        $id= $this->get('id');
        $offset = $this->get('offset');
        
        if ($id===null) {
            $tempunit= $this->mtempunit->GetTempUnit(null,null,$offset);
            
        }else{
            $tempunit= $this->mtempunit->GetTempUnit($id);
        }
        if ($tempunit) {
            $this->response([
                'status' => true,
                'data' => $tempunit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function ToUnit_get()
    {
        $cabang= $this->get('id_cabang');
        $offset= $this->get('offset');
        if ($cabang===null) {
            $tempunit= null;
            
        }else{
            $tempunit= $this->mtempunit->GetToUnit($cabang,$offset);
        }
        if ($tempunit!=null) {
            $this->response([
                'status' => true,
                'data' => $tempunit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function ToPart_get()
    {
        $cabang= $this->get('id_cabang');
        $offset= $this->get('offset');
        if ($cabang===null) {
            $temppart= null;
            
        }else{
            $temppart= $this->mtemppart->GetToPart($cabang,$offset);
        }
        if ($temppart!=null) {
            $this->response([
                'status' => true,
                'data' => $temppart
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function UnitValid_get()
    {
        $cabang= $this->get('id_cabang');
        $idjadwal_audit = $this->get('idjadwal_audit');
        $tgl_awal= $this->get('tgl_awal');
        $tgl_akhir= $this->get('tgl_akhir');
        $offset= $this->get('offset');
        if ($cabang===null) {
            $unit= null;
        }else{
            $unit= $this->munit->GetUnitValid($cabang,$offset,$tgl_awal,$tgl_akhir,$idjadwal_audit);
        }
        // }elseif($cabang!=null && $tgl_awal==null){
        //     $unit= $this->munit->GetUnitValid($cabang,$offset,null,null);
        // }elseif($cabang!=null && $tgl_awal!=null&&$offset==null){
        //     $unit= $this->munit->GetUnitValid($cabang,null,$tgl_awal,$tgl_akhir);
        // }elseif($cabang!=null && $tgl_awal!=null &&$offset!=null){
        //     $unit= $this->munit->GetUnitValid($cabang,$offset,$tgl_awal,$tgl_akhir);
        // }
        if ($unit!=null) {
            $this->response([
                'status' => true,
                'data' => $unit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function partValid_get()
    {
        $cabang= $this->get('id_cabang');
        $offset= (($this->get('offset')) ? $this->get('offset') : null );
        $idjadwal_audit = (($this->get('idjadwal_audit')) ? $this->get('idjadwal_audit') : null );
        if ($cabang===null) {
            $part= null;
        }else{
            $part= $this->mpart->GetPartValid($cabang,$offset,$idjadwal_audit);
        }
        if ($part!=null) {
            $this->response([
                'status' => true,
                'data' => $part
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function CariUnit_get()
    {
        $id= $this->get('id');
        $cabang= $this->get('id_cabang');
        if ($id===null) {
            $tempunit= null;
            
        }else{
            $tempunit= $this->mtempunit->GetCariUnit($id,$cabang);
        }
        if ($tempunit!=null) {
            $this->response([
                'status' => true,
                'data' => $tempunit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function CariUnitNrfs_get()
    {
        $id= $this->get('id');
        $cabang= $this->get('id_cabang');
        if ($id===null) {
            $unit= null;
            
        }else{
            $unit= $this->munit->GetCariUnitNrfs($id,$cabang);
        }
        if ($unit!=null) {
            $this->response([
                'status' => true,
                'data' => $unit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function TempPart_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $temppart= $this->mtemppart->GetTempPart();
            
        }else{
            $temppart= $this->mtemppart->GetTempPart($id);
        }
        if ($temppart) {
            $this->response([
                'status' => true,
                'data' => $temppart
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function auditbefore_get()
    {
        $id = $this->get('id');
        $cabang = $this->get('id_cabang');
        if ($id=== null) {
            $list= $this->maudit->GetauditBefore($id,$cabang);
            
        }else{
            $list= $this->maudit->GetauditBefore($id,$cabang);

        }
        
        if ($list) {
            $this->response([
                'status' => true,
                'data' => $list
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function auditend_get()
    {
        $cabang = $this->get('id_cabang');
        $idjadwal_audit = $this->get('idjadwal_audit');
        if ($cabang == null) {
            $list= null;
        }else{
            $list= $this->maudit->AuditEnd($cabang, $idjadwal_audit);
        }
        
        if ($list) {
            $this->response([
                'status' => true,
                'data' => $list
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }


    //---------//
    public function cabang_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $cabang= $this->mcabang->GetCabang();
            
        }else{
            $cabang= $this->mcabang->GetCabang($id);

        }
        if ($cabang) {
            $this->response([
                'status' => true,
                'data' => $cabang
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function jadwalaudit_get()
    {
        $id= $this->get('id');
        $jenis = $this->get('jenis');      
        if ($id===null) {
            $cabang= $this->mcabang->GetJadwalAudit();
            
        }else{
            $cabang= $this->mcabang->GetJadwalAudit($id, null,$jenis);

        }
        if ($cabang) {
            $this->response([
                'status' => true,
                'data' => $cabang
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function lokasi_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $lokasi= $this->mlokasi->GetLokasi();
            
        }else{
            $lokasi= $this->mlokasi->GetLokasi($id);

        }
        if ($lokasi) {
            $this->response([
                'status' => true,
                'data' => $lokasi
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Jenisaudit_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $jenisaudit= $this->mjenisaudit->GetJenisaudit();
            
        }else{
            $jenisaudit= $this->mjenisaudit->GetJenisaudit($id);

        }
        if ($jenisaudit) {
            $this->response([
                'status' => true,
                'data' => $jenisaudit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
	
	public function Listauditor_get()
    {
        $listauditor = $this->maudit->Listauditor();
        if ($listauditor) {
            $this->response([
                'status' => true,
                'data' => $listauditor
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    //-----CARI-----///
    // public function cariJadwalAudit_get(){
    //     $auditor= $this->get('auditor');
    //     $tanggal_audit= $this->get('tanggal_audit');
    //     $jenis_audit= $this->get('jenis_audit');
    //     if ($auditor!= null && $tanggal_audit!=null && $jenis_audit!=null) {
    //         $jadwal_audit = $this->maudit->carijadwalaudit($auditor,$tanggal_audit,$jenis_audit);
    //     }elseif($auditor!=null&& $tanggal_audit==null&& $jenis_audit==null){
    //         $jadwal_audit = $this->maudit->cariauditor($auditor);
    //     }elseif ($auditor==null && $tanggal_audit!=null && $jenis_audit==null) {
    //         $jadwal_audit = $this->maudit->caritanggalaudit($tanggal_audit);
    //     }elseif ($auditor==null && $tanggal_audit==null && $jenis_audit!=null) {
    //         $jadwal_audit = $this->maudit->carijenisaudit($jenis_audit);
    //     }
    //     if ($jadwal_audit) {
    //         $this->response([
    //             'status' => true,
    //             'data' => $jadwal_audit
    //         ], REST_Controller::HTTP_OK);
    //     }else{
    //         $this->response([
    //             'status' => false,
    //             'data' => 'Data not found.'
    //         ], REST_Controller::HTTP_OK);
            
    //     }
    // }
    // cari MOBILE
    public function cariaudit_get()
    {
        $id= $this->get('id');
        if ($id === null) {
            $cari = $this->maudit->cariaudit();
        }else{
            $cari = $this->maudit->cariaudit($id);

        }
        if ($cari) {
            $this->response([
                'status' => true,
                'data' => $cari
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Jadwalauditcount_get()
    {
        $jadwalaudit= $this->mcount->Countjadwalaudit();

        if ($jadwalaudit) {
            $this->response([
                'status' => true,
                'data' => (int)$jadwalaudit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function unitready_post()
    {
        $id = $this->post('part_number');
        $data=[
            'part_number' => $this->post('part_number'),
            'no_mesin' => $this->post('no_mesin'),
            'no_rangka' => $this->post('no_rangka'),
            'id_cabang' => $this->post('id_cabang'),
            'id_lokasi' => $this->post('id_lokasi'),
            'keterangan' => $this->post('keterangan'),
            'kondisi' => $this->post('kondisi'),
            'penanggung_jawab' => $this->post('penanggung_jawab'),
        ];
        if ($id===null) {
            $postunit = null;
        }else{
            $postunit = $this->munit->addUnitReady($data);
        }

        if ($postunit) {
            $this->response([
                'status' => true,
                'data' => $postunit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "Failed to post"
            ], REST_Controller::HTTP_OK);
        }
    }
    //=====================DATABASE KE 2 CONFIG==========================//
    private function _getconfig()
    {
        $data = $this->mconfig->getUserConfig();
        foreach ($data as $d ) {
            $ip = $d->ip;
            $ip2 = 'IPADDRESS';
            $iv_key = 'honda12345';
            $encrypt_method = "AES-256-CBC";
            $key = hash('sha256',$ip2);
            $iv = substr(hash('sha256', $iv_key), 0, 16);
            $ip = base64_decode($ip);
            $ip = openssl_decrypt($ip, $encrypt_method, $key, 0, $iv);

            $uname = $d->username;
            $uname2 = 'USERNAME';
            $iv_key = 'honda12345';
            $encrypt_method = "AES-256-CBC";
            $key = hash('sha256',$uname2);
            $iv = substr(hash('sha256', $iv_key), 0, 16);
            $uname = base64_decode($uname);
            $this->username = openssl_decrypt($uname, $encrypt_method, $key, 0, $iv);

            $pass = $d->password;
            $pass2 = 'PASSWORD';
            $iv_key = 'honda12345';
            $encrypt_method = "AES-256-CBC";
            $key = hash('sha256',$pass2);
            $iv = substr(hash('sha256', $iv_key), 0, 16);
            $pass = base64_decode($pass);
            $this->password = openssl_decrypt($pass, $encrypt_method, $key, 0, $iv);

            $db = $d->db;
            $db2 = 'DATABASE';
            $iv_key = 'honda12345';
            $encrypt_method = "AES-256-CBC";
            $key = hash('sha256',$db2);
            $iv = substr(hash('sha256', $iv_key), 0, 16);
            $db = base64_decode($db);
            $this->database = openssl_decrypt($db, $encrypt_method, $key, 0, $iv);
        }
        $config_app = db_master($ip,$this->username,$this->password, $this->database);
        return $config_app;
    }
    public function datapart_get()
    {
        $this->mtemppart->app_db = $this->load->database($this->_getconfig(),TRUE);
        $cekConfig = $this->mtemppart->app_db->initialize();
        if (!$cekConfig) {
            $this->response([
                'status' => false,
                'data' => "Database not connected!"
            ], REST_Controller::HTTP_OK);
        }else{
            $cabang = $this->get('id_cabang');
            $idjadwal_audit = $this->get('idjadwal_audit');
            // $cabang='T13';
            $list =$this->mtemppart->getTempPart(null,$cabang, $idjadwal_audit);
           if ($list!=false) {
            $this->response([
                'status' => false,
                'data' => "Already Downloaded"
            ], REST_Controller::HTTP_OK);
           }else{
			   $this->mtemppart->syncRakBin($cabang);
               $postunit = $this->mtemppart->getDatapart($cabang);
               foreach ($postunit as $res) {
                   $data =[
                       'id_cabang' => $res['KD_DEALER'],
                       'id_lokasi' => $res['KD_DEALER'].'-'.$res['KD_GUDANG'],
                       'kd_lokasi_rak' => $res['KD_RAKBIN'],
                       'part_number' => $res['PART_NUMBER'],
                       'deskripsi' => $res['PART_DESKRIPSI'],
                       'qty' => $res['STOCK_OH'],
                       'idjadwal_audit'=> $idjadwal_audit
                   ];
                   $download = $this->mtemppart->addTemppart($data);
               }
               if ($download) {
                   $this->response([
                       'status' => true,
                       'data' => "Data Downloaded"
                   ], REST_Controller::HTTP_OK);
               }else{
                   $this->response([
                       'status' => false,
                       'data' => "Failed to post"
                   ], REST_Controller::HTTP_OK);
               }
           }
        }
    }
    public function dataunit_get()
    {
        $this->mtempunit->app_db = $this->load->database($this->_getconfig(),TRUE);
        $cekConfig = $this->mtempunit->app_db->initialize();
        if (!$cekConfig) {
            $this->response([
                'status' => false,
                'data' => "Database not connected!"
            ], REST_Controller::HTTP_OK);
        }else{
            $cabang = $this->get('id_cabang');
            $idaudit = $this->get('id_audit');
            // $cabang='T13';
            $list =$this->mtempunit->getTempUnit(null,$cabang);
           if ($list!=false) {
            $this->response([
                'status' => false,
                'data' => "Already Downloaded"
            ], REST_Controller::HTTP_OK);
           }else{
               $postunit = $this->mtempunit->getDataUnit($cabang);
               $i=$this->mcount->CountTempUnit();
                $this->mtempunit->SyncGudang1($cabang);
                $this->mtempunit->SyncGudang2($cabang);
                foreach ($postunit as $res) {
                    //    var_dump($post['no_rangka']);
                   $i++;
                   $data =[
                       'no_mesin' => $res['no_mesin'],
                       'no_rangka' => $res['no_rangka'],
                       'id_cabang' => $res['kd_dealer'],
                       'id_lokasi' => $res['kd_gudang'],
                       'kode_item' => $res['kd_item'],
                       'umur' => (($res['THN_PERAKITAN']=="") ?  0 : ((int)date("Y") - $res['THN_PERAKITAN'])),
                       'type' => $res['sub_kategori'],
                       'tahun' => $res['THN_PERAKITAN'],
                       'idjadwal_audit' => $idaudit
                   ];
                   $download = $this->mtempunit->addTempUnit($data);
               }
               if ($download) {
                   $this->response([
                       'status' => true,
                       'data' => "Data Downloaded"
                   ], REST_Controller::HTTP_OK);
               }else{
                   $this->response([
                       'status' => false,
                       'data' => "Failed to post"
                   ], REST_Controller::HTTP_OK);
               }
           }
        }

    }

    public function datapart2_get()
    {
        $this->mtemppart->app_db = $this->load->database($this->_getconfig(),TRUE);
        $cekConfig = $this->mtemppart->app_db->initialize();
        if (!$cekConfig) {
            $this->response([
                'status' => false,
                'data' => "Database not connected!"
            ], REST_Controller::HTTP_OK);
        }else{
                $cabang = $this->get('id_cabang');
                $postunit = $this->mtemppart->getDatapart($cabang);
                if ($postunit) {
                    $this->response([
                        'status' => true,
                        'data' => $postunit
                    ], REST_Controller::HTTP_OK);
                }else{
                    $this->response([
                        'status' => false,
                        'data' => "Failed to post"
                    ], REST_Controller::HTTP_OK);
                }
        }
    }

    public function dataunit2_get()
    {
        $this->mtempunit->app_db = $this->load->database($this->_getconfig(),TRUE);
        $cekConfig = $this->mtempunit->app_db->initialize();
        if (!$cekConfig) {
            $this->response([
                'status' => false,
                'data' => "Database not connected!"
            ], REST_Controller::HTTP_OK);
        }else{
            $cabang = $this->get('id_cabang');
               $postunit = $this->mtempunit->getDataUnit($cabang);
               
               if ($postunit) {
                   $this->response([
                       'status' => true,
                       'data' => $postunit
                   ], REST_Controller::HTTP_OK);
               }else{
                   $this->response([
                       'status' => false,
                       'data' => "Failed to post"
                   ], REST_Controller::HTTP_OK);
               }
           
        }

    }

    public function dataunit2_post(){
        $data = json_decode(file_get_contents('php://input'), true);
        $post = array();
        $i = 0;
        foreach($data as $key => $val){
            $post[$i]= $val;
            $i++;
        }
        $data=[
            'no_mesin' => $post[0],
            'no_rangka' => $post[1],
            'umur_unit' => '-',
            'tahun' => $post[6],
            'id_lokasi' => $post[3],
            'id_cabang' => $post[2],
            'type' => $post[5],
            'kode_item' => $post[4],
            'aki' => '-',
            'spion' => '-',
            'tools' => '-',
            'buku_service' => '-',
            'helm' => '-',
            'status_unit' => $post[7],
            'keterangan' => $post[8],
            'is_ready' => $post[9],
            'audit_by' => $post[10],
            'foto' => '-',
            'tanggal_audit' => $this->_tgl,
        ];
        $listaud = $this->maudit->AddList($data);
        if ($listaud) {
            $this->response([
                'status' => true,
                'data' => "created success"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "Failed to post"
            ], REST_Controller::HTTP_OK);
        }
    }

    public function CountDataUnit_get()
    {
        $status = $this->get('status');
        $cabang = $this->get('id_cabang');
        if ($status===null) {
            $statusUnit = $this->mcount->countDataUnit(null, $cabang);
        }else{
            $statusUnit = $this->mcount->countDataUnit($status,$cabang);
        }

        if ($statusUnit) {
            $this->response([
                'status' => true,
                'data' => $statusUnit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "Failed to post"
            ], REST_Controller::HTTP_OK);
        }
    }
    public function CountAksesoris_get()
    {
        $lokasi = $this->get('id_lokasi');
        $cabang = $this->get('id_cabang');
        $statusUnit = $this->mcount->countAksesoris($cabang,$lokasi);

        if ($statusUnit) {
            $this->response([
                'status' => true,
                'data' => $statusUnit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "data not found"
            ], REST_Controller::HTTP_OK);
        }
    }
    public function readyUnit_get()
    {
        $id = $this->get('id');
        $cabang = $this->get('id_cabang');
        if ($id===null) {
            $readyUnit = $this->munit->getUnitReady(null,$cabang);
        }else{
            $readyUnit = $this->munit->getUnitReady($id, $cabang);
        }

        if ($readyUnit) {
            $this->response([
                'status' => true,
                'data' => $readyUnit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "data not found"
            ], REST_Controller::HTTP_OK);
        }
    }
    public function countTempUnit_get()
    {
        $cabang = $this->get('id_cabang');
        if ($cabang ===null) {
            $count = $this->mcount->countTempUnit();
        }else{
            $count = $this->mcount->countTempUnit($cabang);
        }

        if ($count) {
            $this->response([
                'status' => true,
                'data' => $count
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "data not found"
            ], REST_Controller::HTTP_OK);
        }
    }
    public function countTempPart_get()
    {
        $cabang = $this->get('id_cabang');
        if ($cabang ===null) {
            $count = $this->mcount->countTempPart();
        }else{
            $count = $this->mcount->countTempPart($cabang);
        }

        if ($count) {
            $this->response([
                'status' => true,
                'data' => $count
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "data not found"
            ], REST_Controller::HTTP_OK);
        }
    }

    public function countjadwalaudit_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $user= $this->mcount->countjadwalaudit();
        }
        if ($user) {
            $this->response([
                'status' => true,
                'data' => $user
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function cetakUnit_get()
    {
        $cabang= $this->get('id_cabang');
        $idjadwal_audit= $this->get('idjadwal_audit');
        $status = $this->get('status');
        
            $cetak= $this->mlapdat->cetakUnit($cabang, $idjadwal_audit,$status);
        if ($cetak) {
            $this->response([
                'status' => true,
                'data' => $cetak
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function cetakUnitNotready_get()
    {
        $cabang= $this->get('id_cabang');
        $idjadwal_audit= $this->get('idjadwal_audit');
        $ready = $this->get('is_ready');
        
            $cetak= $this->mlapdat->cetakUnitNotReady($cabang, $idjadwal_audit,$ready);
        if ($cetak) {
            $this->response([
                'status' => true,
                'data' => $cetak
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function LapUnit_get()
    {
        $cabang= $this->get('id_cabang');
        $tanggal_akhir= $this->get('tanggal_akhir');
        $tanggal_awal= $this->get('tanggal_awal');
        $status= $this->get('status');
            $cetak= $this->mlapdat->cetakLapUnit($cabang, $tanggal_awal, $tanggal_akhir,$status);
        if ($cetak) {
            $this->response([
                'status' => true,
                'data' => $cetak
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }


    public function countunit_get()
    {
        $a= $this->get('id_cabang');
        $b= $this->get('idjadwal_audit');
        $c= $this->get('status');
            $count= $this->mcount->countunit($a,$b,$c);
        if ($count) {
            $this->response([
                'status' => true,
                'data' => $count
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function countunitnotready_get()
    {
        $a= $this->get('id_cabang');
        $b= $this->get('idjadwal_audit');
        $d= $this->get('is_ready');
            $count= $this->mcount->countunitnotready($a,$b,$d);
        if ($count) {
            $this->response([
                'status' => true,
                'data' => $count
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function countunit1_get()
    {
        $a= $this->get('id_cabang');
        $b= $this->get('idjadwal_audit');
            $count= $this->mcount->countunit1($a, $b);
        if ($count) {
            $this->response([
                'status' => true,
                'data' => $count
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function countpart1_get()
    {
        $a= $this->get('id_cabang');
        $b= $this->get('idjadwal_audit');
            $count= $this->mcount->countpart1($a,$b);
        if ($count) {
            $this->response([
                'status' => true,
                'data' => $count
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function countpartvalid_get()
    {
        $a= $this->get('id_cabang');
        $b= $this->get('idjadwal_audit');
            $count= $this->mcount->countpartvalid($a,$b);
        if ($count) {
            $this->response([
                'status' => true,
                'data' => $count
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function countunitvalid_get()
    {
        $a= $this->get('id_cabang');
        $b= $this->get('idjadwal_audit');
            $count= $this->mcount->countunitvalid($a,$b);
        if ($count) {
            $this->response([
                'status' => true,
                'data' => $count
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function previewUnit_get()
    {
        $cabang= $this->get('id_cabang');
        $idjadwal_audit= $this->get('idjadwal_audit');
        $status = $this->get('status');
        $offset = $this->get('offset');
        $tampil= $this->munit->previewUnit($cabang, $idjadwal_audit,$status,$offset);
        if ($tampil) {
            $this->response([
                'status' => true,
                'data' => $tampil
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function previewUnitNotReady_get()
    {
        $cabang= $this->get('id_cabang');
        $idjadwal_audit= $this->get('idjadwal_audit');
        $ready = $this->get('is_ready');
        $offset = $this->get('offset');
        $tampil= $this->munit->previewUnitNotReady($cabang, $idjadwal_audit,$ready,$offset);
        if ($tampil) {
            $this->response([
                'status' => true,
                'data' => $tampil
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function NotReady_get()
    {
        $no_mesin= $this->get('no_mesin');
        $tampil= $this->munit->NotReady($no_mesin);
        if ($tampil) {
            $this->response([
                'status' => true,
                'data' => $tampil
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    //=============================AKSESORIS==============================//
    public function Aksesoris_get()
    {
        $id = $this->get('id_cabang');
        $idjadwal_audit = $this->get('idjadwal_audit');
        $offset= $this->get('offset');

        if ($offset===null) {
            $aksesoris = $this->maksesoris->GetAksesoris($id,$idjadwal_audit);
        }else{
            $aksesoris = $this->maksesoris->GetAksesoris($id,$idjadwal_audit,$offset);
        }

        if ($aksesoris) {
            $this->response([
                'status' => true,
                'data' => $aksesoris
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Aksesoris_post()
    {
        $id=$this->post('id_cabang');
        $data=[
            'id_cabang'     => $this->post('id_cabang'),
            'id_lokasi'     => $this->post('id_lokasi'),
            'aki'           => $this->post('aki'),
            'spion'         => $this->post('spion'),
            'helm'          => $this->post('helm'),
            'tools'         => $this->post('tools'),
            'buku_service'  => $this->post('buku_service'),
            'input_by'      => $this->post('user'),
            'tanggal_input' => $this->_tgl
        ];
        if ($id===null) {
            $postAksesoris = null;
        }else{
            $postAksesoris = $this->maksesoris->AddAksesoris($data);
        }

        if ($postAksesoris ) {
            $this->response([
                'status' => true,
                'data' => "Aksesoris has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_OK);
        }
    }

    public function Aksesoris_put()
    {
        $id =$this->put('id');       
        $data=[
                'id_cabang'     => $this->put('id_cabang'),
                'id_lokasi'     => $this->put('id_lokasi'),
                'aki'           => $this->put('aki'),
                'spion'         => $this->put('spion'),
                'helm'          => $this->put('helm'),
                'tools'         => $this->put('tools'),
                'buku_service'  => $this->put('buku_service'),
                'edit_by'       => $this->post('user'),
                'tanggal_edit'  => $this->_tgl
        ];  
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else {
            if ($this->maksesoris->editAksesoris($data,$id)) {
                $this->response([
                    'status' => true,
                    'data' => "Aksesoris has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function Aksesoris_delete()
    {
        $id= $this->delete('id');
        
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->maksesoris->delAksesoris($id)) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message'=> 'deleted.'
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'ID not found.'
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function cariAksesoris_get()
    {
        $id= $this->get('aksesoris');
        
        if ($id===null) {
            $aksesoris= $this->maksesoris->cariAksesoris();
            
        }else{
            $aksesoris= $this->maksesoris->cariAksesoris($id);
        }
        if ($aksesoris) {
            $this->response([
                'status' => true,
                'data' => $aksesoris
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Aksesoriscount_get()
    {
        $id = $this->get('id_cabang');
        $idjadwal_audit = $this->get('idjadwal_audit');
            $aksesoris= $this->mcount->aksesorisCount($id, $idjadwal_audit);
        if ($aksesoris) {
            $this->response([
                'status' => true,
                'data' => $aksesoris
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    //===================================================================//

    public function cariscanunit_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $scanunit= $this->maudit->cariscanunit();
            
        }else{
            $scanunit= $this->maudit->cariscanunit($id);
        }
        if ($scanunit) {
            $this->response([
                'status' => true,
                'data' => $scanunit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function QtyUnit_get()
    {
        $id= $this->get('id_cabang');
        $sum = $this->maksesoris->sumUnit($id);
        if ($sum) {
            $this->response([
                'status' => true,
                'data' => $sum
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
        
    }

}
/** End of file Audit.php **/
