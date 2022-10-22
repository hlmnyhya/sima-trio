<?php

defined('BASEPATH') OR exit('No direct script access allowed');

    require(APPPATH . 'libraries/REST_Controller.php');
    use Restserver\Libraries\REST_Controller;
    class Master extends REST_Controller {

function __construct() {
    parent::__construct();
    $this->load->model('master/m_user','muser');
    $this->load->model('master/m_usergroup','musergroup');
    $this->load->model('master/m_lokasi','mlokasi');
    $this->load->model('master/m_jenis_inventory','mjenisinv');
    $this->load->model('master/m_jenis_audit','mjenisaudit');
    $this->load->model('master/m_vendor','mvendor');
    $this->load->model('master/m_perusahaan','mperusahaan');
    $this->load->model('master/m_cabang','mcabang');
    $this->load->model('master/m_lokasi_cabang','mlokasicabang');
    $this->load->model('master/m_sub_inventory','msubinv');
    $this->load->model('master/m_status_inventory','mstatusinv');
    $this->load->model('master/m_count','mcount');
    $this->load->model('master/m_menu','mmenu');
    $this->load->model('master/m_sub_menu','msubmenu');
    $this->_tgl = date('Y-m-d');
    $this->_datetime = date('Y-m-d H:i:s');
    ini_set('max_execution_time', 30);

    }

    //------------------------------------------------------------USER-----------------------------------------------------------------//
    public function User_get(){
        $id= $this->get('id');
        $offset = $this->get('offset');
        
        if ($id===null) {
            $user= $this->muser->GetUser(null,$offset);
            
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
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Userpass_get(){
        $id= $this->get('id');
        $pass =$this->get('password',true);
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$pass);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($pass, $encrypt_method, $key, 0, $iv);
        $password = base64_encode($output);
        
        if ($id===null) {
            $user= null;
            
        }else{
            $user= $this->muser->GetUserPass($id,$password);

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

    public function Userpass_put(){
        $id= $this->put('id');
        $pass =$this->put('password',true);
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$pass);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($pass, $encrypt_method, $key, 0, $iv);
        $password = base64_encode($output);
        $data =[
            'password' => $password
        ];
        if ($id===null) {
            $user= null;
            
        }else{
            $user= $this->muser->editUserPass($id,$data);

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

    public function User_post()
    {   
        //belum fix
        $pass =$this->post('password',true);
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$pass);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($pass, $encrypt_method, $key, 0, $iv);
        $password = base64_encode($output);
        $data=[
            'nik' => $this->post('nik',true),
                'username' => $this->post('username',true),
                'nama' => $this->post('nama',true),
                'password' => $password,
                'id_usergroup' => $this->post('id_usergroup',true),
                'id_perusahaan' => $this->post('id_perusahaan',true),
                'id_lokasi' => $this->post('id_lokasi',true),
                'id_cabang' => $this->post('id_cabang',true),
                'status' => 'Aktif',
                'input_by' => $this->post('user',true),
                'tanggal_input' => $this->_tgl
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
                ], REST_Controller::HTTP_OK);
            }
        
    }

    public function User_put()
    {
        $id= $this->put('id');
        $pass =$this->put('password',true);
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$pass);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($pass, $encrypt_method, $key, 0, $iv);
        $password = base64_encode($output);
        if ($pass==null) {
            $data=[
                'username' => $this->put('username',true),
                    'nama' => $this->put('nama',true),
                    'id_usergroup' => $this->put('id_usergroup',true),
                    'id_perusahaan' => $this->put('id_perusahaan',true),
                    'id_lokasi' => $this->put('id_lokasi',true),
                    'id_cabang' => $this->put('id_cabang',true),
                    'status' => $this->put('status',true),
                    'edit_by' => $this->put('user',true),
                    'tanggal_edit' => $this->_datetime
            ];
        }else{
            $data=[
                'username' => $this->put('username',true),
                    'nama' => $this->put('nama',true),
                    'password' => $password,
                    'id_usergroup' => $this->put('id_usergroup',true),
                    'id_perusahaan' => $this->put('id_perusahaan',true),
                    'id_lokasi' => $this->put('id_lokasi',true),
                    'id_cabang' => $this->put('id_cabang',true),
                    'status' => $this->put('status',true),
                    'edit_by' => $this->put('user',true),
                    'tanggal_edit' => $this->_datetime
            ];
        }
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
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
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function User_delete()
    {
        $id= $this->delete('id');

        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->muser->delUser($id)) {
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

    public function cariUser_get(){
        $id= $this->get('id');
        $offset= $this->get('offset');
        if ($id === null) {
            $user=null;
        }else{
            $user= $this->muser->cariUser($id,$offset)->result();
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
    public function cariMenuakses_get(){
        $id= $this->get('id');
        $offset= $this->get('offset');
        if ($id === null) {
            $user=null;
        }else{
            $user= $this->mmenu->carimenuakses($id,$offset)->result();
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

    public function countuser_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $user= $this->mcount->countuser();
        }else{
            $user= $this->muser->cariUser($id)->num_rows();
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
    public function countmenuakses_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $user= $this->mcount->countmenuakses();
        }else{
            $user= $this->mmenu->carimenuakses($id)->num_rows();
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


    //-----------------------------------------------------USER GROUP---------------------------------------------------------------//

    public function Usergroup_get()
    {
        $id= $this->get('id');
        $offset = $this->get('offset');
        if ($id===null&&$offset ===null) {
            $usergroup= $this->musergroup->GetUsergroup();
        }elseif($id===null&&$offset !==null){
            $usergroup= $this->musergroup->GetUsergroup(null,$offset);
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
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Usergroup_post()
    {
        $data=[
            'id_usergroup' => $this->post('id_usergroup',true),
            'user_group' => $this->post('user_group', true),
            'input_by' => $this->post('user',true),
            'tanggal_input' => $this->_tgl
        ];

        if ($this->musergroup->AddUsergroup($data)) {
            $this->response([
                'status' => true,
                'data' => "Usergroup has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_OK);
        }
    }
    public function Usergroup_put()
    {
        $id =$this->put('id');
        $data=[
                'user_group' => $this->put('user_group', true),
                'edit_by' => $this->post('user',true),
                'tanggal_edit' => $this->_tgl
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else {
            if ($this->musergroup->editUsergroup($data, $id)) {
                $this->response([
                    'status' => true,
                    'data' => "Usergroup has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function Usergroup_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->musergroup->delUsergroup($id)) {
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

    public function cariUsergroup_get()
    {
        $id= $this->get('usergroup');
        
        if ($id===null) {
            $usergroup= $this->musergroup->cariUsergroup();
            
        }else{
            $usergroup= $this->musergroup->cariUsergroup($id);
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
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Usergroupcount_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $usergroup= $this->mcount->Countusergroup();
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
            ], REST_Controller::HTTP_OK);
            
        }
    }

    //-------------------------------------------------------JENIS INVENTORY----------------------------------------------------------//
    public function Jenisinv_get()
    {
        $id= $this->get('id');
        $offset = $this->get('offset');
        if ($id===null&&$offset===null) {
            $jenisinv= $this->mjenisinv->GetJenisinv();
            
        }elseif ($id===null&&$offset!=null) {
            $jenisinv= $this->mjenisinv->GetJenisinv(null, $offset);
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
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function countjenisinv_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $user= $this->mcount->countjenisinv();
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

    public function Jenisinv_post()
    {
        $data=[
            'idjenis_inventory' => $this->post('idjenis_inventory',true),
            'jenis_inventory' => $this->post('jenis_inventory', true),
            'input_by' => $this->post('user',true),
            'tanggal_input' => $this->_tgl
        ];

        if ($this->mjenisinv->AddJenisinv($data)) {
            $this->response([
                'status' => true,
                'data' => "Jenis Inventory has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_OK);
        }
    }

    public function Jenisinv_put()
    {
        $id =$this->put('id');

        $data=[
                'jenis_inventory' => $this->put('jenis_inventory', true),
                'edit_by' => $this->post('user',true),
                'tanggal_edit' => $this->_tgl
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else {
            if ($this->mjenisinv->editJenisinv($data, $id)) {
                $this->response([
                    'status' => true,
                    'data' => "Jenis Inventory has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function Jenisinv_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->mjenisinv->delJenisinv($id)) {
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

    public function cariJenisInv_get()
    {
        $id= $this->get('jenisinv');
        
        if ($id===null) {
            $jenisinv= null;
            
        }else{
            $jenisinv= $this->mjenisinv->cariJenisInv($id);
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
            ], REST_Controller::HTTP_OK);
            
        }
    }

    
    //--------------------------------------------------------SUB INVENTORY----------------------------------------------------------//
    public function Subinv_get()
    {
        $id= $this->get('id');
        $offset=$this->get('offset');
        if ($id===null) {
            $subinv= $this->msubinv->GetSubinv($id,$offset);
            
        }else{
            $subinv= $this->msubinv->GetSubinv($id,$offset);

        }
        if ($subinv) {
            $this->response([
                'status' => true,
                'data' => $subinv
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function SubinvJenis_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $subinv= null;
            
        }else{
            $subinv= $this->msubinv->GetSubinvByJenis($id);

        }
        if ($subinv) {
            $this->response([
                'status' => true,
                'data' => $subinv
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function subinv_post()
    {
        $data=[
                'idsub_inventory'   => $this->post('idsub_inventory',true),
                'sub_inventory'     => $this->post('sub_inventory', true),
                'idjenis_inventory' => $this->post('idjenis_inventory', true),
                'input_by' => $this->post('user',true),
                'tanggal_input' => $this->_tgl
        ];

        if ($this->msubinv->AddSubInv($data)) {
            $this->response([
                'status' => true,
                'data' => "sub Inventory has been created",
                'show' => $data
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_OK);
        }
    }

    public function subinv_put()
    {
        $id =$this->put('id');

        $data=[
            'sub_inventory' => $this->put('sub_inventory', true),
            'idjenis_inventory' => $this->put('idjenis_inventory', true),
            'edit_by' => $this->post('user',true),
            'tanggal_edit' => $this->_tgl
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else {
            if ($this->msubinv->editsubinv($data, $id)) {
                $this->response([
                    'status' => true,
                    'data' => "sub Inventory has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function subinv_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->msubinv->delSubinv($id)) {
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
    
    public function cariSubinv_get(){
        $subinv= $this->get('subinv');
        $jenisinv= $this->get('jenisinv');
        // var_dump($jenisinv);die;
        if ($subinv!=null && $jenisinv !=null) {
            $sub= $this->msubinv->cariSubinv($subinv,$jenisinv);
            
        }elseif($subinv!=null && $jenisinv==null){
            $sub= $this->msubinv->cariSubinv($subinv);
            
        }elseif ($subinv==null && $jenisinv!=null) {
            $sub= $this->msubinv->cariSubinv(null,$jenisinv);
            
        }
        if ($sub) {
            $this->response([
                'status' => true,
                'data' => $sub
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function cariSubinv2_get(){
        $id= $this->get('id');
        $offset=$this->get('offset');
        if ($id===null) {
            $sub= null;
        }else{
            $sub= $this->msubinv->cariSubinv2($id,$offset)->result();
        }
        if ($sub) {
            $this->response([
                'status' => true,
                'data' => $sub
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Subinvcount_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $subinv= $this->mcount->Countsubinventory();

        }else{
            $subinv= $this->msubinv->CariSubinv2($id)->num_rows();
        }
        
        if ($subinv) {
            $this->response([
                'status' => true,
                'data' => $subinv
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    //--------------------------------------------------------STATUS INVENTORY-------------------------------------------------------//
    public function statusinv_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $statusinv= $this->mstatusinv->GetStatusinv();
            
        }else{
            $statusinv= $this->mstatusinv->GetStatusinv($id);

        }
        if ($statusinv) {
            $this->response([
                'status' => true,
                'data' => $statusinv
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function statusinv_post()
    {
        $data=[
            'idstatus_inventory' => $this->post('idstatus_inventory',true),
            'status_inventory' => $this->post('status_inventory', true),
            'input_by' => $this->post('user',true),
            'tanggal_input' => $this->_tgl
        ];

        if ($this->mstatusinv->AddStatusInv($data)) {
            $this->response([
                'status' => true,
                'data' => "Status Inventory has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_OK);
        }
    }
    public function statusinv_put()
    {
        $id =$this->put('id');

        $data=[
            'status_inventory' => $this->put('status_inventory', true),
            'edit_by' => $this->post('user',true),
            'tanggal_edit' => $this->_tgl
        ];
        // var_dump($this->post());die;
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else {
            if ($this->mstatusinv->editStatusInv($data, $id)) {
                $this->response([
                    'status' => true,
                    'data' => "Status Inventory has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function statusinv_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->mstatusinv->delStatusInv($id)) {
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

    public function caristatusinv_get()
    {
        $id= $this->get('statusinv');
        
        if ($id===null) {
            $statusinv= $this->mstatusinv->cariStatusinv();
            
        }else{
            $statusinv= $this->mstatusinv->cariStatusinv($id);
        }
        if ($statusinv) {
            $this->response([
                'status' => true,
                'data' => $statusinv
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Statusinvcount_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $statusinv= $this->mcount->Countstatusinventory();

        }

        if ($statusinv) {
            $this->response([
                'status' => true,
                'data' => $statusinv
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    //----------------------------------------------------------PERUSAHAAN----------------------------------------------------------//
    public function perusahaan_get()
    {
        $id= $this->get('id');
        $offset= $this->get('id');
        
        if ($id===null) {
            $perusahaan= $this->mperusahaan->GetPerusahaan($id,$offset);
        }else{
            $perusahaan= $this->mperusahaan->GetPerusahaan($id);

        }
        if ($perusahaan) {
            $this->response([
                'status' => true,
                'data' => $perusahaan
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function perusahaan_post()
    {
        $data=[
            'id_perusahaan' => $this->post('id_perusahaan',true),
            'nama_perusahaan' => $this->post('nama_perusahaan', true),
            'input_by' => $this->post('user',true),
            'tanggal_input' => $this->_tgl
        ];

        if ($this->mperusahaan->AddPerusahaan($data)) {
            $this->response([
                'status' => true,
                'data' => "Perusahaan has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_OK);
        }
    }
    public function perusahaan_put()
    {
        $id =$this->put('id');

        $data=[
            'nama_perusahaan' => $this->put('nama_perusahaan', true),
            'edit_by' => $this->post('user',true),
            'tanggal_edit' => $this->_tgl
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else {
            if ($this->mperusahaan->editPerusahaan($data, $id)) {
                $this->response([
                    'status' => true,
                    'data' => "Perusahaan has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function perusahaan_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->mperusahaan->delPerusahaan($id)) {
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

    public function cariperusahaan_get()
    {
        $id= $this->get('perusahaan');
        $offset= $this->get('offset');
        
        if ($id===null) {
            $perusahaan= null;
            
        }else{
            $perusahaan= $this->mperusahaan->cariPerusahaan($id,$offset)->result();
        }
        if ($perusahaan) {
            $this->response([
                'status' => true,
                'data' => $perusahaan
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function countperusahaan_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $perusahaan= $this->mcount->countperusahaan();
        }else{
            $perusahaan = $this->mperusahaan->cariPerusahaan($id)->num_rows();
        }
        if ($perusahaan) {
            $this->response([
                'status' => true,
                'data' => $perusahaan
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    //------------------------------------------------------------CABANG------------------------------------------------------------//
    public function cabang_get()
    {
        $id= $this->get('id');
        $offset = $this->get('offset');
        if ($id===null&& $offset===null) {
            $cabang= $this->mcabang->GetCabang(null);
            
        }elseif ($id===null&& $offset!=null){
            $cabang= $this->mcabang->GetCabang(null,$offset);
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
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function cabang_post()
    {
        $data=[
            'id_cabang' => $this->post('id_cabang',true),
            'nama_cabang' => $this->post('nama_cabang', true),
            'input_by' => $this->post('user',true),
            'tanggal_input' => $this->_tgl
        ];

        if ($this->mcabang->AddCabang($data)) {
            $this->response([
                'status' => true,
                'data' => "Cabang Inventory has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_OK);
        }
    }
    public function cabang_put()
    {
        $id =$this->put('id');

        $data=[
            'nama_cabang' => $this->put('nama_cabang', true),
            'edit_by' => $this->post('user',true),
            'tanggal_edit' => $this->_tgl
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else {
            if ($this->mcabang->editCabang($data, $id)) {
                $this->response([
                    'status' => true,
                    'data' => "Cabang has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function cabang_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->mcabang->delCabang($id)) {
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

    public function caricabang_get()
    {
        $id= $this->get('cabang');
        $offset= $this->get('offset');
        
        if ($id===null) {
            $cabang= null;
            
        }else{
            $cabang= $this->mcabang->cariCabang($id,$offset)->result();
        }
        if ($cabang) {
            $this->response([
                'status' => true,
                'data' => $cabang
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function countcabang_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $cabang= $this->mcount->countcabang();
        }else{
            $cabang= $this->mcabang->caricabang($id)->num_rows();

        }
        if ($cabang) {
            $this->response([
                'status' => true,
                'data' => $cabang
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    //------------------------------------------------------------LOKASI-----------------------------------------------------------//
    public function Lokasi_get()
    {
        $id= $this->get('id');
        $offset = $this->get('offset');
        
        
        if ($id===null) {
            $lokasi= $this->mlokasi->GetLokasi(null,$offset);
            
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
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    
    public function Gudang_get()
    {
        $id= $this->get('id');
        $offset = $this->get('offset');
        
        
        if ($id===null) {
            $lokasi= $this->mlokasi->GetGudang(null,$offset);
            
        }else{
            $lokasi= $this->mlokasi->GetGudang($id);

        }
        if ($lokasi) {
            $this->response([
                'status' => true,
                'data' => $lokasi
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Lokasi_post()
    {
        $data=[
            'id_lokasi' => $this->post('id_lokasi',true),
            'nama_lokasi' => $this->post('nama_lokasi', true),
            'input_by' => $this->post('user',true),
            'tanggal_input' => $this->_tgl
        ];

        if ($this->mlokasi->AddLokasi($data)) {
            $this->response([
                'status' => true,
                'data' => "Lokasi has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_OK);
        }
    }

    public function Gudang_post()
    {
        $data=[
            'kd_gudang' => $this->post('kd_gudang',true),
            'nama_gudang' => $this->post('nama_gudang', true),
            'jenis_gudang' => $this->post('jenis_gudang', true),
            'alamat' => $this->post('alamat', true),
            'created_by' => $this->post('created_by',true),
            'created_time' => $this->_tgl
        ];

        if ($this->mlokasi->AddGudang($data)) {
            $this->response([
                'status' => true,
                'data' => "Gudang has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_OK);
        }
    }

    public function Lokasi_put()
    {
        $id =$this->put('id');

        $data=[
                'nama_lokasi' => $this->put('nama_lokasi', true),
                'edit_by' => $this->post('user',true),
                'tanggal_edit' => $this->_tgl
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else {
            if ($this->mlokasi->editLokasi($data, $id)) {
                $this->response([
                    'status' => true,
                    'data' => "Lokasi has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function Gudang_put()
    {
        $id =$this->put('kd_gudang');

        $data=[
                'nama_gudang' => $this->put('nama_gudang', true),
                'jenis_gudang' => $this->put('jenis_gudang', true),
                'alamat' => $this->put('alamat', true),
                'modified_by' => $this->put('modified_by',true),
                'modified_time' => date("Y-m-d H:i:s")
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else {
            if ($this->mlokasi->editGudang($data, $id)) {
                $this->response([
                    'status' => true,
                    'data' => "Gudang has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function Lokasi_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->mlokasi->dellokasi($id)) {
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

    public function Gudang_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->mlokasi->delgudang($id)) {
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

    public function cariLokasi_get()
    {
        $id= $this->get('lokasi');
        $offset= $this->get('offset');
        
        if ($id===null) {
            $lokasi= $this->mlokasi->cariLokasi();
            
        }else{
            $lokasi= $this->mlokasi->cariLokasi($id,$offset)->result();
        }
        if ($lokasi) {
            $this->response([
                'status' => true,
                'data' => $lokasi
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function countlokasi_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $lokasi= $this->mcount->countlokasi();
        }else{
            $lokasi= $this->mlokasi->carilokasi($id)->num_rows();
        }
        if ($lokasi) {
            $this->response([
                'status' => true,
                'data' => $lokasi
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function countgudang_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $lokasi= $this->mcount->countgudang();
        }else{
            $lokasi= $this->mlokasi->carigudang($id)->num_rows();
        }
        if ($lokasi) {
            $this->response([
                'status' => true,
                'data' => $lokasi
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    //------------------------------------------------------------VENDOR-----------------------------------------------------------//
    public function Vendor_get()
    {
        $id= $this->get('id');
        $offset= $this->get('offset');
        
        if ($id===null) {
            $vendor= $this->mvendor->GetVendor($id,$offset);
            
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
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Vendor_post()
    {
        $data=[
            'id_vendor' => $this->post('id_vendor',true),
            'nama_vendor' => $this->post('nama_vendor', true),
            'input_by' => $this->post('user',true),
            'tanggal_input' => $this->_tgl
        ];

        if ($this->mvendor->Addvendor($data)) {
            $this->response([
                'status' => true,
                'data' => "Vendor has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_OK);
        }
    }
    public function Vendor_put()
    {
        $id =$this->put('id');

        $data=[
                'nama_vendor' => $this->put('nama_vendor'),
                'edit_by' => $this->post('user',true),
                'tanggal_edit' => $this->_tgl
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else {
            if ($this->mvendor->editVendor($data, $id)) {
                $this->response([
                    'status' => true,
                    'data' => "Vendor has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function Vendor_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->mvendor->delVendor($id)) {
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
    
    public function cariVendor_get()
    {
        $id= $this->get('vendor');
        $offset= $this->get('offset');
        
        if ($id===null) {
            $vendor= null;
            
        }else{
            $vendor= $this->mvendor->cariVendor($id,$offset)->result();
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
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Vendorcount_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $vendor= $this->mcount->Countvendor();
        }else{
            $vendor= $this->mvendor->cariVendor($id)->num_rows();
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
            ], REST_Controller::HTTP_OK);
            
        }
    }

    //--------------------------------------------------------JENIS AUDIT----------------------------------------------------------//
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
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Jenisaudit_post()
    {
        $data=[
            'idjenis_audit' => $this->post('idjenis_audit',true),
            'jenis_audit' => $this->post('jenis_audit', true),
            'input_by' => $this->post('user',true),
            'tanggal_input' => $this->_tgl
        ];
        // var_dump($data);die;
        if ($this->mjenisaudit->AddJenisaudit($data)) {
            $this->response([
                'status' => true,
                'data' => "Jenis Audit has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_OK);
        }
    }
    public function Jenisaudit_put()
    {
        $id =$this->put('id');

        $data=[
                'jenis_audit' => $this->put('jenis_audit', true),
                'edit_by' => $this->post('user',true),
                'tanggal_edit' => $this->_tgl
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else {
            if ($this->mjenisaudit->editJenisAudit($data, $id)) {
                $this->response([
                    'status' => true,
                    'data' => "Jenis Audit has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    public function Jenisaudit_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->mjenisaudit->delJenisaudit($id)) {
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

    public function cariJenisAudit_get()
    {
        $id= $this->get('jenisaudit');
        
        if ($id===null) {
            $jenisaudit= null;
            
        }else{
            $jenisaudit= $this->mjenisaudit->cariJenisAudit($id);
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
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Jenisauditcount_get()
    {
        
        $id= $this->get('id');
        
        if ($id===null) {
            $jenisaudit= $this->mcount->Countjenisaudit();
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
            ], REST_Controller::HTTP_OK);
            
        }
    }

    //----------------------------------------------------------MENU-----------------------------------------------------------------//  
    public function Menu_get()
    {
        $access= $this->get('access');
        
        if ($access===null) {
            $menu= $this->mmenu->GetMenu();
            
        }else{
            $menu= $this->mmenu->GetMenu($access);

        }
        if ($menu) {
            $this->response([
                'status' => true,
                'data' => $menu
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function SubMenu_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $submenu= $this->msubmenu->GetSubMenu();
            
        }else{
            $submenu= $this->msubmenu->GetSubMenu($id);

        }
        if ($submenu) {
            $this->response([
                'status' => true,
                'data' => $submenu
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data'=>'',
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function MenuAkses_get()
    {
        $id= $this->get('id');
        $ug = $this->get('usergroup');
        if ($id===null) {
            $menuakses= $this->mmenu->GetMenuAkses();
            
        }else{
            $menuakses= $this->mmenu->GetMenuAkses($id,$ug);

        }
        if ($menuakses) {
            $this->response([
                'status' => true,
                'data' => $menuakses
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function MenuAkses_post()
    {
        $data=[
            'id_usergroup' => $this->post('id_usergroup'),
            'id_menu' => $this->post('id_menu')
        ];
            $menuakses= $this->mmenu->addMenuAkses($data);
        if ($menuakses) {
            $this->response([
                'status' => true,
                'data' => $menuakses
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function MenuAkses_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $menuakses= null;
            
        }else{
            $menuakses= $this->mmenu->DelMenuAkses($id);

        }
        if ($menuakses) {
            $this->response([
                'status' => true,
                'data' => $menuakses
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    //-----------------------------------------------------LOKASI CABANG---------------------------------------------------------------//

    public function lokasicabang_get()
    {
        $id= $this->get('id_cabang');
        
        if ($id===null) {
            $lokasicabang= $this->mlokasicabang->GetLokasiCabang();
            
        }else{
            $lokasicabang= $this->mlokasicabang->GetLokasiCabang($id);

        }
        if ($lokasicabang) {
            $this->response([
                'status' => true,
                'data' => $lokasicabang
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }



}
/** End of file Master.php **/