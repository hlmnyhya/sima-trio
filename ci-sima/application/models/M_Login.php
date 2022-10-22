<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use GuzzleHttp\Client;
class M_Login extends CI_Model {

    private $_client;
    public function __construct()
        {
            parent::__construct();
            $this->_client = new Client([
                'base_uri'=> SERVER_BASE.'api/'
            ]);
        }

    public function login($username,$password)
    {
        $respon =  $this->_client->request('GET', 'login',[
            'query'=>[
                'username'=>$username,
                'password'=>$password
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(),true);

        return $result;  
    }
    

}

/* End of file M_Login.php */

?>