<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_GA extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        ini_set('max_execution_time', 0);
        $this->load->model('m_laporan_GA', 'mlapga');
        if (!$this->session->userdata('username')) {

            redirect('login/login');
        } else {
            if ($this->session->userdata('usergroup') == 'UG005' || $this->session->userdata('usergroup') == 'UG001') {
            } else {
                redirect('error');
            }
        }
    }

    public function viewLaporanOffice()
    {
        $data = [
            'judul' => "Laporan Inventory Office",
            'judul1' => 'Laporan GA'
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('general_affairview/laporan_office/v_laporan_inv.php', $data);
        $this->load->view('general_affairview/_partial/footer.php');
    }

    public function filterCabang()
    {
        $this->load->view('general_affairview/perusahaan/v_input_perusahaan.php');
        $this->load->view('general_affairview/perusahaan/_partial/footer2.php');
    }
}

/* End of file Laporan_GA.php */
