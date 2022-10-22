<?php

use GuzzleHttp\Client;

defined('BASEPATH') or exit('No direct script access allowed');

class M_Transaksi_GA extends CI_Model
{

    private $_client;
    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => SERVER_BASE . 'api/transaksi/'
        ]);
    }

    public function getInv($start = null, $cabang = null)
    {
        $respon =  $this->_client->request('GET', 'inv', [
            'query' => [
                'offset' => $start,
                'cabang' => $cabang
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function getInvbyId($id = null)
    {
        $respon =  $this->_client->request('GET', 'inv', [
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        return $result['data'];
    }
    public function cariinv($id = null, $offset = null)
    {
        $respon =  $this->_client->request('GET', 'cariinv', [
            'query' => [
                'id' => $id,
                'offset' => $offset
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function getInventoryById($id)
    {
        $respon =  $this->_client->request('GET', 'inv', [
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function addInv($data)
    {
        $respon =  $this->_client->request('POST', 'inv', [
            'form_params' => $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function EditInv($data)
    {
        $respon =  $this->_client->request('PUT', 'inv', [
            'form_params' =>  $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function delInv($id)
    {
        $respon =  $this->_client->request('DELETE', 'inv', [
            'form_params' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        // var_dump($result);
        // die;
        if ($result['status'] == true) {
            return true;
        } else {
            return false;
        }
    }

    //------------------------//

    public function getJenisInv()
    {
        $respon =  $this->_client->request('GET', 'jenisinv');

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function getSubInv($id)
    {
        $respon =  $this->_client->request('GET', 'subinv');

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function getStatusInv()
    {
        $respon =  $this->_client->request('GET', 'statusinv');

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function getVendor()
    {
        $respon =  $this->_client->request('GET', 'vendor');

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function getCabang()
    {
        $respon =  $this->_client->request('GET', 'cabang');

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function getLokasi()
    {
        $respon =  $this->_client->request('GET', 'lokasi');

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function getLokasiCabang($id)
    {
        $respon =  $this->_client->request('GET', 'lokasicabang', [
            'query' => [
                'id_cabang' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    //---//

    public function getCabangById($id)
    {
        $respon =  $this->_client->request('GET', 'cabang', [
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function getLokasiById($id)
    {
        $respon =  $this->_client->request('GET', 'lokasi', [
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }


    public function getJenisInvById($id)
    {
        $respon =  $this->_client->request('GET', 'jenisinv', [
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function getSubInvById($id)
    {
        $respon =  $this->_client->request('GET', 'subjenisinv', [
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    //--------------------------------//
    public function cariJadwalAudit($auditor, $tanggal_audit, $jenis_audit)
    {

        $respon =  $this->_client->request('GET', 'carijadwalaudit', [
            'query' => [
                'auditor' => $auditor,
                'tanggal_audit' => $tanggal_audit,
                'jenis_audit' => $jenis_audit
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
    }

    public function getCountInv($id = null, $cabang = null)
    {
        $respon =  $this->_client->request('GET', 'countOffice', [
            'query' => [
                'id' => $id,
                'cabang' => $cabang
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }
}

/* End of file M_Transaksi_GA.php */
