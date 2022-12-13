<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_GA extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        ini_set('max_execution_time', 0);
        $this->load->model('m_laporan_GA', 'mlapga');
        $_tgl = date('Y-m-d');

        if (!$this->session->userdata('username')) {
            redirect('login/login');
        } else {
            if (
                $this->session->userdata('usergroup') == 'UG005' ||
                $this->session->userdata('usergroup') == 'UG001'
            ) {
            } else {
                redirect('error');
            }
        }
    }

    public function viewLaporanOffice()
    {
        $data = [
            'judul' => 'Laporan Inventory Office',
            'judul1' => 'Laporan GA',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'general_affairview/laporan_office/v_laporan_inv.php',
            $data
        );
        $this->load->view(
            'general_affairview/laporan_office/_partial/footer.php'
        );
    }

    public function filterCabang()
    {
        $this->load->view(
            'general_affairview/perusahaan/v_input_perusahaan.php'
        );
        $this->load->view('general_affairview/perusahaan/_partial/footer2.php');
    }

    public function search()
    {
        $id = $this->input->post('id');
        $count = $this->mtransga->getCountInv($id);
        $this->load->library('pagination');

        $config['base_url'] =
            base_url() . 'transaksi_auditor/ajax_get_Inventory';
        $config['total_rows'] = $count;
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = true;
        $config['num_links'] = 3;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] =
            '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] =
            '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] =
            '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;&nbsp;';
        $config['prev_tag_open'] =
            '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] =
            '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] =
            '<li class="page-item"><span class="page-link">';
        $config['cur_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = $this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        $start = ($page - 1) * $config['per_page'];
        if ($id) {
            $listinv = $this->mtransga->cariinv($id, $start);
        } else {
            $listinv = null;
        }
        $no = 0;
        $output = '';
        if ($listinv) {
            foreach ($listinv as $list) {
                $tgl = strtotime($list['tanggal_barang_diterima']);
                if ($tgl != 0) {
                    $tgl = date('d M Y', $tgl);
                }
                $start++;
                $output .=
                    '
                 <tr>
                    <td>' .
                    $start .
                    '</td>
                    <td class="tooltip-demo">
                    <a href="' .
                    base_url() .
                    'transaksi/editoffice?id=' .
                    $list['idtransaksi_inv'] .
                    '" class="text-warning"><i class="fa fa-fw fa-pencil"></i></a>
                    <a id="' .
                    $list['idtransaksi_inv'] .
                    '" class="text-danger"><i class="fa fa-fw fa-trash"></i></a>
                    <a href="' .
                    base_url() .
                    'transaksi/detail?id=' .
                    $list['idtransaksi_inv'] .
                    '" class="text-blue" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-fw fa-eye"></i></a>
                    </td>
                    <td>' .
                    $list['idtransaksi_inv'] .
                    '</td>
                    <td>' .
                    $list['jenis_inventory'] .
                    '</td>
                    <td>' .
                    $list['sub_inventory'] .
                    '</td>
                    <td>' .
                    $list['nilai_awal'] .
                    '</td>
                    <td>' .
                    $tgl .
                    '</td>
                    <td>' .
                    $list['nama_vendor'] .
                    '</td>
                    <td>' .
                    $list['jenis_pembayaran'] .
                    '</td>
                    <td>' .
                    $list['nama_lokasi'] .
                    '</td>
                    <td>' .
                    $list['nama_pengguna'] .
                    '</td>               
                    <td>' .
                    $list['keterangan'] .
                    '</td>
                     
                 </tr>
               ';
            }
        } else {
            $output .= '
            <tr><td colspan="13" class="text-center">data not found</td></tr>
            ';
        }
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }

    public function cetaklaporan()
    {
        $cabang = $this->input->post('cabang');
        $tgl = $this->input->post('tgl');
        $tgl2 = $this->input->post('tgl2');
        $data = [
            'judul' => 'Laporan Inventory Office',
            'judul1' => 'Laporan GA',
            'cabang' => $cabang,
            'tgl' => $tgl,
            'tgl2' => $tgl2,
        ];
        $this->load->view(
            'general_affairview/laporan_office/v_laporan_inv.php',
            $data
        );
    }
}

/* End of file Laporan_GA.php */
