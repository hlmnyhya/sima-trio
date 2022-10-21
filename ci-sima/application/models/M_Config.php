<?php


use GuzzleHttp\Client;
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Config extends CI_Model {
    private $_client;
    public function __construct()
        {
            parent::__construct();
            $this->_client = new Client([
                'base_uri'=> SERVER_BASE.'api/config/'
            ]);
        }

        public function getConfig()
        {
            $respon =  $this->_client->request('GET', 'config');
    
            $result = json_decode($respon->getBody()->getContents(),true);
    
            return $result['data'];              
        }

        public function UpdateUserConfig($data)
        {
            $respon =  $this->_client->request('PUT', 'config',[
            'form_params'=>  $data
            ]);

            $result = json_decode($respon->getBody()->getContents(),true);

            if ($result['status']==true) {
                return $result['data']; 
            }else{
                return false;
            }

        }

         

/* End of file M_Config.php */
    }