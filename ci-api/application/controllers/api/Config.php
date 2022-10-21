<?php


defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'libraries/REST_Controller.php');
    use Restserver\Libraries\REST_Controller;
    class Config extends REST_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('config/m_config','mconfig');
        
        ini_set('max_execution_time', 0);
        
    }
    

    public function Config_post()
    {
        $ip =$this->post('ip',true);
        $ip2 = 'IPADDRESS';
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$ip2);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($ip, $encrypt_method, $key, 0, $iv);
        $ipaddress = base64_encode($output);

        $uname =$this->post('username',true);
        $uname2= 'USERNAME';
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$uname2);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($uname, $encrypt_method, $key, 0, $iv);
        $username = base64_encode($output);

        $pass =$this->post('password',true);
        $pass2 = 'PASSWORD';
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$pass2);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($pass, $encrypt_method, $key, 0, $iv);
        $password = base64_encode($output);

        $db =$this->post('db',true);
        $db2 = 'DATABASE';
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$db2);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($db, $encrypt_method, $key, 0, $iv);
        $database = base64_encode($output);
        $data=[
                'id' =>'1',
                'ip' => $ipaddress,
                'username' => $username,
                'password' => $password,
                'db' => $database
        ];
    
            if ($this->mconfig->AddUserConfig($data)>0) {
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


    public function Config_get()
    {
        $config= $this->mconfig->getUserConfig();

        if ($config) {
            $this->response([
                'status' => true,
                'data' => $config
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Config_put()
    {
        $id = $this->put('id');
        $ip =$this->put('ip',true);
        $ip2 = 'IPADDRESS';
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$ip2);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($ip, $encrypt_method, $key, 0, $iv);
        $ipaddress = base64_encode($output);

        $uname =$this->put('username',true);
        $uname2= 'USERNAME';
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$uname2);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($uname, $encrypt_method, $key, 0, $iv);
        $username = base64_encode($output);

        $pass =$this->put('password',true);
        $pass2 = 'PASSWORD';
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$pass2);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($pass, $encrypt_method, $key, 0, $iv);
        $password = base64_encode($output);

        $db =$this->put('db',true);
        $db2 = 'DATABASE';
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$db2);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($db, $encrypt_method, $key, 0, $iv);
        $database = base64_encode($output);
        $data=[
                
                'ip' => $ipaddress,
                'username' => $username,
                'password' => $password,
                'db' => $database
        ];

        if ($this->mconfig->editUserConfig($id, $data)) {
            $this->response([
                'status' => true,
                'data' => "Config has been modified"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => "Failed."
            ], REST_Controller::HTTP_OK);
            
        }
    }


}

/* End of file Controllername.php */
