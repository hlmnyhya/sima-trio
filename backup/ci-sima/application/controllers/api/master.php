<?php

defined('BASEPATH') OR exit('No direct script access allowed');

    require(APPPATH . 'libraries/REST_Controller.php');
    use Restserver\Libraries\REST_Controller;
    class Master extends REST_Controller {

function __construct() {
    parent::__construct();
    $this->load->model('master/m_user','muser');
    $this->load->model('master/m_usergroup','musergroup');
    $this->load->model('master/m_divisi','mdivisi');
    $this->load->model('master/m_jenis_inventory','mjenisinv');
    $this->load->model('master/m_jenis_audit','mjenisaudit');
    $this->load->model('master/m_vendor','mvendor');
    $this->load->model('master/m_lokasi_inventory','mlokasiinv');
    $this->load->model('master/m_type_inventory','mtypeinv');
    }

    public function User_get(){
        $id= $this->get('id');
        
        if ($id===null) {
            $user= $this->muser->GetUser();
            
        }else{
            $user= $this->muser->GetUser($id);

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
            ], REST_Controller::HTTP_NOT_FOUND);
            
        }
    }

    public function User_delete()
    {
        $id= $this->delete('id');

        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if ($this->muser->delUser($id)) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message'=> 'deleted.'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'ID not found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function User_post()
    {   
        $data=[
            'nik' => $this->post('nik',true),
                'username' => $this->post('username'),
                'nama' => $this->post('nama'),
                'password' => password_hash($this->post('password'),PASSWORD_DEFAULT),
                'id_usergroup' => $this->post('usergroup'),
                'id_divisi' => $this->post('divisi'),
                'status' => 'Aktif',
        ];
    
            if ($this->muser->AddUser($data)>0) {
                $this->response([
                    'status' => true,
                    'data' => "User has been created"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        
    }

    public function User_put()
    {
        $id= $this->put('id');
        $data=[
                'username' => $this->put('username'),
                'nama' => $this->put('nama'),
                'password' => password_hash($this->put('password'),PASSWORD_DEFAULT),
                'id_usergroup' => $this->put('usergroup'),
                'id_divisi' => $this->put('divisi'),
                'status' => $this->put('status')
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else {
            if ($this->muser->editUser($data,$id)) {
                $this->response([
                    'status' => true,
                    'data' => "User has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function Usergroup_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $usergroup= $this->musergroup->GetUsergroup();
            
        }else{
            $usergroup= $this->musergroup->GetUsergroup($id);
        }
        if ($usergroup) {
            $this->response([
                'status' => true,
                'data' => $usergroup
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_NOT_FOUND);
            
        }
    }

    public function Usergroup_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if ($this->musergroup->delUsergroup($id)>0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message'=> 'deleted.'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'ID not found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function Usergroup_post()
    {
        $data=[
            'id_usergroup' => $this->post('id_usergroup',true),
                'usergroup' => $this->post('usergroup', true),
        ];

        if ($this->musergroup->AddUsergroup($data)>0) {
            $this->response([
                'status' => true,
                'data' => "Usergroup has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function Usergroup_put()
    {
        $id =$this->put('id');

        $data=[
                'usergroup' => $this->put('usergroup', true),
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else {
            if ($this->musergroup->editUsergroup($data, $id)>0) {
                $this->response([
                    'status' => true,
                    'data' => "Usergroup has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function Divisi_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $divisi= $this->mdivisi->GetDivisi();
            
        }else{
            $divisi= $this->mdivisi->GetDivisi($id);

        }
        if ($divisi) {
            $this->response([
                'status' => true,
                'data' => $divisi
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_NOT_FOUND);
            
        }
    }

    public function Divisi_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if ($this->mdivisi->delDivisi($id)>0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message'=> 'deleted.'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'ID not found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
    public function Divisi_post()
    {
        $data=[
            'id_divisi' => $this->post('id_divisi',true),
                'divisi' => $this->post('divisi', true),
        ];

        if ($this->mdivisi->AddDivisi($data)>0) {
            $this->response([
                'status' => true,
                'data' => "Divisi has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function Divisi_put()
    {
        $id =$this->put('id');

        $data=[
                'divisi' => $this->put('divisi', true),
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else {
            if ($this->mdivisi->editDivisi($data, $id)>0) {
                $this->response([
                    'status' => true,
                    'data' => "Divisi has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
    public function Jenisinv_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $jenisinv= $this->mjenisinv->GetJenisinv();
            
        }else{
            $jenisinv= $this->mjenisinv->GetJenisinv($id);

        }
        if ($jenisinv) {
            $this->response([
                'status' => true,
                'data' => $jenisinv
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_NOT_FOUND);
            
        }
    }
    public function Jenisinv_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if ($this->mjenisinv->delJenisinv($id)>0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message'=> 'deleted.'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'ID not found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
    public function Jenisinv_post()
    {
        $data=[
            'idjenis_inv' => $this->post('idjenis_inv',true),
                'jenis_inv' => $this->post('jenis_inv', true),
        ];

        if ($this->mjenisinv->AddJenisinv($data)>0) {
            $this->response([
                'status' => true,
                'data' => "Jenis Inventory has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function Jenisinv_put()
    {
        $id =$this->put('id');

        $data=[
                'jenis_inv' => $this->put('jenis_inv', true),
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else {
            if ($this->mjenisinv->editJenisinv($data, $id)>0) {
                $this->response([
                    'status' => true,
                    'data' => "Jenis Inventory has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
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
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_NOT_FOUND);
            
        }
    }
    public function Jenisaudit_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if ($this->mjenisaudit->delJenisaudit($id)>0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message'=> 'deleted.'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'ID not found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
    public function Jenisaudit_post()
    {
        $data=[
            'idjenis_audit' => $this->post('idjenis_audit',true),
                'jenis_audit' => $this->post('jenis_audit', true),
        ];

        if ($this->mjenisaudit->AddJenisaudit($data)>0) {
            $this->response([
                'status' => true,
                'data' => "Jenis Audit has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function Jenisaudit_put()
    {
        $id =$this->put('id');

        $data=[
                'jenis_audit' => $this->put('jenis_audit', true),
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else {
            if ($this->mjenisaudit->editJenisaudit($data, $id)>0) {
                $this->response([
                    'status' => true,
                    'data' => "Jenis Audit has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function Vendor_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $vendor= $this->mvendor->GetVendor();
            
        }else{
            $vendor= $this->mvendor->GetVendor($id);

        }
        if ($vendor) {
            $this->response([
                'status' => true,
                'data' => $vendor
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_NOT_FOUND);
            
        }
    }
    public function Vendor_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if ($this->mvendor->delVendor($id)) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message'=> 'deleted.'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'ID not found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
    public function Vendor_post()
    {
        $data=[
            'idvendor' => $this->post('idvendor',true),
                'vendor' => $this->post('vendor', true),
        ];

        if ($this->mvendor->Addvendor($data)>0) {
            $this->response([
                'status' => true,
                'data' => "Vendor has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function Vendor_put()
    {
        $id =$this->put('id');

        $data=[
                'vendor' => $this->put('vendor'),
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else {
            if ($this->mvendor->editVendor($data, $id)>0) {
                $this->response([
                    'status' => true,
                    'data' => "Vendor has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function Lokasiinv_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $lokasiinv= $this->mlokasiinv->GetLokasiinv();
            
        }else{
            $lokasiinv= $this->mlokasiinv->GetLokasiinv($id);

        }
        if ($lokasiinv) {
            $this->response([
                'status' => true,
                'data' => $lokasiinv
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_NOT_FOUND);
            
        }
    }

    public function Lokasiinv_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if ($this->mlokasiinv->delLokasiinv($id)) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message'=> 'deleted.'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'ID not found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
    public function Lokasiinv_post()
    {
        $data=[
            'idlokasi_inv' => $this->post('idlokasi_inv',true),
                'lokasi_inv' => $this->post('lokasi_inv', true),
        ];

        if ($this->mlokasiinv->AddLokasiinv($data)>0) {
            $this->response([
                'status' => true,
                'data' => "Lokasi Inventory has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function Lokasiinv_put()
    {
        $id =$this->put('id');

        $data=[
                'lokasi_inv' => $this->put('lokasi_inv'),
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else {
            if ($this->mlokasi_inv->editlokasi_inv($data, $id)>0) {
                $this->response([
                    'status' => true,
                    'data' => "Vendor has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
    public function Typeinv_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $typeinv= $this->mtypeinv->GetTypeinv();
            
        }else{
            $typeinv= $this->mtypeinv->GetTypeinv($id);

        }
        if ($typeinv) {
            $this->response([
                'status' => true,
                'data' => $typeinv
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_NOT_FOUND);
            
        }
    }
    public function Typeinv_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if ($this->mtypeinv->delTypeinv($id)) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message'=> 'deleted.'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'ID not found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function Typeinv_post()
    {
        $data=[
            'idtype_inv' => $this->post('idtype_inv',true),
                'type_inv' => $this->post('type_inv', true),
                'idjenis_inv' => $this->post('jenis_inv', true)
        ];

        if ($this->mtypeinv->AddTypeinv($data)>0) {
            $this->response([
                'status' => true,
                'data' => "Type Inventory has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function Typeinv_put()
    {
        $id =$this->put('id');

        $data=[
                'type_inv' => $this->put('type_inv'),
                'idjenis_inv' => $this->put('jenis_inv')
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else {
            if ($this->mtypeinv->editTypeinv($data, $id)) {
                $this->response([
                    'status' => true,
                    'data' => "Type Inventory has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
}
/** End of file Master.php **/