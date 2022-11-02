<?php 
   
    defined('BASEPATH') OR exit('No direct script access allowed');
    
        require(APPPATH . 'libraries/REST_Controller.php');
        use Restserver\Libraries\REST_Controller;
        class Generalaffairs extends REST_Controller {

    private $_tgl;
    function __construct() {
        parent::__construct();
        $this->load->model('master/m_status_inventory','mstatusinv');
        $this->load->model('master/m_jenis_inventory','mjenisinv');
        $this->load->model('master/m_sub_inventory','msubinv');
        $this->load->model('master/m_vendor','mvendor');
        $this->load->model('master/m_cabang','mcabang');
        $this->load->model('master/m_lokasi','mlokasi');
        $this->load->model('master/m_count','mcount');
        $this->load->model('master/m_lokasi_cabang','mlokasicabang');
        $this->load->model('generalaffairs/m_laporan_ga', 'mlapga');
        $this->_tgl = date('Y-m-d');
        ini_set('max_execution_time', 0);
        }

         public function Inv_get()
    {
        $id2 = $this->get('id');
        $offset = $this->get('offset');
        $cabang2= $this->get('cabang');
        if($id2===null&& $offset ===null){
            $listinv = $this->moniv->getInv($id2,$offset,$cabang2);
        }elseif($id2===null&& $offset !=null){
            $listinv = $this->moniv->getInv($id2,$offset,$cabang2);
        }else{
            $listinv = $this->moniv->getInv($id2,$offset,$cabang2);
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
        $id2= $this->get('id');
        
        if ($id2===null) {
            $statusinv= $this->mstatusinv->GetStatusinv();
            
        }else{
            $statusinv= $this->mstatusinv->GetStatusinv($id2);

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
        $id2= $this->get('id');
        
        if ($id2===null) {
            $jenisinv= $this->mjenisinv->GetJenisinv();
            
        }else{
            $jenisinv= $this->mjenisinv->GetJenisinv($id2);
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
        $id2= $this->get('id');
        
        if ($id2===null) {
            $subjenisinv= $this->msubinv->GetSubJenisinv();
            
        }else{
            $subjenisinv= $this->msubinv->GetSubJenisinv($id2);

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
        $id2= $this->get('id');
        
        if ($id2===null) {
            $vendor= $this->mvendor->GetVendor();
            
        }else{
            $vendor= $this->mvendor->GetVendor($id2);

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
        $id2= $this->get('id');
        
        if ($id2===null) {
            $cabang2= $this->mcabang->GetCabang();
            
        }else{
            $cabang2= $this->mcabang->GetCabang($id2);

        }
        if ($cabang2) {
            $this->response([
                'status' => true,
                'data' => $cabang2
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
        $id2= $this->get('id');
        
        if ($id2===null) {
            $lokasi= $this->mlokasi->GetLokasi();
            
        }else{
            $lokasi= $this->mlokasi->GetLokasi($id2);

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
        $id2= $this->get('id_cabang');
        
        if ($id2===null) {
            $lokasicabang= $this->mlokasicabang->GetLokasiCabang();
            
        }else{
            $lokasicabang= $this->mlokasicabang->GetLokasiCabang($id2);

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
        $id2 = $this->get('id');
        $offset = $this->get('offset');

        if ($id2===null) {
            $inv = null;
        }else{
            $inv = $this->moniv->Cariinventory($id2,$offset)->result();
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
        $id2= $this->delete('id');

        if ($id2===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->moniv->delInv($id2)) {
                $this->response([
                    'status' => true,
                    'id' => $id2,
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
            if ($this->moniv->AddInv($data)) {
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
        $id2 = $this->put('id');
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
        if ($id2===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else {
            if ($this->moniv->editInv($id2,$data)) {
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
        $id2= $this->get('id');
        $cabang2= $this->get('cabang');
        
        if ($id2===null) {
            $office= $this->mcount->countoffice($id2,$cabang2);
        }else{
            $office = $this->moniv->Cariinventory($id2,null,$cabang2)->num_rows();
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
    /** End of file Generalaffairs.php **/
?>