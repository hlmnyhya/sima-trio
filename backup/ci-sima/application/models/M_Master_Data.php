<?php

use GuzzleHttp\Client;

defined('BASEPATH') or exit('No direct script access allowed');

class M_Master_Data extends CI_Model
{

    private $_client;
    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => SERVER_BASE . 'api/master/'
        ]);
    }

    // public function getUser()
    // {
    //     $respon =  $this->_client->request('GET', 'user');

    //     $result = json_decode($respon->getBody()->getContents(),true);

    //     if ($result['status']==true) {

    //         return $result['data'];
    //     }else {
    //         return false;
    //     }

    // }

    public function getUser($offset)
    {
        $respon =  $this->_client->request('GET', 'user', [
            'query' => [
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
    public function countUser($id = null)
    {
        $respon =  $this->_client->request('GET', 'countuser', [
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




    public function getUserGroup($offset = null)
    {
        $respon =  $this->_client->request('GET', 'usergroup', [
            'query' => [
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

    public function getJenisInv($start = null)
    {
        $respon =  $this->_client->request('GET', 'jenisinv', [
            'query' => [
                'offset' => $start
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {

            return $result['data'];
        } else {
            return false;
        }
    }

    public function getSubInv($offset = null)
    {
        $respon =  $this->_client->request('GET', 'subinv', [
            'query' => [
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

    public function getPerusahaan($offset = null)
    {
        $respon =  $this->_client->request('GET', 'perusahaan', [
            'query' => [
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
    public function perusahaancount($id = null)
    {
        $respon =  $this->_client->request('GET', 'countperusahaan', [
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

    public function getCabang($offset = null)
    {
        $respon =  $this->_client->request('GET', 'cabang', [
            'query' => [
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

    public function getLokasi($offset)
    {
        $respon =  $this->_client->request('GET', 'lokasi', [
            'query' => [
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

    public function getGudang($offset)
    {
        $respon =  $this->_client->request('GET', 'gudang', [
            'query' => [
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

    public function getLokasiCabang($id)
    {
        $respon =  $this->_client->request('GET', 'lokasicabang', [
            'query' => [
                'id_cabang' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        return $result['data'];
    }

    public function getVendor($offset = null)
    {
        $respon =  $this->_client->request('GET', 'vendor', [
            'query' => [
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

    public function getJenisAudit()
    {
        $respon =  $this->_client->request('GET', 'jenisaudit');

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {

            return $result['data'];
        } else {
            return false;
        }
    }

    //-----------------------------------------------GET BY ID------------------------------------------------------//
    public function getUserById($id)
    {
        $respon =  $this->_client->request('GET', 'user', [
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

    public function getUserGroupById($id)
    {
        $respon =  $this->_client->request('GET', 'usergroup', [
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
        $respon =  $this->_client->request('GET', 'subinv', [
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

    public function getStatusInvById($id)
    {
        $respon =  $this->_client->request('GET', 'statusinv', [
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

    public function getPerusahaanById($id)
    {
        $respon =  $this->_client->request('GET', 'perusahaan', [
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

    public function getGudangById($id)
    {
        $respon =  $this->_client->request('GET', 'gudang', [
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

    public function getVendorById($id)
    {
        $respon =  $this->_client->request('GET', 'vendor', [
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

    public function getJenisAuditById($id)
    {
        $respon =  $this->_client->request('GET', 'jenisaudit', [
            'query' => [
                'id' => $id
            ]
        ]);
        $result = json_decode($respon->getBody()->getContents(), true);
        // var_dump($respon,$id);die;
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    //-------------------------------------------------ADD--------------------------------------------------------//
    public function addUser($data)
    {
        $respon =  $this->_client->request('POST', 'user', [
            'form_params' => $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function addUserGroup($data)
    {
        $respon =  $this->_client->request('POST', 'usergroup', [
            'form_params' => $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function addJenisInv($data)
    {
        $respon =  $this->_client->request('POST', 'jenisinv', [
            'form_params' => $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function addSubInv($data)
    {
        $respon =  $this->_client->request('POST', 'subinv', [
            'form_params' => $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function addStatusInv($data)
    {
        $respon =  $this->_client->request('POST', 'statusinv', [
            'form_params' => $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function addPerusahaan($data)
    {
        $respon =  $this->_client->request('POST', 'perusahaan', [
            'form_params' => $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function addCabang($data)
    {
        $respon =  $this->_client->request('POST', 'cabang', [
            'form_params' => $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function addLokasi($data)
    {
        $respon =  $this->_client->request('POST', 'lokasi', [
            'form_params' => $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function addGudang($data)
    {
        $respon =  $this->_client->request('POST', 'gudang', [
            'form_params' => $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function addVendor($data)
    {
        $respon =  $this->_client->request('POST', 'vendor', [
            'form_params' => $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function addJenisAudit($data)
    {
        $respon =  $this->_client->request('POST', 'jenisaudit', [
            'form_params' => $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    //-------------------------------------------------UPDATE--------------------------------------------------------//
    public function editUser($data)
    {
        $respon =  $this->_client->request('PUT', 'user', [
            'form_params' =>  $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function UpdatePass($data)
    {
        $respon =  $this->_client->request('PUT', 'userpass', [
            'form_params' =>  $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function UpdateUserGroup($data)
    {
        $respon =  $this->_client->request('PUT', 'usergroup', [
            'form_params' =>  $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function UpdateJenisInv($data)
    {
        $respon =  $this->_client->request('PUT', 'jenisinv', [
            'form_params' =>  $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function UpdateSubInv($data)
    {
        $respon =  $this->_client->request('PUT', 'subinv', [
            'form_params' =>  $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function UpdateStatusInv($data)
    {
        // var_dump($data);die;
        $respon =  $this->_client->request('PUT', 'statusinv', [
            'form_params' =>  $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function UpdatePerusahaan($data)
    {
        $respon =  $this->_client->request('PUT', 'perusahaan', [
            'form_params' =>  $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function UpdateCabang($data)
    {
        $respon =  $this->_client->request('PUT', 'cabang', [
            'form_params' =>  $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function UpdateLokasi($data)
    {
        $respon =  $this->_client->request('PUT', 'lokasi', [
            'form_params' =>  $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function UpdateGudang($data)
    {
        $respon =  $this->_client->request('PUT', 'gudang', [
            'form_params' =>  $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function UpdateVendor($data)
    {
        $respon =  $this->_client->request('PUT', 'vendor', [
            'form_params' =>  $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function UpdateJenisAudit($data)
    {
        $respon =  $this->_client->request('PUT', 'jenisaudit', [
            'form_params' =>  $data

        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    //-------------------------------------------------DELETE--------------------------------------------------------//
    public function delUser($id)
    {
        $respon =  $this->_client->request('DELETE', 'user', [
            'form_params' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public function delUserGroup($id)
    {
        $respon =  $this->_client->request('DELETE', 'usergroup', [
            'form_params' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public function delJenisInv($id)
    {
        $respon =  $this->_client->request('DELETE', 'jenisinv', [
            'form_params' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public function delSubInv($id)
    {
        $respon =  $this->_client->request('DELETE', 'subinv', [
            'form_params' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public function delStatusInv($id)
    {
        $respon =  $this->_client->request('DELETE', 'statusinv', [
            'form_params' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public function delPerusahaan($id)
    {
        $respon =  $this->_client->request('DELETE', 'perusahaan', [
            'form_params' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public function delCabang($id)
    {
        $respon =  $this->_client->request('DELETE', 'cabang', [
            'form_params' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public function delLokasi($id)
    {
        $respon =  $this->_client->request('DELETE', 'lokasi', [
            'form_params' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public function delGudang($id)
    {
        $respon =  $this->_client->request('DELETE', 'gudang', [
            'form_params' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public function delVendor($id)
    {
        $respon =  $this->_client->request('DELETE', 'vendor', [
            'form_params' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return true;
        } else {
            return false;
        }
    }

    public function delJenisAudit($id)
    {
        $respon =  $this->_client->request('DELETE', 'jenisaudit', [
            'form_params' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return true;
        } else {
            return false;
        }
    }

    //-------------------------------------------------KODE OTOMATIS--------------------------------------------------------//

    //------------------------------------------------------KODE2-------------------------------------------------//
    public function buatkodeusergroup()
    {
        $respon =  $this->_client->request('GET', 'usergroupcount');

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }
    public function buatkodejenisinv()
    {
        $respon =  $this->_client->request('GET', 'countjenisinv');

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }
    public function buatkodecabang($id = null)
    {
        $respon =  $this->_client->request('GET', 'countcabang', [
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }



    public function buatkodesubinventory($id = null)
    {
        $respon =  $this->_client->request('GET', 'subinvcount', [
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }

    public function buatkodestatusinventory()
    {
        $respon =  $this->_client->request('GET', 'statusinvcount');

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }

    public function buatkodevendor($id = null)
    {
        $respon =  $this->_client->request('GET', 'vendorcount', [
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }

    public function buatkodejenisaudit()
    {
        $respon =  $this->_client->request('GET', 'jenisauditcount');

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    //---------------------------------------------CARI------------------------------------------------------------//
    public function cariUser($id = null, $offset = null)
    {

        $respon =  $this->_client->request('GET', 'cariuser', [
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

    public function cariUsergroup($id)
    {
        $respon =  $this->_client->request('GET', 'cariusergroup', [
            'query' => [
                'usergroup' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function cariSubInv($subinv, $jenisinv)
    {

        $respon =  $this->_client->request('GET', 'carisubinv', [
            'query' => [
                'subinv' => $subinv,
                'jenisinv' => $jenisinv
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function cariSubJenis($id)
    {
        $respon =  $this->_client->request('GET', 'carisubinv', [
            'query' => [
                'jenisinv' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        // var_dump($result['data'][0]);die;
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function cariSub($id = null, $offset = null)
    {
        $respon =  $this->_client->request('GET', 'carisubinv2', [
            'query' => [
                'id' => $id,
                'offset' => $offset
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        // var_dump($result['data'][0]);die;
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function cariJenisInv($id)
    {
        $respon =  $this->_client->request('GET', 'carijenisinv', [
            'query' => [
                'jenisinv' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        // var_dump($result['data'][0]);die;
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }



    public function cariStatusInv($id)
    {
        $respon =  $this->_client->request('GET', 'caristatusinv', [
            'query' => [
                'statusinv' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        // var_dump($result);die;
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function cariPerusahaan($id = null, $offset = null)
    {
        $respon =  $this->_client->request('GET', 'cariperusahaan', [
            'query' => [
                'perusahaan' => $id,
                'offset' => $offset
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        // var_dump($result['data'][0]);die;
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function cariCabang($id = null, $offset = null)
    {
        $respon =  $this->_client->request('GET', 'caricabang', [
            'query' => [
                'cabang' => $id,
                'offset' => $offset
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        // var_dump($result['data'][0]);die;
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function cariLokasi($id = null, $offset = null)
    {
        $respon =  $this->_client->request('GET', 'carilokasi', [
            'query' => [
                'lokasi' => $id,
                'offset' => $offset
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        // var_dump($result['data'][0]);die;
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function cariVendor($id = null, $offset = null)
    {
        $respon =  $this->_client->request('GET', 'carivendor', [
            'query' => [
                'vendor' => $id,
                'offset' => $offset
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        // var_dump($result['data'][0]);die;
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function cariJenisAudit($id)
    {
        $respon =  $this->_client->request('GET', 'carijenisaudit', [
            'query' => [
                'jenisaudit' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        // var_dump($result['data'][0]);die;
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function countlokasi($id = null)
    {
        $respon =  $this->_client->request('GET', 'countlokasi', [
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        // var_dump($result['data'][0]);die;
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function countgudang($id = null)
    {
        $respon =  $this->_client->request('GET', 'countgudang', [
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        // var_dump($result['data'][0]);die;
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function cekPassword($id)
    {
        $respon =  $this->_client->request('GET', 'userpass', [
            'query' => $id
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
}

/* End of file ModelName.php */
