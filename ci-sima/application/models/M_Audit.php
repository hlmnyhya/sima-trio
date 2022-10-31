<?php
use GuzzleHttp\Client;
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Audit extends CI_Model {
    private $_client;
    public function __construct()
        {
            parent::__construct();
            $this->_client = new Client([
                'base_uri'=> SERVER_BASE.'api/audit/'
            ]);
        }

        public function getAudit($offset=null)
        {
            $respon =  $this->_client->request('GET', 'audit',[
                'query' => [
                    'offset' => $offset
                ]
            ]);
    
            $result = json_decode($respon->getBody()->getContents(),true);
    
            if ($result['status']==true) {

                return $result['data'];
            }else {
                return false;
            }              
        }
        public function cariaudit($id = null)
    {
        $respon =  $this->_client->request('GET', 'cariaudit',[
            'query'=>[
                'id' =>$id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(),true);
        if ($result['status']==true) {
            return $result['data'];
        }else{
            return false;
        }
    }
        
    public function getCabang()
    {
        $respon =  $this->_client->request('GET', 'cabang');

        $result = json_decode($respon->getBody()->getContents(),true);

        if ($result['status']==true) {

            return $result['data'];
        }else {
            return false;
        }              
    }

    public function getJenisAudit()
    {
        $respon =  $this->_client->request('GET', 'jenisaudit');

        $result = json_decode($respon->getBody()->getContents(),true);

        if ($result['status']==true) {

            return $result['data'];
        }else {
            return false;
        }              
    }
	
	public function getListAuditor()
    {
        $respon =  $this->_client->request('GET', 'listauditor');

        $result = json_decode($respon->getBody()->getContents(),true);

        if ($result['status']==true) {

            return $result['data'];
        }else {
            return false;
        }              
    }

    public function getTempUnit($cabang,$offset)
    {
      $respon =  $this->_client->request('GET', 'tounit',[
          'query'=>[
              'offset'=>$offset,
              'id_cabang' => $cabang
          ]
      ]);

      $result = json_decode($respon->getBody()->getContents(),true);

      if ($result['status']==true) {

        return $result['data'];
    }else {
        return false;
    }
    }

    public function getTempPart()
    {
      $respon =  $this->_client->request('GET', 'temppart');

      $result = json_decode($respon->getBody()->getContents(),true);

      if ($result['status']==true) {

        return $result['data'];
    }else {
        return false;
    }
    }

    //-----------------BY ID---------------//
    public function getJadwalAuditById($id)
    {
        $respon =  $this->_client->request('GET', 'audit',[
            'query' =>[
                'id'=> $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(),true);
        if ($result['status']==true) {
            return $result['data']; 
        }else{
            return false;
        }
    }

    public function getTempUnitById($id)
    {
        $respon =  $this->_client->request('GET', 'tempunit',[
            'query' =>[
                'id'=> $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(),true);
        if ($result['status']==true) {
            return $result['data']; 
        }else{
            return false;
        }
    }

    public function getLokasiById($id)
    {
        $respon =  $this->_client->request('GET', 'lokasi',[
            'query' =>[
                'id'=> $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(),true);
        if ($result['status']==true) {
            return $result['data']; 
        }else{
            return false;
        }
    }

    //-----ADD---//
    public function addAudit($data)
    {
        $respon =  $this->_client->request('POST', 'audit',[
            'form_params'=> $data
        ]);

        $result = json_decode($respon->getBody()->getContents(),true);
        if ($result['status']==true) {
            return $result['data']; 
        }else{
            return false;
        }
    }

    //----------UPDATE---------//
    public function UpdateJadwalAudit($data)
    {
        $respon =  $this->_client->request('PUT', 'auditket',[
          'form_params'=>  $data
        ]);

        $result = json_decode($respon->getBody()->getContents(),true);
        if ($result['status']==true) {
            return $result['data']; 
        }else{
            return false;
        }
    }

    //---------DELETE------------//
    public function delJadwalAudit($id)
    { 
        $respon =  $this->_client->request('DELETE', 'audit',[
          'form_params'=>[
              'id'=> $id
          ]
      ]);

      $result = json_decode($respon->getBody()->getContents(),true);

      if ($result['status']==true) {
        return true; 
    }else{
        return false;
    }    
    }
    //----------------BUAT KODE------------------//
    public function buatkodejadwalaudit()
    {
      $respon =  $this->_client->request('GET', 'jadwalauditcount');

      $result = json_decode($respon->getBody()->getContents(),true);
        if ($result['status']==true) {
            return $result['data']; 
        }else{
            return 0;
        }
    }

    public function counttempunit($a,$b,$c,$d)
      {
          $respon =  $this->_client->request('GET', 'counttempunit',[
              'query'=>[
                  'id_cabang' => $a,
                  'tgl_awal' =>$b,
                  'tgl_akhir' =>$c,
                  'status' =>$d
              ]
          ]);

        $result = json_decode($respon->getBody()->getContents(),true);
        // var_dump($result['data'][0]);die;
        if ($result['status']==true) {
            return $result['data'];
        }else{
            return 0;
        }
      }

      public function countjadwalaudit()
      {
          $respon =  $this->_client->request('GET', 'countjadwalaudit');

        $result = json_decode($respon->getBody()->getContents(),true);
        // var_dump($result['data'][0]);die;
        if ($result['status']==true) {
            return $result['data'];
        }else{
            return false;
        }
      }

      public function cariUnit($no_mesin,$no_rangka)
      {
          
          $respon =  $this->_client->request('GET', 'cariUnit',[
              'query'=>[
                  'no_mesin'=> $no_mesin,
                  'no_rangka'=> $no_rangka
              ]
          ]);
  
          $result = json_decode($respon->getBody()->getContents(),true);
  
          if ($result['status']==true) {
              return $result['data'];
          }else{
              return false;
          }
      }
      

    

}

/* End of file M_Audit.php */

?>