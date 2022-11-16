<?php

use GuzzleHttp\Client;

defined('BASEPATH') or exit('No direct script access allowed');

class M_Menu extends CI_Model
{
    private $_client;


    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => SERVER_BASE . 'api/master/'
        ]);
    }


    public function getMenu($access = null)
    {
        $respon = $this->_client->request('GET', 'menu', [
            'query' => [
                'access' => $access
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }


    public function SubMenu($id_menu = null)
    {
        $respon = $this->_client->request('GET', 'submenu', [
            'query' => [
                'id' => $id_menu,
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function delMenuAkses($id)
    {
        $respon =  $this->_client->request('DELETE', 'menuakses', [
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
    public function addMenuAkses($data)
    {
        $respon =  $this->_client->request('POST', 'menuakses', [
            'form_params' => $data
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return true;
        } else {
            return false;
        }
    }
    public function MenuAkses($id = null, $ug = null)
    {
        $respon = $this->_client->request('GET', 'carimenuakses', [
            'query' => [
                'id' => $id,
                'offset' => $ug,
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function getMenubyAkses($id = null, $ug = null)
    {
        $respon = $this->_client->request('GET', 'menuakses', [
            'query' => [
                'id' => $id,
                'usergroup' => $ug,
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function countmenuakses($id = null)
    {
        $respon =  $this->_client->request('GET', 'countmenuakses', [
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
}

/* End of file ModelName.php */
