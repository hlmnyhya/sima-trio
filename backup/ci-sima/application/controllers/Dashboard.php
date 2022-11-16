<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        ini_set('max_execution_time', 0);
        parent::__construct();
        $this->load->model('m_dashboard', 'mdashboard');
        $this->load->model('m_transaksi_auditor', 'mtransauditor');
        $this->load->model('m_transaksi_GA', 'mtransga');
        $this->load->model('m_master_data', 'mmasdat');

        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Login Dulu!</div>');
            redirect('login/sima_login');
        }
    }

    public function index()
    {
        $data['judul'] = 'Dashboard';
        $data['user'] = $this->mmasdat->countuser();
        $data['usergroup'] = $this->mmasdat->buatkodeusergroup();
        $data['auditunit'] = $this->mtransauditor->countunit1();
        $data['auditpart'] = $this->mtransauditor->countpart1(null);
        $data['inventory'] = $this->mtransga->getcountInv();
        $data['cabang'] = $this->mmasdat->buatkodecabang();

        // var_dump($data);
        // die;
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('v_dashboard', $data);
        $this->load->view('_partial/footer.php');
    }
    public function change()
    {
        $data['judul'] = 'Change Password';
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('v_changepass.php', $data);
        $this->load->view('_partial/footer.php');
    }
    public function post_change()
    {
        $data = [
            'id'   => $this->session->userdata('nik'),
            'password'   => $this->input->post('newpass', true),
        ];

        $valid = [
            'id'   => $this->session->userdata('nik'),
            'password'   => $this->input->post('currpass', true),
        ];
        $id = $this->mmasdat->cekPassword($valid);
        if ($id) {
            $exec = $this->mmasdat->UpdatePass($data);
            if ($exec) {
                $this->session->set_flashdata('berhasil', 'berhasil diupdate');
                redirect('dashboard/change');
            } else {
                $this->session->set_flashdata('gagal', 'gagal diupdate');
                redirect('dashboard/change');
            }
        } else {
            $this->session->set_flashdata('warning', 'Current Password Wrong');
            redirect('dashboard/change');
        }
    }
}

/* End of file Dashboard.php */
