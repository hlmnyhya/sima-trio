<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Config extends CI_Controller
{


    public function __construct()
    {
        ini_set('max_execution_time', 0);
        parent::__construct();
        $this->load->model('m_config', 'mconfig');
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Login Dulu!</div>');

            redirect('login/sima_login');
        } else {
            if ($this->session->userdata('usergroup') == 'UG005') {
            } else {
                redirect('error');
            }
        }
    }

    public function Config()
    {

        $data = [
            'judul' => 'Setup Database',
            'tampil' => $this->mconfig->getConfig()
        ];
        $this->load->view('_partial/header', $data);
        $this->load->view('_partial/sidebar', $data);
        $this->load->view('config_data/v_config', $data);
        $this->load->view('_partial/footer', $data);
        // $this->load->view('config_data/v_config', $data);


    }

    public function put_config()
    {
        $data = [
            'id'    => $this->input->post('id', true),
            'ip'        => $this->input->post('ip', true),
            'username'  => $this->input->post('username', true),
            'password'  => $this->input->post('password', true),
            'db'  => $this->input->post('db', true),
        ];
        if($data['id']==null){
            $this->session->set_flashdata('warning', 'tidak ada');
            redirect('config/config');
        }else{
            $exec = $this->mconfig->UpdateUserConfig($data);
            if ($exec) {
                $this->session->set_flashdata('berhasil', 'berhasil diupdate');
                redirect('config/config');
            } else {
                $this->session->set_flashdata('gagal', 'gagal diupdate');
                redirect('config/config');
            }

        }
    }
}

/* End of file Config.php */
