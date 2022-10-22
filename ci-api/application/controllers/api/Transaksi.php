<?php 
   
    defined('BASEPATH') OR exit('No direct script access allowed');
    
        require(APPPATH . 'libraries/REST_Controller.php');
        use Restserver\Libraries\REST_Controller;
        class Transaksi extends REST_Controller {

    private $_tgl;
    function __construct() {
        parent::__construct();
        $this->load->model('transaksi/m_management_inventory', 'minv');
        $this->load->model('master/m_status_inventory','mstatusinv');
        $this->load->model('master/m_jenis_inventory','mjenisinv');
        $this->load->model('master/m_sub_inventory','msubinv');
        $this->load->model('master/m_vendor','mvendor');
        $this->load->model('master/m_cabang','mcabang');
        $this->load->model('master/m_lokasi','mlokasi');
        $this->load->model('master/m_count','mcount');
        $this->load->model('master/m_lokasi_cabang','mlokasicabang');
        $this->_tgl = date('Y-m-d');
        ini_set('max_execution_time', 0);
        }

        public function Inv_get()
    {
        $id = $this->get('id');
        $offset = $this->get('offset');
        $cabang= $this->get('cabang');
        if($id===null&& $offset ===null){
            $listinv = $this->minv->getInv($id,$offset,$cabang);
        }elseif($id===null&& $offset !=null){
            $listinv = $this->minv->getInv($id,$offset,$cabang);
        }else{
            $listinv = $this->minv->getInv($id,$offset,$cabang);
        }
        // $listinv = $this->minv->getInv();
        // var_dump($listinv);
        if ($listinv) {
            $this->response([
                'status' => true,
                'data' => $listinv
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "data not found"
            ], REST_Controller::HTTP_OK); 
        }


    }


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
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function SubJenisinv_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $subjenisinv= $this->msubinv->GetSubJenisinv();
            
        }else{
            $subjenisinv= $this->msubinv->GetSubJenisinv($id);

        }
        if ($subjenisinv) {
            $this->response([
                'status' => true,
                'data' => $subjenisinv
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
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
            ], REST_Controller::HTTP_OK);
            
        }
    }

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
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Lokasi_get()
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
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

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


    public function cariInv_get(){
        $id = $this->get('id');
        $offset = $this->get('offset');

        if ($id===null) {
            $inv = null;
        }else{
            $inv = $this->minv->Cariinventory($id,$offset)->result();
        }
        
        if ($inv) {
            $this->response([
                'status' => true,
                'data' => $inv
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    

    public function Inv_delete()
    {
        $id= $this->delete('id');

        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->minv->delInv($id)) {
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

    public function Inv_post()
    {   
        //belum fix
        $data=[
                'idtransaksi_inv' => $this->post('idtransaksi_inv',true),
                'idstatus_inventory' => $this->post('idstatus_inventory',true),
                'idjenis_inventory' => $this->post('idjenis_inventory',true),
                'idsub_inventory' => $this->post('idsub_inventory',true),
                'nilai_awal' => $this->post('nilai_awal',true),
                'ddp' => $this->post('ddp',true),
                'nilai_asset' => $this->post('nilai_asset',true),
                'nilai_total_keseluruhan' => $this->post('nilai_total_keseluruhan',true),
                'tanggal_barang_diterima' => $this->post('tanggal_barang_diterima',true),
                'id_vendor' => $this->post('id_vendor',true),
                'jenis_pembayaran' => $this->post('jenis_pembayaran',true),
                'id_cabang' => $this->post('id_cabang',true),
                'id_lokasi' => $this->post('id_lokasi',true),
                'nama_pengguna' => $this->post('nama_pengguna',true),              
                'keterangan' => $this->post('keterangan',true),
                'stok' => $this->post('stok',true),
                'foto' => $this->post('foto',true),
                'asal_hadiah' => $this->post('asal_hadiah',true),
                'ppn' => $this->post('ppn',true),
                'ket_ppn' => $this->post('ket_ppn',true),
                'merk' => $this->post('merk',true),
                'aksesoris_tambahan' => $this->post('aksesoris_tambahan',true),
                'serial_number' => $this->post('serial_number',true),
                'uang_muka' => $this->post('uang_muka',true),
                'cicilan_perbulan' => $this->post('cicilan_perbulan',true),
                'tenor' => $this->post('tenor',true),
                'nilai_total' => $this->post('nilai_total',true),
                'no_mesin' => $this->post('no_mesin',true),
                'no_rangka' => $this->post('rangka',true),
                // 'barcode' => $this->post('barcode',true),
                // 'qrcode' => $this->post('qrcode',true),
                'input_by'=> $this->post('user',true),
                'tanggal_input' =>$this->_tgl,
                'is_mutasi' => '0'
                
        ];
        // var_dump($data);die;
            if ($this->minv->AddInv($data)) {
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

    public function Inv_put()
    {
        $id = $this->put('id');
        $data=[
                'idstatus_inventory' => $this->put('idstatus_inventory',true),
                'idjenis_inventory' => $this->put('idjenis_inventory',true),
                'idsub_inventory' => $this->put('idsub_inventory',true),
                'nilai_awal' => $this->put('nilai_awal',true),
                'ddp' => $this->put('ddp',true),
                'nilai_asset' => $this->put('nilai_asset',true),
                'nilai_total_keseluruhan' => $this->put('nilai_total_keseluruhan',true),
                'tanggal_barang_diterima' => $this->put('tanggal_barang_diterima',true),
                'id_vendor' => $this->put('id_vendor',true),
                'jenis_pembayaran' => $this->put('jenis_pembayaran',true),
                'id_cabang' => $this->put('id_cabang',true),
                'id_lokasi' => $this->put('id_lokasi',true),
                'nama_pengguna' => $this->put('nama_pengguna',true),              
                'keterangan' => $this->put('keterangan',true),
                'stok' => $this->put('stok',true),
                'foto' => $this->put('foto',true),
                'asal_hadiah' => $this->put('asal_hadiah',true),
                'ppn' => $this->put('ppn',true),
                'ket_ppn' => $this->put('ket_ppn',true),
                'merk' => $this->put('merk',true),
                'aksesoris_tambahan' => $this->put('aksesoris_tambahan',true),
                'serial_number' => $this->put('serial_number',true),
                'uang_muka' => $this->put('uang_muka',true),
                'cicilan_perbulan' => $this->put('cicilan_perbulan',true),
                'tenor' => $this->put('tenor',true),
                'nilai_total' => $this->put('nilai_total',true),
                'no_mesin' => $this->put('no_mesin',true),
                'no_rangka' => $this->put('rangka',true),
                // 'barcode' => $this->put('barcode',true),
                // 'qrcode' => $this->put('qrcode',true),
                'edit_by'=> $this->put('user',true),
                'tanggal_edit' =>$this->_tgl
    ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else {
            if ($this->minv->editInv($id,$data)) {
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

    public function countOffice_get()
    {
        $id= $this->get('id');
        $cabang= $this->get('cabang');
        
        if ($id===null) {
            $office= $this->mcount->countoffice($id,$cabang);
        }else{
            $office = $this->minv->Cariinventory($id,null,$cabang)->num_rows();
        }
        if ($office) {
            $this->response([
                'status' => true,
                'data' => $office
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    }
    /** End of file Transaksi.php **/
?>