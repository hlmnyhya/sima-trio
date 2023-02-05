<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Fpdf\Fpdf;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan_GA extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        ini_set('max_execution_time', 0);
        $this->load->model('m_laporan_GA', 'mlapga');
        $this->load->model('m_laporan_auditor', 'mlapaudit');
        $this->load->model('m_transaksi_auditor', 'mtransaudit');
        $this->load->model('m_master_data', 'mmasdat');
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
    public function lap_audit_ga()
    {
        $data = [
            'judul' => 'Laporan Audit GA',
            'judul1' => 'Laporan GA',
            'tgl' => date('m/d/Y'),
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
    public function cetakInv()
    {
        $tgl = date('Ymd');
        $id = $this->input->post('idtransaksi_inv');
        $cabang = $this->input->post('cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $kacab = $this->input->post('kacab');
        $tempat = $this->input->post('tempat');
        $counter = $this->input->post('counter');
        $auditor = $this->input->post('auditor');
        $tgl_awal = '';
        $tgl_akhir = '';

        $start = 0;
        $cetak = $this->mlapga->cetakga($cabang, $id, $start);
        // var_dump($cetak);
        // exit();
        if ($cetak != null) {
            $tgl_awal = date('Y-m-d');
            $tgl_akhir = '1900-01-01';
            foreach ($cetak as $c) {
                if ($tgl_awal > $c['tanggal_barang_diterima']) {
                    $tgl_awal = $c['tanggal_barang_diterima'];
                }

                if ($tgl_akhir < $c['tanggal_barang_diterima']) {
                    $tgl_akhir = $c['tanggal_barang_diterima'];
                }
            }
            // var_dump($cetak);
            // exit();
            $tgl = $tgl_awal . ' s/d ' . $tgl_akhir;

            $pdf = new reportProduct();
            $pdf->setKriteria('report3');
            $pdf->setNama('General Affair');
            $pdf->AliasNbPages();
            $pdf->AddPage('P', 'A4');
            $pdf->SetFont('Times', 'B', '10');
            $pdf->Cell(0, 30, 'Kertas Kerja Audit', 0, 1, 'L');
            $pdf->SetFont('Times', '', '10');
            $pdf->SetXY(120, 34);
            $pdf->cell(0, 0, 'Auditee', 0, 1);
            $pdf->SetXY(152, 34);
            $pdf->cell(0, 0, ': Office', 0, 1);
            $pdf->SetXY(120, 39);
            $pdf->cell(0, 0, 'Periode Pelaksanaan', 0, 1);
            $pdf->SetXY(152, 39);
            $pdf->cell(0, 0, ': ' . $tgl, 0, 1);
            $pdf->SetXY(120, 44);
            $pdf->cell(0, 0, 'Auditor', 0, 1);
            $pdf->SetXY(152, 44);
            $pdf->cell(0, 0, ': ' . $auditor, 0, 1);
            $pdf->SetXY(120, 49);
            $pdf->cell(0, 0, 'Di-review Oleh', 0, 1);
            $pdf->SetXY(152, 49);
            $pdf->cell(0, 0, ': ', 0, 1);
            $pdf->ln();
            $pdf->SetY(55);
            $pdf->SetLineWidth(0.1);
            $pdf->SetFillColor(0, 186, 242);
            $pdf->SetFont('Times', 'B', 6);

            $pdf->Cell(40, 5, 'Hasil Audit', 0, 1);
            $pdf->Cell(8, 15, 'No', 1, 0, 'C', true);
            $pdf->Cell(30, 15, 'TRANSAKSI', 1, 0, 'C', true);
            $pdf->Cell(20, 15, 'JENIS', 1, 0, 'C', true);
            $pdf->Cell(20, 15, 'SUB INVENTORY', 1, 0, 'C', true);
            $pdf->Cell(20, 15, 'NILAI AWAL', 1, 0, 'C', true);
            $pdf->Cell(20, 15, 'TANGGAL', 1, 0, 'C', true);
            $pdf->Cell(20, 15, 'VENDOR', 1, 0, 'C', true);
            $pdf->Cell(20, 15, 'PEMBAYARAN', 1, 0, 'C', true);
            $pdf->Cell(20, 15, 'LOKASI', 1, 0, 'C', true);
            $pdf->Cell(20, 15, 'KETERANGAN', 1, 1, 'C', true);
            $start = null;

            $no = 1;
            $pdf->SetFont('Times', '', 6);
            foreach ($cetak as $c) {
                $x = $pdf->GetX();
                $pdf->myCell(8, 6, $x, $no, 'C');
                $x = $pdf->GetX();
                $pdf->myCell(30, 6, $x, $c['idtransaksi_inv']);
                $x = $pdf->GetX();
                $pdf->myCell(20, 6, $x, $c['jenis_inventory']);
                $x = $pdf->GetX();
                $pdf->myCell(20, 6, $x, $c['sub_inventory']);
                $x = $pdf->GetX();
                $pdf->myCell(20, 6, $x, $c['nilai_awal']);
                $x = $pdf->GetX();
                $pdf->myCell(20, 6, $x, $c['tanggal_barang_diterima']);
                $x = $pdf->GetX();
                $pdf->myCell(20, 6, $x, $c['nama_vendor']);
                $x = $pdf->GetX();
                $pdf->myCell(20, 6, $x, $c['jenis_pembayaran']);
                $x = $pdf->GetX();
                $pdf->myCell(20, 6, $x, $c['nama_lokasi']);
                $x = $pdf->GetX();
                $pdf->myCell(20, 6, $x, $c['keterangan']);
                $pdf->ln();
                $no++;
            }
            $pdf->Ln(5);
            $pdf->SetLineWidth(0.15);
            $tgl_now = date('d F Y');
            $pdf->cell(0, 6, $tempat . ' , ' . $tgl_now, 0, 1);
            $pdf->cell(50, 8, 'Diperiksa Oleh,', 1, 0, 'C');
            $pdf->cell(50, 8, 'Diverifikasi oleh,', 1, 0, 'C');
            $pdf->cell(50, 8, 'Diketahui oleh,', 1, 1, 'C');
            $pdf->cell(50, 30, '', 1, 0, 'C');
            $pdf->cell(50, 30, '', 1, 0, 'C');
            $pdf->cell(50, 30, '', 1, 1, 'C');
            $pdf->cell(50, 5, $auditor, 1, 0, 'C');
            $pdf->cell(50, 5, $counter, 1, 0, 'C');
            $pdf->cell(50, 5, $kacab, 1, 1, 'C');
            $pdf->cell(50, 5, 'Auditor', 1, 0, 'C');
            $pdf->cell(50, 5, 'PDI/PIC Gudang', 1, 0, 'C');
            $pdf->cell(50, 5, 'Kepala Cabang', 1, 1, 'C');
            $pdf->Output('D', 'REPORTOFFICE-' . $tgl . '.pdf');
            $pdf->Output();
        } else {
            redirect('laporan_ga/lap_audit_ga', 'refresh');
        }
    }
}

/* End of file Laporan_GA.php */
