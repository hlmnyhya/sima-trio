<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        ini_set('max_execution_time', 0);
        $this->load->model('m_login', 'mlogin');
    }
    public function sima_login()
    {
        if ($this->session->userdata('username')) {

            redirect('dashboard');
        }
        $data['judul'] = 'Login';
        $this->load->view('v_login', $data);
    }

    public function login()
    {
        if ($this->session->userdata('username')) {

            redirect('dashboard');
        }
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $login = $this->mlogin->login($username, $password);

        if ($login['status'] == true) {
            foreach ($login['data'] as $log) {
                $data = [
                    'nama' => $log['nama'],
                    'username' => $username,
                    'usergroup' => $log['id_usergroup'],
                    'nik' => $log['nik'],
                    'perusahaan' => $log['nama_perusahaan'],
                    'cabang' => $log['nama_cabang'],
                    'id_cabang' => $log['id_cabang'],
                    'lokasi' => $log['nama_lokasi'],
                    'status' => $log['status']
                ];
                // var_dump($data);die;
                $this->session->set_userdata($data);
                // var_dump($log['id_usergroup']);
                // if ($log['id_usergroup']=='UG005') {
                // $this->session->set_flashdata("pesan",'Login Berhasil');
                // redirect('config/config');
                // }else{
                $this->session->set_flashdata("pesan", 'Login Berhasil');
                redirect('dashboard');
                // }

            }
        } else {
            $this->session->set_flashdata("pesan", '<div class="alert alert-danger">Login Gagal !</div>');
            Redirect('login/sima_login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('usergroup');
        

        $this->session->set_flashdata('pesan', '<div class="alert alert-success ">Anda Telah <b>Log Out</b>. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
        Redirect('login/sima_login');
        session_destroy();
    }
}

/* End of file Controllername.php */
