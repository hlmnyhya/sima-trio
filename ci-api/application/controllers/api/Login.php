<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    require(APPPATH . 'libraries/REST_Controller.php');
    use Restserver\Libraries\REST_Controller;
    class Login extends REST_Controller {
private $_tgl;
function __construct() {
    parent::__construct();
    $this->load->model('master/M_login','mlogin');
    $timezone = time() + (60 * 60 * 8);
    $this->_tgl = gmdate('Y-m-d H:i:s',$timezone);
    ini_set('max_execution_time', 0);

    }

    public function index_get(){
        $id = $this->get('username');
        $password = $this->get('password');
        $pass =$this->get('password');
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$pass);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($pass, $encrypt_method, $key, 0, $iv);
        $password = base64_encode($output);
        if ($id) {
            $login = $this->mlogin->getUserbyid($id);
        }else{
            $this->response([
                'status' => false,
                'data' => 'need id'
            ], REST_Controller::HTTP_OK);
        }

        if ($login) {
            foreach($login as $l){
                $pass= $l->password;
                $username = $l->username;
            }
            if ($pass == $password) {
                $data=[
                    'username' => $username,
                    'tanggal' => $this->_tgl,
                    'keterangan' => 'Logged In.'
                ];
                $history = $this->mlogin->history($data);
                $this->response([
                    'status' => true,
                    'data' => $login
                ], REST_Controller::HTTP_OK);
            }else{
                $data=[
                    'username' => $username,
                    'tanggal' => $this->_tgl,
                    'keterangan' => 'Failed Login.'
                ];
                $history = $this->mlogin->history($data);
                $this->response([
                    'status' => false,
                    'data' => 'Username Or Password Invalid. ',
                ], REST_Controller::HTTP_OK);
            }
        }else {
            $this->response([
                'status' => false,
                'data' => 'Username Or Password Invalid.'
            ], REST_Controller::HTTP_OK);
        }
    }
}
/** End of file Login.php **/