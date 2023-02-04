<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Fpdf\Fpdf;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class laporan_auditor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        ini_set('max_execution_time', 0);
        $this->load->model('m_laporan_auditor', 'mlapaudit');
        $this->load->model('m_transaksi_auditor', 'mtransaudit');
        $this->load->model('m_master_data', 'mmasdat');

        if (!$this->session->userdata('username')) {
            redirect('login/login');
        } else {
            if (
                $this->session->userdata('usergroup') == 'UG002' ||
                $this->session->userdata('usergroup') == 'UG003' ||
                $this->session->userdata('usergroup') == 'UG005'
            ) {
            } else {
                redirect('error');
            }
        }
    }

    public function Laporan_Unit()
    {
        $data = [
            'judul' => 'Audit Data Unit',
            'judul1' => 'Laporan Auditor',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'auditorview/laporan_unit/v_filter_kondisi.php',
            $data
        );
        $this->load->view('auditorview/laporan_unit/_partial/footer.php');
    }
    public function Laporan_Part()
    {
        $data = [
            'judul' => 'Audit Data Part',
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'auditorview/laporan_part/v_filter_kondisi_part.php',
            $data
        );
        // $this->load->view('auditorview/laporan_part/v_laporan_part.php', $data);
        $this->load->view('auditorview/laporan_part/_partial/footer.php');
    }
    public function cetak()
    {
        $tgl = date('Ymd');
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $kacab = $this->input->post('kacab');
        $tempat = $this->input->post('tempat');
        $counter = $this->input->post('counter');
        $auditor = $this->input->post('auditor');

        $cab = $this->mlapaudit->getCabangbyId($cabang);
        foreach ($cab as $c) {
            $cab = $c['nama_cabang'];
        }
        $start = 0;
        $cetak = $this->mlapaudit->auditPdf($cabang, $idjadwal_audit, $start);
        if ($cetak != null) {
            $tgl_awal = date('Y-m-d');
            $tgl_akhir = '1900-01-01';
            foreach ($cetak as $c) {
                if ($tgl_awal > $c['tanggal_audit']) {
                    $tgl_awal = $c['tanggal_audit'];
                }

                if ($tgl_akhir < $c['tanggal_audit']) {
                    $tgl_akhir = $c['tanggal_audit'];
                }
            }

            $pdf = new reportProduct();
            $pdf->setKriteria('report2');
            $pdf->setNama($cab);
            $pdf->AliasNbPages();
            $pdf->AddPage('P', 'A4');
            $pdf->SetFont('Times', 'B', '16');
            $pdf->Cell(0, 30, 'Kertas Kerja Audit', 0, 1, 'L');
            $pdf->SetFont('Times', '', '10');
            $pdf->SetXY(120, 34);
            $pdf->cell(0, 0, 'Auditee', 0, 1);
            $pdf->SetXY(152, 34);
            $pdf->cell(0, 0, ': Unit SMH (H1)', 0, 1);
            $pdf->SetXY(120, 39);
            $pdf->cell(0, 0, 'Periode Pelaksanaan', 0, 1);
            //$tgl = strtotime($cetak['periode']);
            //$tgl = date('d F Y', $tgl);
            $tgl = $tgl_awal . ' s/d ' . $tgl_akhir;
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
            $pdf->SetFont('Times', 'B', 10);

            $pdf->Cell(10, 5, 'Hasil Audit', 0, 1);
            $pdf->Cell(8, 15, 'No', 1, 0, 'C', true);
            $pdf->Cell(25, 15, 'No Mesin', 1, 0, 'C', true);
            $pdf->Cell(28, 15, 'No Rangka', 1, 0, 'C', true);
            $pdf->Cell(27, 15, 'Type Unit', 1, 0, 'C', true);
            $pdf->Cell(20, 15, 'Umur Unit', 1, 0, 'C', true);
            $pdf->Cell(35, 15, 'Lokasi', 1, 0, 'C', true);
            $pdf->Cell(25, 15, 'Status Unit', 1, 0, 'C', true);
            $pdf->Cell(25, 15, 'Keterangan', 1, 1, 'C', true);
            $start = null;
            $cetak = $this->mlapaudit->auditPdf(
                $cabang,
                $idjadwal_audit,
                $start
            );
            $no = 1;
            $pdf->SetFont('Times', '', 8);
            foreach ($cetak as $c) {
                $x = $pdf->GetX();
                $pdf->myCell(8, 7, $x, $no);
                $x = $pdf->GetX();
                $pdf->myCell(25, 7, $x, $c['no_mesin']);
                $x = $pdf->GetX();
                $pdf->myCell(28, 7, $x, $c['no_rangka']);
                $x = $pdf->GetX();
                $pdf->myCell(27, 7, $x, $c['type']);
                $x = $pdf->GetX();
                $pdf->myCell(
                    20,
                    7,
                    $x,
                    $c['umur_unit'] == '' ? '-' : $c['umur_unit'] . ' tahun'
                );
                $x = $pdf->GetX();
                $pdf->myCell(35, 7, $x, $c['nama_gudang']);
                $x = $pdf->GetX();
                $pdf->myCell(25, 7, $x, $c['status_unit']);
                $x = $pdf->GetX();
                $pdf->myCell(25, 7, $x, $c['keterangan']);
                $pdf->ln();

                $no++;
            }
            // foreach ($cetak as $c ) {
            //         $pdf->Cell(8,7,$no,1,0, 'C');
            //         $pdf->Cell(25,7,$c['no_mesin'],1,0);
            //         $pdf->Cell(28,7,$c['no_rangka'],1,0);
            //         $pdf->Cell(27,7,$c['type'],1,0);
            //         $pdf->Cell(20,7,$c['umur_unit'],1,0,'C');
            //         $pdf->Cell(25,7,$c['nama_lokasi'],1,0);
            //         $pdf->Cell(25,7,$c['status_unit'],1,0);
            //         $pdf->Cell(25,7,$c['keterangan'],1,1);

            //         $no++;
            //     }
            $pdf->Ln(5);
            $pdf->SetLineWidth(0.05);
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
            $pdf->cell(50, 5, 'Counter', 1, 0, 'C');
            $pdf->cell(50, 5, 'Kepala Cabang', 1, 1, 'C');
            $pdf->Output('D', 'REPORTUNIT-' . $tgl . '.pdf');
            // $pdf->Output();
        } else {
            redirect('laporan_auditor/lap_audit_unit', 'refresh');
        }
    }

    public function cetakunittemp()
    {
        $tgl = date('Ymd');
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $kacab = $this->input->post('kacab');
        $tempat = $this->input->post('tempat');
        $counter = $this->input->post('counter');
        $auditor = $this->input->post('auditor');

        $cab = $this->mlapaudit->getCabangbyId($cabang);
        foreach ($cab as $c) {
            $cab = $c['nama_cabang'];
        }
        $start = 0;
        $cetak = $this->mlapaudit->auditPdf($cabang, $idjadwal_audit, $start);
        if ($cetak != null) {
            $tgl_awal = date('Y-m-d');
            $tgl_akhir = '1900-01-01';
            foreach ($cetak as $c) {
                if ($tgl_awal > $c['tanggal_audit']) {
                    $tgl_awal = $c['tanggal_audit'];
                }

                if ($tgl_akhir < $c['tanggal_audit']) {
                    $tgl_akhir = $c['tanggal_audit'];
                }
            }

            $pdf = new reportProduct();
            $pdf->setKriteria('report2');
            $pdf->setNama($cab);
            $pdf->AliasNbPages();
            $pdf->AddPage('P', 'A4');
            $pdf->SetFont('Times', 'B', '16');
            $pdf->Cell(0, 30, 'Kertas Kerja Audit', 0, 1, 'L');
            $pdf->SetFont('Times', '', '10');
            $pdf->SetFont('Times', 'B', 10);
            $pdf->ln();
            $pdf->SetY(55);
            $pdf->SetLineWidth(0.1);
            $pdf->SetFillColor(0, 186, 242);
            $pdf->SetFont('Times', 'B', 10);

            $pdf->Cell(10, 5, 'Hasil Audit Sementara', 0, 1);
            $pdf->Cell(8, 15, 'No', 1, 0, 'C', true);
            $pdf->Cell(25, 15, 'No Mesin', 1, 0, 'C', true);
            $pdf->Cell(28, 15, 'No Rangka', 1, 0, 'C', true);
            $pdf->Cell(27, 15, 'Type Unit', 1, 0, 'C', true);
            $pdf->Cell(20, 15, 'Umur Unit', 1, 0, 'C', true);
            $pdf->Cell(35, 15, 'Lokasi', 1, 0, 'C', true);
            $pdf->Cell(25, 15, 'Status Unit', 1, 0, 'C', true);
            $pdf->Cell(25, 15, 'Keterangan', 1, 1, 'C', true);
            $start = null;
            $cetak = $this->mlapaudit->auditPdf(
                $cabang,
                $idjadwal_audit,
                $start
            );
            $no = 1;
            $pdf->SetFont('Times', '', 8);
            foreach ($cetak as $c) {
                $x = $pdf->GetX();
                $pdf->myCell(8, 7, $x, $no);
                $x = $pdf->GetX();
                $pdf->myCell(25, 7, $x, $c['no_mesin']);
                $x = $pdf->GetX();
                $pdf->myCell(28, 7, $x, $c['no_rangka']);
                $x = $pdf->GetX();
                $pdf->myCell(27, 7, $x, $c['type']);
                $x = $pdf->GetX();
                $pdf->myCell(
                    20,
                    7,
                    $x,
                    $c['umur_unit'] == '' ? '-' : $c['umur_unit'] . ' tahun'
                );
                $x = $pdf->GetX();
                $pdf->myCell(35, 7, $x, $c['nama_gudang']);
                $x = $pdf->GetX();
                $pdf->myCell(25, 7, $x, $c['status_unit']);
                $x = $pdf->GetX();
                $pdf->myCell(25, 7, $x, $c['keterangan']);
                $pdf->ln();

                $no++;
            }
            // foreach ($cetak as $c ) {
            //         $pdf->Cell(8,7,$no,1,0, 'C');
            //         $pdf->Cell(25,7,$c['no_mesin'],1,0);
            //         $pdf->Cell(28,7,$c['no_rangka'],1,0);
            //         $pdf->Cell(27,7,$c['type'],1,0);
            //         $pdf->Cell(20,7,$c['umur_unit'],1,0,'C');
            //         $pdf->Cell(25,7,$c['nama_lokasi'],1,0);
            //         $pdf->Cell(25,7,$c['status_unit'],1,0);
            //         $pdf->Cell(25,7,$c['keterangan'],1,1);

            //         $no++;
            //     }
            $pdf->Output('D', 'REPORTUNIT-SEMENTARA-' . $tgl . '.pdf');
            // $pdf->Output();
        } else {
            redirect('transaksi/audit_unit', 'refresh');
        }
    }

    public function cetakexcel()
    {
        $excel = new Spreadsheet();
        $tgl = date('Ymd');
        $type = $this->input->post('type');
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $status = $this->input->post('status');

        $tgl_awal = date('Y-m-d');
        $tgl_akhir = '1900-01-01';
        $cetak = $this->mlapaudit->cetakUnit($cabang, $idjadwal_audit, $status);
        if ($cetak) {
            foreach ($cetak as $c) {
                if ($tgl_akhir < $c['tanggal_audit']) {
                    $tgl_akhir = $c['tanggal_audit'];
                }
                if ($tgl_awal > $c['tanggal_audit']) {
                    $tgl_awal = $c['tanggal_audit'];
                }
            }

            if ($type == 'excel') {
                $style_col = [
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' =>
                            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' =>
                            \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'top' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'right' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'left' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'bottom' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];

                $style_row = [
                    'alignment' => [
                        'horizontal' =>
                            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' =>
                            \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'top' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'right' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'left' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'bottom' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                $cab = $this->mlapaudit->getCabangbyId($cabang);
                foreach ($cab as $c) {
                    $cab = $c['nama_cabang'];
                }
                $excel
                    ->getActiveSheet()
                    ->getPageSetup()
                    ->setPaperSize(
                        \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4
                    );
                $excel
                    ->getActiveSheet()
                    ->getPageSetup();
                    // ->setRowsToRepeatAtTop('A5');

                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'LHA AUDIT UNIT' . strtoupper($status));
                $excel->getActiveSheet()->mergeCells('A1:H1');
                $excel
                    ->getActiveSheet()
                    ->getStyle('A1')
                    ->getFont()
                    ->setBold(true);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A1')
                    ->getFont()
                    ->setSize(14);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A1')
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    );

                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('A2', 'CABANG ' . $cab);
                $excel->getActiveSheet()->mergeCells('A2:H2');
                $excel
                    ->getActiveSheet()
                    ->getStyle('A2')
                    ->getFont()
                    ->setBold(true);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A2')
                    ->getFont()
                    ->setSize(14);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A2')
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    );

                $excel->setActiveSheetIndex(0)->setCellValue('A5', 'NO.');
                $excel->setActiveSheetIndex(0)->setCellValue('B5', 'NO. MESIN');
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('C5', 'NO. RANGKA');
                $excel->setActiveSheetIndex(0)->setCellValue('D5', 'KODE ITEM');
                $excel->setActiveSheetIndex(0)->setCellValue('E5', 'TYPE UNIT');
                $excel->setActiveSheetIndex(0)->setCellValue('F5', 'USIA UNIT');
                $excel->setActiveSheetIndex(0)->setCellValue('G5', 'LOKASI');
                $excel->setActiveSheetIndex(0)->setCellValue('H5', 'SFTATUS');

                $excel
                    ->getActiveSheet()
                    ->getStyle('A5')
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('B5')
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('C5')
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('D5')
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('E5')
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('F5')
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('G5')
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('H5')
                    ->applyFromArray($style_col);

                $no = 1;
                $seri = 6;

                foreach ($cetak as $c) {
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('A' . $seri, $no);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('B' . $seri, $c['no_mesin']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('C' . $seri, $c['no_rangka']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('D' . $seri, $c['kode_item']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('E' . $seri, $c['type']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('F' . $seri, $c['umur_unit']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('G' . $seri, $c['nama_gudang']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue(
                            'H' . $seri,
                            strtoupper($c['status_unit'])
                        );

                    $excel
                        ->getActiveSheet()
                        ->getStyle('A' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('B' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('C' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('D' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('E' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('F' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('G' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('H' . $seri)
                        ->applyFromArray($style_row);

                    $no++;
                    $seri++;
                }

                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'A3',
                        'PERIODE ' . $tgl_awal . ' s/d ' . $tgl_akhir
                    );
                $excel->getActiveSheet()->mergeCells('A3:H3');
                $excel
                    ->getActiveSheet()
                    ->getStyle('A3')
                    ->getFont()
                    ->setBold(true);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A3')
                    ->getFont()
                    ->setSize(14);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A3')
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    );

                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setWidth(5);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('B')
                    ->setWidth(20);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setWidth(25);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setWidth(15);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('E')
                    ->setWidth(15);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('F')
                    ->setWidth(10);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('G')
                    ->setWidth(20);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('H')
                    ->setWidth(25);

                $excel
                    ->getActiveSheet()
                    ->getDefaultRowDimension()
                    ->setRowHeight(-1);

                $excel
                    ->getActiveSheet()
                    ->getPageSetup()
                    ->setOrientation(
                        \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT
                    );
                $statu = strtoupper($status);
                $excel->getActiveSheet(0)->setTitle($statu . $tgl);
                $excel->setActiveSheetIndex(0);
                header(
                    'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                );
                header(
                    'Content-Disposition: attachment; filename=REPORT-UNIT' .
                        $status .
                        $tgl .
                        '.xlsx'
                );
                header('Cache-Control: max-age=0');
                $write = new Xlsx($excel);
                $write->save('php://output');
            } elseif ($type == 'pdf') {
                $pdf = new reportProduct();
                $pdf->setKriteria('status');
                $pdf->AliasNbPages();
                $pdf->AddPage('P', 'A4');
                $cab = $this->mlapaudit->getCabangbyId($cabang);
                foreach ($cab as $c) {
                    $cab = $c['nama_cabang'];
                }

                $stat = strtoupper($status);
                $pdf->SetFont('Arial', 'B', '12');
                $pdf->Cell(190, 7, 'TEMUAN AUDIT ' . $stat, 0, 1, 'C');
                $pdf->Cell(190, 7, 'CABANG ' . $cab, 0, 1, 'C');
                $pdf->Cell(
                    190,
                    7,
                    'PERIODE ' . $tgl_awal . ' s/d ' . $tgl_akhir,
                    0,
                    1,
                    'C'
                );
                $pdf->Cell(10, 7, '', 0, 1);

                $pdf->SetFont('Arial', 'B', 8);
                $pdf->Cell(8, 6, 'NO', 1, 0, 'C');
                $pdf->Cell(25, 6, 'NO MESIN', 1, 0, 'C');
                $pdf->Cell(28, 6, 'NO RANGKA', 1, 0, 'C');
                $pdf->Cell(25, 6, 'KODE ITEM', 1, 0, 'C');
                $pdf->Cell(27, 6, 'TYPE UNIT', 1, 0, 'C');
                $pdf->Cell(20, 6, 'USIA UNIT', 1, 0, 'C');
                $pdf->Cell(40, 6, 'LOKASI', 1, 0, 'C');
                $pdf->Cell(20, 6, 'STATUS', 1, 1, 'C');

                $pdf->SetFont('Arial', 'B', 8);
                $start = 0;

                // var_dump($cetak);die;
                $no = 1;
                foreach ($cetak as $c) {
                    $pdf->Cell(8, 6, $no, 1, 0, 'C');
                    $pdf->Cell(25, 6, $c['no_mesin'], 1, 0);
                    $pdf->Cell(28, 6, $c['no_rangka'], 1, 0);
                    $pdf->Cell(25, 6, $c['kode_item'], 1, 0);
                    $pdf->Cell(27, 6, $c['type'], 1, 0);
                    $pdf->Cell(20, 6, $c['umur_unit'], 1, 0, 'C');
                    $pdf->Cell(40, 6, $c['nama_gudang'], 1, 0);
                    $pdf->Cell(20, 6, $c['status_unit'], 1, 1);
                    $no++;
                    $start = $start + 15;
                }

                // $pdf->Output('D','REPORT-'.$stat.'.pdf');
                header('Content-type: application/PDF');
                $pdf->Output('D', 'REPORT-' . $stat . '.pdf');
                // $pdf->Output();
            }
        } else {
            echo "<script>alert('Data tidak ditemukan'); history.go(-1);</script>";
        }
    }

    public function cetakexcelnotready()
    {
        $excel = new Spreadsheet();
        $tgl = '';
        $type = $this->input->post('type');
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $is_ready = $this->input->post('ready');
        $cetak = $this->mlapaudit->cetakUnitnotready(
            $cabang,
            $idjadwal_audit,
            $is_ready
        );
        if ($cetak) {
            $tgl_awal = date('Y-m-d');
            $tgl_akhir = '1900-01-01';
            foreach ($cetak as $c) {
                if ($tgl_awal > $c['tanggal_audit']) {
                    $tgl_awal = $c['tanggal_audit'];
                }

                if ($tgl_akhir < $c['tanggal_audit']) {
                    $tgl_akhir = $c['tanggal_audit'];
                }
            }
            $tgl = $tgl_awal . ' s/d ' . $tgl_akhir;

            if ($type == 'excel') {
                $style_col = [
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' =>
                            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' =>
                            \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'top' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'right' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'left' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'bottom' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];

                $style_row = [
                    'alignment' => [
                        'horizontal' =>
                            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' =>
                            \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'top' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'right' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'left' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'bottom' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                $cab = $this->mlapaudit->getCabangbyId($cabang);
                foreach ($cab as $c) {
                    $cab = $c['nama_cabang'];
                }
                $excel
                    ->getActiveSheet()
                    ->getPageSetup()
                    ->setPaperSize(
                        \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4
                    );
                $excel
                    ->getActiveSheet()
                    ->getPageSetup()
                    ->setRowsToRepeatAtTop('A5');

                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'TEMUAN AUDIT NOT READY');
                $excel->getActiveSheet()->mergeCells('A1:H1');
                $excel
                    ->getActiveSheet()
                    ->getStyle('A1')
                    ->getFont()
                    ->setBold(true);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A1')
                    ->getFont()
                    ->setSize(14);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A1')
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    );

                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('A2', 'CABANG ' . $cab);
                $excel->getActiveSheet()->mergeCells('A2:H2');
                $excel
                    ->getActiveSheet()
                    ->getStyle('A2')
                    ->getFont()
                    ->setBold(true);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A2')
                    ->getFont()
                    ->setSize(14);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A2')
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    );

                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('A3', 'PERIODE ' . $tgl);
                $excel->getActiveSheet()->mergeCells('A3:H3');
                $excel
                    ->getActiveSheet()
                    ->getStyle('A3')
                    ->getFont()
                    ->setBold(true);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A3')
                    ->getFont()
                    ->setSize(14);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A3')
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    );

                $excel->setActiveSheetIndex(0)->setCellValue('A5', 'NO.');
                $excel->setActiveSheetIndex(0)->setCellValue('B5', 'NO. MESIN');
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('C5', 'NO. RANGKA');
                $excel->setActiveSheetIndex(0)->setCellValue('D5', 'KODE ITEM');
                $excel->setActiveSheetIndex(0)->setCellValue('E5', 'TYPE UNIT');
                $excel->setActiveSheetIndex(0)->setCellValue('F5', 'USIA UNIT');
                $excel->setActiveSheetIndex(0)->setCellValue('G5', 'LOKASI');
                $excel->setActiveSheetIndex(0)->setCellValue('H5', 'READY');

                $excel
                    ->getActiveSheet()
                    ->getStyle('A5')
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('B5')
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('C5')
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('D5')
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('E5')
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('F5')
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('G5')
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('H5')
                    ->applyFromArray($style_col);

                $no = 1;
                $seri = 6;

                foreach ($cetak as $c) {
                    // var_dump($c);die;
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('A' . $seri, $no);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('B' . $seri, $c['no_mesin']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('C' . $seri, $c['no_rangka']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('D' . $seri, $c['kode_item']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('E' . $seri, $c['type']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('F' . $seri, $c['umur_unit']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('G' . $seri, $c['nama_gudang']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('H' . $seri, $c['is_ready']);

                    $excel
                        ->getActiveSheet()
                        ->getStyle('A' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('B' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('C' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('D' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('E' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('F' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('G' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('H' . $seri)
                        ->applyFromArray($style_row);

                    $no++;
                    $seri++;
                }

                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setWidth(5);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('B')
                    ->setWidth(20);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setWidth(25);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setWidth(15);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('E')
                    ->setWidth(15);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('F')
                    ->setWidth(10);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('G')
                    ->setWidth(20);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('H')
                    ->setWidth(25);

                $excel
                    ->getActiveSheet()
                    ->getDefaultRowDimension()
                    ->setRowHeight(-1);

                $excel
                    ->getActiveSheet()
                    ->getPageSetup()
                    ->setOrientation(
                        \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT
                    );
                $ready = strtoupper($is_ready);
                $excel->getActiveSheet(0)->setTitle($ready . $idjadwal_audit);
                $excel->setActiveSheetIndex(0);
                header(
                    'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                );
                header(
                    'Content-Disposition: attachment; filename=REPORT-UNIT' .
                        $ready .
                        $idjadwal_audit .
                        '.xlsx'
                ); // Set nama file excel nya
                header('Cache-Control: max-age=0');
                $write = new Xlsx($excel);
                // var_dump($write);die;
                $write->save('php://output');
            } elseif ($type == 'pdf') {
                $pdf = new reportProduct();
                $pdf->setKriteria('status');
                $pdf->AliasNbPages();
                $pdf->AddPage('P', 'A4');
                $cab = $this->mlapaudit->getCabangbyId($cabang);
                foreach ($cab as $c) {
                    $cab = $c['nama_cabang'];
                }

                $rdy = strtoupper($is_ready);

                $pdf->SetFont('Arial', 'B', '12');
                $pdf->Cell(190, 7, 'TEMUAN AUDIT ' . $rdy, 0, 1, 'C');
                $pdf->Cell(190, 7, 'CABANG ' . $cab, 0, 1, 'C');
                $pdf->Cell(190, 7, 'PERIODE ' . $tgl, 0, 1, 'C');

                $pdf->Cell(10, 7, '', 0, 1);

                $pdf->SetFont('Arial', 'B', 8);
                $pdf->Cell(8, 6, 'NO', 1, 0, 'C');
                $pdf->Cell(25, 6, 'NO MESIN', 1, 0, 'C');
                $pdf->Cell(28, 6, 'NO RANGKA', 1, 0, 'C');
                $pdf->Cell(25, 6, 'KODE ITEM', 1, 0, 'C');
                $pdf->Cell(27, 6, 'TYPE UNIT', 1, 0, 'C');
                $pdf->Cell(25, 6, 'USIA UNIT', 1, 0, 'C');
                $pdf->Cell(25, 6, 'LOKASI', 1, 0, 'C');
                $pdf->Cell(25, 6, 'READY', 1, 1, 'C');

                $pdf->SetFont('Arial', 'B', 8);
                $start = 0;

                $no = 1;
                foreach ($cetak as $c) {
                    $pdf->Cell(8, 6, $no, 1, 0, 'C');
                    $pdf->Cell(25, 6, $c['no_mesin'], 1, 0);
                    $pdf->Cell(28, 6, $c['no_rangka'], 1, 0);
                    $pdf->Cell(25, 6, $c['kode_item'], 1, 0);
                    $pdf->Cell(27, 6, $c['type'], 1, 0);
                    $pdf->Cell(25, 6, $c['umur_unit'], 1, 0, 'C');
                    $pdf->Cell(25, 6, $c['nama_gudang'], 1, 0);
                    $pdf->Cell(25, 6, $c['is_ready'], 1, 1);
                    $no++;
                    $start = $start + 15;
                }
                // $pdf->Output('D','REPORT-'.$stat.'.pdf');
                header('Content-type: application/PDF');
                $pdf->Output('D', 'REPORT-' . $rdy . '.pdf');
                // $pdf->Output();
            }
        } else {
            echo "<script>alert('Data tidak ditemukan'); history.go(-1);</script>";
        }
    }
    public function prevaksesoris()
    {
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');

        $count = $this->mlapaudit->aksesoriscount($cabang, $idjadwal_audit);
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'transaksi_auditor/prevaksesoris';
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

        $cetak = $this->mlapaudit->prevAksesoris(
            $cabang,
            $idjadwal_audit,
            $start
        );
        $row_entry =
            '
                <div class=" label label-default">' .
            $count .
            '</div>
            ';
        $output = [
            'pagination_link' => $this->pagination->create_links(),
            'aksesoris' => $cetak,
            'row_entry' => $row_entry,
        ];

        echo json_encode($output);
    }
    public function cetakperlokasi()
    {
        $tgl = '';
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $kacab = $this->input->post('kacab');
        $tempat = $this->input->post('tempat');
        $counter = $this->input->post('counter');
        $auditor = $this->input->post('auditor');

        $cab = $this->mlapaudit->getCabangbyId($cabang);
        foreach ($cab as $c) {
            $cab = $c['nama_cabang'];
        }
        $start = null;
        $cetak = $this->mlapaudit->prevAksesorisPdf(
            $cabang,
            $idjadwal_audit,
            $start
        );
        if ($cetak != null) {
            $tgl_awal = date('Y-m-d');
            $tgl_akhir = '1900-01-01';
            foreach ($cetak as $c) {
                if ($tgl_awal > $c['tanggal_audit']) {
                    $tgl_awal = $c['tanggal_audit'];
                }

                if ($tgl_akhir < $c['tanggal_audit']) {
                    $tgl_akhir = $c['tanggal_audit'];
                }
            }
            $tgl = $tgl_awal . ' s/d ' . $tgl_akhir;

            $pdf = new reportProduct();
            $pdf->setKriteria('report2');
            $pdf->setNama($cab);
            $pdf->AliasNbPages();
            $pdf->AddPage('P', 'A4');
            $pdf->SetFont('Times', 'B', '16');
            $pdf->Cell(0, 30, 'Kertas Kerja Audit', 0, 1, 'L');
            $pdf->SetFont('Times', '', '10');
            $pdf->SetXY(120, 34);
            $pdf->cell(0, 0, 'Auditee', 0, 1);
            $pdf->SetXY(152, 34);
            $pdf->cell(0, 0, ': Kelengkapan Unit SMH  (H1)', 0, 1);
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
            $pdf->SetFont('Times', 'B', 10);

            $pdf->Cell(10, 5, 'Hasil Audit', 0, 1);
            $pdf->Cell(30, 15, 'Jenis Kelengkapan', 1, 0, 'C', true);
            $pdf->Cell(25, 15, 'QTY Unit', 1, 0, 'C', true);
            $pdf->Cell(35, 15, 'QTY Fisik Aksesoris', 1, 0, 'C', true);
            $pdf->Cell(27, 15, 'Selisih', 1, 0, 'C', true);
            $pdf->Cell(20, 15, 'Keterangan', 1, 1, 'C', true);
            $start = null;

            $qty = $this->mtransaudit->countUnit1($cabang);
            $qtyAki = $this->mlapaudit->sumUnit($cabang);
            foreach ($qtyAki as $q) {
                $qtyAki = $q['jum_aki'];
                $qtyTools = $q['jum_tools'];
                $qtyHelm = $q['jum_helm'];
                $qtySpion = $q['jum_spion'];
            }
            $selisihAki = $qtyAki - $qty;
            if ($qty > $qtyAki) {
                $ket = 'Minus';
            } else {
                $ket = 'Lebih';
            }
            $pdf->SetFont('Times', '', 8);
            $pdf->Cell(30, 6, 'Aki', 1, 0, 'C');
            $pdf->Cell(25, 6, $qty, 1, 0, 'C');
            $pdf->Cell(35, 6, $qtyAki, 1, 0, 'C');
            $pdf->Cell(27, 6, $selisihAki, 1, 0, 'C');
            $pdf->Cell(20, 6, $ket, 1, 1, 'C');

            $selisihSpion = $qtySpion - $qty;
            if ($qty > $qtySpion) {
                $ket = 'Minus';
            } else {
                $ket = 'Lebih';
            }
            $pdf->SetFont('Times', '', 8);
            $pdf->Cell(30, 6, 'Spion', 1, 0, 'C');
            $pdf->Cell(25, 6, $qty, 1, 0, 'C');
            $pdf->Cell(35, 6, $qtySpion, 1, 0, 'C');
            $pdf->Cell(27, 6, $selisihSpion, 1, 0, 'C');
            $pdf->Cell(20, 6, $ket, 1, 1, 'C');
            $selisihHelm = $qtyHelm - $qty;
            if ($qty > $qtyHelm) {
                $ket = 'Minus';
            } else {
                $ket = 'Lebih';
            }
            $pdf->SetFont('Times', '', 8);
            $pdf->Cell(30, 6, 'Helm', 1, 0, 'C');
            $pdf->Cell(25, 6, $qty, 1, 0, 'C');
            $pdf->Cell(35, 6, $qtyHelm, 1, 0, 'C');
            $pdf->Cell(27, 6, $selisihHelm, 1, 0, 'C');
            $pdf->Cell(20, 6, $ket, 1, 1, 'C');

            $selisihTools = $qtyTools - $qty;
            if ($qty > $qtyTools) {
                $ket = 'Minus';
            } else {
                $ket = 'Lebih';
            }
            $pdf->SetFont('Times', '', 8);
            $pdf->Cell(30, 6, 'Tools', 1, 0, 'C');
            $pdf->Cell(25, 6, $qty, 1, 0, 'C');
            $pdf->Cell(35, 6, $qtyTools, 1, 0, 'C');
            $pdf->Cell(27, 6, $selisihTools, 1, 0, 'C');
            $pdf->Cell(20, 6, $ket, 1, 1, 'C');
            $pdf->Ln(5);
            $pdf->SetLineWidth(0.05);
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
            // $pdf->Output('D','REPORTUNIT-'.$tgl.'.pdf');
            $pdf->Output();
        } else {
            echo "<script>alert('Data tidak ditemukan'); history.go(-1);</script>";
        }
    }
    public function previewnotready()
    {
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $is_ready = $this->input->post('is_ready');
        // var_dump($this->input->post());die;
        $this->load->library('pagination');
        if ($is_ready != null) {
            $count = $this->mlapaudit->countunitnotready(
                $cabang,
                $idjadwal_audit,
                $is_ready
            );
            // $base= 'lap_belum_ditemukan';
            $config['base_url'] =
                base_url() . 'laporan_auditor/previewnotready';
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

            $cetak = $this->mlapaudit->previewUnitnotready(
                $cabang,
                $idjadwal_audit,
                $is_ready,
                $start
            );
            $row_entry =
                '
                    <div class=" label label-default">' .
                $count .
                '</div>
                ';
        }

        $output = [
            // 'pagination_link'   => $count,
            'pagination_link' => $this->pagination->create_links(),
            'unit_list' => $cetak,
            'row_entry' => $row_entry,
        ];

        echo json_encode($output);
    }

    public function preview()
    {
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $status = $this->input->post('status');
        // var_dump($this->input->post());die;
        $this->load->library('pagination');
        if ($status != null) {
            $count = $this->mlapaudit->countunit(
                $cabang,
                $idjadwal_audit,
                $status
            );
            // $base= 'lap_belum_ditemukan';
            $config['base_url'] = base_url() . 'laporan_auditor/preview';
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

            $cetak = $this->mlapaudit->previewUnit(
                $cabang,
                $idjadwal_audit,
                $status,
                $start
            );
            $row_entry =
                '
                    <div class=" label label-default">' .
                $count .
                '</div>
                ';
        } elseif ($status == null) {
            $count = $this->mlapaudit->countunitvalid($cabang, $idjadwal_audit);
            // $count= 13;
            // $this->load->library('pagination');
            $config['base_url'] = base_url() . 'laporan_auditor/preview';
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

            $cetak = $this->mlapaudit->auditUnit(
                $cabang,
                $idjadwal_audit,
                $start
            );
            $row_entry =
                '
                    <div class=" label label-default">' .
                $count .
                '</div>
                ';
        }

        $output = [
            // 'pagination_link'   => $count,
            'pagination_link' => $this->pagination->create_links(),
            'unit_list' => $cetak,
            'row_entry' => $row_entry,
        ];

        echo json_encode($output);
    }
    public function previewPart()
    {
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $status = $this->input->post('status');
        $this->load->library('pagination');

        $count = $this->mlapaudit->countpartvalid($cabang, $idjadwal_audit);
        // $count= 13;
        // $this->load->library('pagination');
        $config['base_url'] = base_url() . 'laporan_auditor/previewpart';
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

        $cetak = $this->mlapaudit->auditPart($cabang, $idjadwal_audit, $start, $status);
        $row_entry =
            '
                    <div class=" label label-default">' .
            $count .
            '</div>
                ';

        $output = [
            // 'pagination_link'   => $count,
            'pagination_link' => $this->pagination->create_links(),
            'part_list' => $cetak,
            'row_entry' => $row_entry,
        ];

        echo json_encode($output);
    }
    public function previewket()
    {
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $this->load->library('pagination');
        $keterangan = $this->input->post('keterangan');

        $count = $this->mlapaudit->countpartvalid($cabang, $idjadwal_audit);
        // $count= 13;
        // $this->load->library('pagination');
        $config['base_url'] = base_url() . 'laporan_auditor/previewpart';
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

        $cetak = $this->mlapaudit->previewket($cabang, $idjadwal_audit, $start, $keterangan);
        $row_entry =
            '
                    <div class=" label label-default">' .
            $count .
            '</div>
                ';

        $output = [
            // 'pagination_link'   => $count,
            'pagination_link' => $this->pagination->create_links(),
            'part_list' => $cetak,
            'row_entry' => $row_entry,
        ];

        echo json_encode($output);
    }
    public function cetakPart()
    {
        $tgl = date('Ymd');
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $kacab = $this->input->post('kacab');
        $tempat = $this->input->post('tempat');
        $counter = $this->input->post('counter');
        $auditor = $this->input->post('auditor');
        $tgl_awal = '';
        $tgl_akhir = '';

        $cab = $this->mlapaudit->getCabangbyId($cabang);
        foreach ($cab as $c) {
            $cab = $c['nama_cabang'];
        }
        $start = 0;
        $cetak = $this->mlapaudit->partvalid($cabang, $idjadwal_audit);

        if ($cetak != null) {
            $tgl_awal = date('Y-m-d');
            $tgl_akhir = '1900-01-01';
            foreach ($cetak as $c) {
                if ($tgl_awal > $c['tanggal_audit']) {
                    $tgl_awal = $c['tanggal_audit'];
                }

                if ($tgl_akhir < $c['tanggal_audit']) {
                    $tgl_akhir = $c['tanggal_audit'];
                }
            }
            $tgl = $tgl_awal . ' s/d ' . $tgl_akhir;

            $pdf = new reportProduct();
            $pdf->setKriteria('report');
            $pdf->setNama($cab);
            $pdf->AliasNbPages();
            $pdf->AddPage('P', 'A4');
            $pdf->SetFont('Times', 'B', '16');
            // $pdf->Cell(0, 30, 'Kertas Kerja Audit', 0, 1, 'L');
            $pdf->SetFont('Times', '', '10');
            $pdf->SetXY(150, 34);
            $pdf->cell(0, 0, 'CEK I        SYAIFUL BAHRI', 0, 1);

            // $pdf->SetXY(152, 34);
            // $pdf->cell(0, 0, ': Part', 0, 1);
            // $pdf->SetXY(120, 39);
            // $pdf->cell(0, 0, 'Periode Pelaksanaan', 0, 1);
            // $pdf->SetXY(152, 39);
            // $pdf->cell(0, 0, ': ' . $tgl, 0, 1);
            
            // $pdf->SetXY(154, 44);
            // $pdf->cell(0, 0, ': ' . $tgl, 0, 1);
            // $pdf->Rect(140, 34, 30, 10);
            // $pdf->SetXY(154, 44);
            $pdf->SetXY(150, 42);            
            $pdf->cell(0, 0, 'TTD', 0, 1);
            $pdf->Rect(165, 37, 30, 10);

            $pdf->SetXY(150, 50);
            $pdf->cell(0, 0, 'CEK II      AGUS ZAINUDDIN', 0, 1);

            $pdf->SetXY(150, 59);            
            $pdf->cell(0, 0, 'TTD', 0, 1);
            $pdf->Rect(165, 54, 30, 10);
            // $pdf->cell(0, 0, ': ' . $tgl, 0, 1);
            // $pdf->SetXY(120, 44);
            // $pdf->cell(0, 0, 'Auditor', 0, 1);
            // $pdf->SetXY(152, 44);
            // $pdf->cell(0, 0, ': ' . $auditor, 0, 1);
            // $pdf->SetXY(120, 49);
            // $pdf->cell(0, 0, 'Di-review Oleh', 0, 1);
            // $pdf->SetXY(152, 49);
            // $pdf->cell(0, 0, ': ', 0, 1);
            $pdf->ln();
        
            $pdf->SetY(70);
            $pdf->SetLineWidth(0.1);
            $pdf->SetFillColor(186, 185, 184);
            $pdf->SetFont('Times', 'B', 10);

            $pdf->Cell(40, 5, '1. STOCK OPNAME SPARE PART / HGP.', 0, 1);
            $pdf->ln(0.5);
            $pdf->Cell(40, 5, 'A. SELISIH KURANG SPARE PART (QUANTITY FISIK ADA, QUANTITY SISTEM ADA)							
', 0, 1);					

            $pdf->Cell(12, 15, 'No', 1, 0, 'C', true);
            // $pdf->Cell(55, 15, 'LOKASI', 1, 0, 'C', true);
            $pdf->Cell(50, 15, 'PART NUMBER', 1, 0, 'C', true);
            $pdf->Cell(60, 15, 'DESKRIPSI', 1, 0, 'C', true);
            // $pdf->Cell(30, 15, 'KD RAK BIN', 1, 0, 'C', true);
            $pdf->Cell(50, 15, 'QTY', 1, 1, 'C', true);
            $start = null;

            $no = 1;
            $pdf->SetFont('Times', '', 10);
            foreach ($cetak as $c) {
                $pdf->Cell(12, 8, $no, 1, 0, 'C');
                // $pdf->Cell(55, 6, $c['nama_gudang'], 1, 0);
                // $x = $pdf->GetX();
                // $pdf->myCell(55, 8, $x, $c['nama_gudang']);
                $x = $pdf->GetX();
                $pdf->myCell(50, 8, $x, $c['part_number']);
                $x = $pdf->GetX();
                $pdf->myCell(60, 8, $x, $c['deskripsi']);
                // $x = $pdf->GetX();
                // $pdf->myCell(30, 8, $x, $c['kd_lokasi_rak']);
                $x = $pdf->GetX();
                $pdf->myCell(50, 8, $x,  $c['qty']);
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
            $pdf->Output('D', 'REPORTPART-' . $tgl . '.pdf');
            $pdf->Output();
        } else {
            redirect('laporan_auditor/lap_audit_part', 'refresh');
        }
    }

    public function cetakparttemp()
    {
        $tgl = date('Ymd');
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $qty = $this->input->post('qty');
        $status = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');
        $kacab = $this->input->post('kacab');
        $tempat = $this->input->post('tempat');
        $counter = $this->input->post('counter');
        $auditor = $this->input->post('auditor');
        $tgl_awal = '';
        $tgl_akhir = '';

        $cab = $this->mlapaudit->getCabangbyId($cabang);
        foreach ($cab as $c) {
            $cab = $c['nama_cabang'];
        }
        $start = 0;
        $cetak = $this->mlapaudit->cetakPartkurang($cabang, $idjadwal_audit,$status,$keterangan);

        if ($cetak != null) {
            $tgl_awal = date('Y-m-d');
            $tgl_akhir = '1900-01-01';
            foreach ($cetak as $c) {
                if ($tgl_awal > $c['tanggal_audit']) {
                    $tgl_awal = $c['tanggal_audit'];
                }

                if ($tgl_akhir < $c['tanggal_audit']) {
                    $tgl_akhir = $c['tanggal_audit'];
                }
            }
            $tgl = $tgl_awal . ' s/d ' . $tgl_akhir;

            $pdf = new reportProduct();
            $pdf->setKriteria('report');
            $pdf->setNama($cab);
            $pdf->AliasNbPages();
            $pdf->AddPage('P', 'A4');
            $pdf->SetFont('Times', 'B', '16');

            $pdf->SetFont('Times', '', '10');
            $pdf->SetXY(150, 34);
            $pdf->cell(0, 0, 'CEK I        SYAIFUL BAHRI', 0, 1);
            $pdf->SetXY(150, 42);            
            $pdf->cell(0, 0, 'TTD', 0, 1);
            $pdf->Rect(165, 37, 30, 10);

            $pdf->SetXY(150, 50);
            $pdf->cell(0, 0, 'CEK II      AGUS ZAINUDDIN', 0, 1);

            $pdf->SetXY(150, 59);            
            $pdf->cell(0, 0, 'TTD', 0, 1);
            $pdf->Rect(165, 54, 30, 10);

            $pdf->ln();
            $pdf->SetY(60);
            $pdf->SetLineWidth(0.1);
            $pdf->SetFillColor(186, 185, 184);
            $pdf->SetFont('Times', 'B', 10);
            

            
            $pdf->Cell(40, 5, '1. STOCK OPNAME SPARE PART / HGP.', 0, 1);
            $pdf->ln(0.5);
            $pdf->Cell(40, 5, 'A. SELISIH KURANG SPARE PART (QUANTITY FISIK ADA, QUANTITY SISTEM ADA)', 0, 1);					

            $pdf->Cell(12, 16, 'No', 1, 0, 'C', true);
            $pdf->Cell(30, 16, 'No Part', 1, 0, 'C', true);
            $pdf->Cell(58, 16, 'Deskripsi', 1, 0, 'C', true);
            $pdf->Cell(25, 16, 'HET', 1, 0, 'C', true);
            // $pdf->Cell(36, 8, 'QTY', 1,0, 'C', true);  
            $pdf->Cell(12, 16, 'Sys', 1,0, 'C', true);
            $pdf->Cell(12, 16, 'Fisk', 1,0, 'C', true);
            $pdf->Cell(12, 16, 'Selisih', 1, 0, 'C', true);
            $pdf->Cell(25, 16, 'Amount', 1,1, 'C', true);
            $start = null;
            
            //cetak data
            // $pdf = new reportProduct();
            $pdf->setKriteria('report3');
            // $pdf->setNama($cab);
            // $pdf->AliasNbPages();
            // $pdf->AddPage('P', 'A4');
            $pdf->SetFont('Times', 'B', '16');
            $no = 1;
            $pdf->SetFont('Times', '', 10);
            foreach ($cetak as $c) {
                $pdf->Cell(12, 8, $no, 1, 0, 'C');
                $x = $pdf->GetX();
                $pdf->myCell(30, 8, $x, $c['part_number']);
                $x = $pdf->GetX();
                $pdf->myCell(58, 8, $x, $c['deskripsi']);
                $x = $pdf->GetX();
                $pdf->myCell(25, 8, $x, $c['harga_jual']);
                $x = $pdf->GetX();
                $pdf->myCell(12, 8, $x,  $c['qty']);
                $x = $pdf->GetX();
                $pdf->myCell(12, 8, $x,  $c['qty_fsk']);
                $x = $pdf->GetX();
                $pdf->myCell(12, 8, $x,  $c['selisih']);
                $x = $pdf->GetX();
                $pdf->myCell(25, 8, $x,  $c['amount']);
                $pdf->ln();
                $no++;
            }

            $pdf->ln();
            $pdf->SetFont('Times', 'B', 10);
            $pdf->Cell(40, 5, 'B. SELISIH KURANG SPARE PART (QUANTITY FISIK TIDAK ADA, QUANTITY SISTEM ADA)', 0, 1);		

            $cetak2 = $this->mlapaudit->cetakPartbelumditemukan($cabang, $idjadwal_audit,$status,$keterangan);
            $no = 1;
            $pdf->SetFont('Times', '', 10);
            foreach ($cetak2 as $c) {
                     $pdf->Cell(12, 8, $no, 1, 0, 'C');
                $x = $pdf->GetX();
                $pdf->myCell(30, 8, $x, $c['part_number']);
                $x = $pdf->GetX();
                $pdf->myCell(58, 8, $x, $c['deskripsi']);
                $x = $pdf->GetX();
                $pdf->myCell(25, 8, $x, $c['harga_jual']);
                $x = $pdf->GetX();
                $pdf->myCell(12, 8, $x,  $c['qty']);
                $x = $pdf->GetX();
                $pdf->myCell(12, 8, $x,  $c['qty_fsk']);
                $x = $pdf->GetX();
                $pdf->myCell(12, 8, $x,  $c['selisih']);
                $x = $pdf->GetX();
                $pdf->myCell(25, 8, $x,  $c['amount']);
                $pdf->ln();
                $no++;
            }

            $pdf->ln();
            $pdf->SetFont('Times', 'B', 10);
            $pdf->Cell(40, 5, 'C. STOCK SPARE PART YANG TIDAK TERDAPAT SELISIH (SESUAI)', 0, 1);		

            $cetak3 = $this->mlapaudit->cetakPartSesuai($cabang, $idjadwal_audit,$status,$keterangan);
            $no = 1;
            $pdf->SetFont('Times', '', 10);
            foreach ($cetak3 as $c) {
                $pdf->Cell(12, 8, $no, 1, 0, 'C');
                $x = $pdf->GetX();
                $pdf->myCell(30, 8, $x, $c['part_number']);
                $x = $pdf->GetX();
                $pdf->myCell(58, 8, $x, $c['deskripsi']);
                $x = $pdf->GetX();
                $pdf->myCell(25, 8, $x, $c['harga_jual']);
                $x = $pdf->GetX();
                $pdf->myCell(12, 8, $x,  $c['qty']);
                $x = $pdf->GetX();
                $pdf->myCell(12, 8, $x,  $c['qty_fsk']);
                $x = $pdf->GetX();
                $pdf->myCell(12, 8, $x,  $c['selisih']);
                $x = $pdf->GetX();
                $pdf->myCell(25, 8, $x,  $c['amount']);
                $pdf->ln();
                $no++;
            }

            $pdf->ln();
            $pdf->SetFont('Times', 'B', 10);
            $pdf->Cell(40, 5, 'D. SELISIH LEBIH SPARE PART (QUANTITY SISTEM ADA, QUANTITY FISIK ADA)', 0, 1);		

            $cetak4 = $this->mlapaudit->cetakPartSesuai($cabang, $idjadwal_audit,$status,$keterangan);
            $no = 1;
            $pdf->SetFont('Times', '', 10);
            foreach ($cetak4 as $c) {
                $pdf->Cell(12, 8, $no, 1, 0, 'C');
                $x = $pdf->GetX();
                $pdf->myCell(30, 8, $x, $c['part_number']);
                $x = $pdf->GetX();
                $pdf->myCell(58, 8, $x, $c['deskripsi']);
                $x = $pdf->GetX();
                $pdf->myCell(25, 8, $x, $c['harga_jual']);
                $x = $pdf->GetX();
                $pdf->myCell(12, 8, $x,  $c['qty']);
                $x = $pdf->GetX();
                $pdf->myCell(12, 8, $x,  $c['qty_fsk']);
                $x = $pdf->GetX();
                $pdf->myCell(12, 8, $x,  $c['selisih']);
                $x = $pdf->GetX();
                $pdf->myCell(25, 8, $x,  $c['amount']);
                $pdf->ln();
                $no++;
            }

            $pdf->ln();
            $pdf->SetFont('Times', 'B', 10);
            $pdf->Cell(40, 5, 'E. SELISIH LEBIH SPARE PART (QUANTITY SISTEM TIDAK ADA, QUANTITY FISIK ADA)', 0, 1);		

            $cetak5 = $this->mlapaudit->cetakpartqty($cabang, $idjadwal_audit, $qty, $status,$keterangan);
            $no = 1;
            $pdf->SetFont('Times', '', 10);
            foreach ($cetak5 as $c) {
                $pdf->Cell(12, 8, $no, 1, 0, 'C');
                $x = $pdf->GetX();
                $pdf->myCell(30, 8, $x, $c['part_number']);
                $x = $pdf->GetX();
                $pdf->myCell(58, 8, $x, $c['deskripsi']);
                $x = $pdf->GetX();
                $pdf->myCell(25, 8, $x, $c['harga_jual']);
                $x = $pdf->GetX();
                $pdf->myCell(12, 8, $x,  $c['qty']);
                $x = $pdf->GetX();
                $pdf->myCell(12, 8, $x,  $c['qty_fsk']);
                $x = $pdf->GetX();
                $pdf->myCell(12, 8, $x,  $c['selisih']);
                $x = $pdf->GetX();
                $pdf->myCell(25, 8, $x,  $c['amount']);
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
            $pdf->Output('D', 'REPORTPART-' . $tgl . '.pdf');
            $pdf->Output();
        } else {
            redirect('transaksi_auditor/audit_part', 'refresh');
        }
    }

    public function Filter_Cabang()
    {
        $data = [
            'judul' => 'Filter Cabang',
            'judul1' => 'Laporan Auditor',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'auditorview/laporan_unit/v_filter_cabang.php',
            $data
        );
        $this->load->view('auditorview/laporan_unit/_partial/footer.php');
    }

    public function Filter_Kondisi()
    {
        $data = [
            'judul' => 'Filter Cabang',
            'judul1' => 'Laporan Auditor',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'auditorview/laporan_unit/v_filter_kondisi.php',
            $data
        );
        $this->load->view('auditorview/laporan_unit/_partial/footer.php');
    }

    public function Lap_Audit_unit()
    {
        $data = [
            'judul' => 'Laporan Audit Unit',
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'auditorview/laporan_unit/v_laporan_audit_unit.php',
            $data
        );
        $this->load->view('auditorview/laporan_unit/_partial/footer.php');
    }
    public function Lap_Audit_part()
    {
        $data = [
            'judul' => 'Laporan Audit Part',
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/laporan_part/v_laporan_part.php', $data);
        $this->load->view('auditorview/laporan_part/_partial/footer.php');
    }
    public function Lap_part()
    {
        $data = [
            'judul' => 'Laporan Audit Part',
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/laporan_part/v_laporan_audit_part.php', $data);
        $this->load->view('auditorview/laporan_part/_partial/footer.php');
    }
    public function Lap_part_belum_ditemukan()
    {
        $data = [
            'judul' => 'Laporan Audit Part',
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/laporan_part/v_laporan_belum_ditemukan.php', $data);
        $this->load->view('auditorview/laporan_part/_partial/footer.php');
    }
    public function Lap_part_lebih()
    {
        $data = [
            'judul' => 'Laporan Audit Part',
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/laporan_part/v_laporan_part_lebih.php', $data);
        $this->load->view('auditorview/laporan_part/_partial/footer.php');
    }
     public function Lap_part_Kurang()
    {
        $data = [
            'judul' => 'Laporan Audit Part',
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/laporan_part/v_laporan_part_Kurang.php', $data);
        $this->load->view('auditorview/laporan_part/_partial/footer.php');
    }

    
    public function Lap_Perlokasi()
    {
        $data = [
            'judul' => 'Laporan Perlokasi',
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'auditorview/laporan_unit/v_laporan_perlokasi.php',
            $data
        );
        $this->load->view('auditorview/laporan_unit/_partial/footer3.php');
    }

    public function Lap_sesuai()
    {
        $data = [
            'judul' => 'Laporan Data Sesuai',
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),
        ];

        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'auditorview/laporan_unit/v_laporan_sesuai.php',
            $data
        );
        $this->load->view('auditorview/laporan_unit/_partial/footer.php');
    }

    public function Lap_belum_sesuai()
    {
        $data = [
            'judul' => 'Laporan Data Belum Sesuai',
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'auditorview/laporan_unit/v_laporan_belum_sesuai.php',
            $data
        );
        $this->load->view('auditorview/laporan_unit/_partial/footer.php');
    }

    public function Lap_belum_ditemukan()
    {
        $data = [
            'judul' => 'Laporan Belum Ditemukan',
            'tgl' => date('m/d/Y'),
            'judul1' => 'Laporan Auditor',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'auditorview/laporan_unit/v_laporan_belum_ditemukan.php',
            $data
        );
        $this->load->view('auditorview/laporan_unit/_partial/footer.php');
    }

    public function Lap_not_ready()
    {
        $data = [
            'judul' => 'Laporan Not Ready',
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'auditorview/laporan_unit/v_laporan_not_ready.php',
            $data
        );
        $this->load->view('auditorview/laporan_unit/_partial/footer2.php');
    }
    //------------------GET DATA--------------//
    public function ajax_get_cabang2()
    {
        $output = '';
        $no = 0;
        $listcabang = $this->mlapaudit->getCabang();
        foreach ($listcabang as $list) {
            $no++;
            $output .=
                '
				<option value="' .
                $list['id_cabang'] .
                '">' .
                $list['id_cabang'] .
                ' - ' .
                $list['nama_cabang'] .
                '</option>
			';
        }
        echo '<option value="">--- Pilih Cabang ---</option>';
        echo $output;
    }

    //------SEARCH DATA--------//
    public function search_data_jadwal()
    {
        $jadwal = $this->input->post('id');
        $output = '';
        $no = 0;
        $base = base_url();
        // var_dump($usergroup);
        if ($jadwal != null) {
            $listUserGroup = $this->mmasdat->cariusergroup($jadwal);
        }

        if ($listUserGroup) {
            foreach ($listUserGroup as $list) {
                $no++;
                $output .=
                    '
                <tr> 
                    <td>' .
                    $no .
                    '</td>
                    <td>
                    <a id="' .
                    $list['id_usergroup'] .
                    '" class="text-warning"><i class="fa fa-pencil"></i></a>
                    <a href="' .
                    $base .
                    'master_data/delete_usergroup/' .
                    $list['id_usergroup'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi menghapus data ' .
                    $list['id_usergroup'] .
                    ' - ' .
                    $list['user_group'] .
                    ' ? ");\'><i class="fa fa-trash"></i></a>
                    </td>
                    <td>' .
                    $list['id_usergroup'] .
                    '</td>
                    <td>' .
                    $list['user_group'] .
                    '</td>
                </tr>
                
                ';
            }
        } else {
            $output .= '
            <tr >
            <td colspan="8" class="text-center">data not found</td>
            </tr>
            ';
        }
        echo $output;
    }

    public function cetakexcelpart()
    {
        $excel = new Spreadsheet();
        $tgl = date('Ymd');
        $tgl2 = date('F Y');
        $type = $this->input->post('type');
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $status = $this->input->post('status');
        $qty = $this->input->post('qty');
        $keterangan = $this->input->post('keterangan');
        

        $tgl_awal = date('Y-m-d');
        $tgl_akhir = '1900-01-01';
        $cetak = $this->mlapaudit->cetakPartKurang($cabang, $idjadwal_audit, $status, $keterangan);
        // var_dump($cetak);exit;
        if ($cetak) {
            foreach ($cetak as $c) {
                if ($tgl_akhir < $c['tanggal_audit']) {
                    $tgl_akhir = $c['tanggal_audit'];
                }
                if ($tgl_awal > $c['tanggal_audit']) {
                    $tgl_awal = $c['tanggal_audit'];
                }
            }

            if ($type == 'excel') {
                $style_col = [
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' =>
                            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' =>
                            \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                     'borders' => [
                        'top' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'right' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'left' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'bottom' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                    'fill'=>[
		                'fillType' =>  fill::FILL_SOLID,
		                'startColor' => [
			            'rgb' => 'c9c9c9'
		                ]
	                ],
            ];

                $styleArray = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];

                $style_row = [
                    'alignment' => [
                        'horizontal' =>
                            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' =>
                            \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'top' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        ],
                        'right' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        ],
                        'left' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        ],
                        'bottom' => [
                            'style' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        ],
                    ],
                ];

                    $styleArray = array(
                        'borders' => array(
                        'outline' => array(
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        'color' => array('argb' => '0000'),
                        ),
                    ),
                );


                $styleArray2 = array(
                        'borders' => array(
                        'outline' => array(
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => array('argb' => '0000'),
                        ),
                    ),
                );

                $bold = [
                    'font' => ['bold' => true],
                ];

                $systm = [
                    'fill'=>[
		                'fillType' =>  fill::FILL_SOLID,
		                'startColor' => [
			            'rgb' => '88c07f'
		                ]
	                ],
                ];

                $fisk = [
                    'fill'=>[
		                'fillType' =>  fill::FILL_SOLID,
		                'startColor' => [
			            'rgb' => 'dcc058'
		                ]
	                ],
                ];

                 $selisih = [
                    'fill'=>[
		                'fillType' =>  fill::FILL_SOLID,
		                'startColor' => [
			            'rgb' => 'de925c'
		                ]
	                ],
                ];

                $cab = $this->mlapaudit->getCabangbyId($cabang);
                foreach ($cab as $c) {
                    $cab = $c['nama_cabang'];
                }
                $excel
                    ->getActiveSheet()
                    ->getPageSetup()
                    ->setPaperSize(
                        \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4
                    );
                $excel
                    ->getActiveSheet()
                    ->getPageSetup();
                    // ->setRowsToRepeatAtTop('A5');

                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'LHA STOCK OPNAME SPAREPART DAN OLI');
                $excel->getActiveSheet()->mergeCells('A1:H1');
                $excel
                    ->getActiveSheet()
                    ->getStyle('A1')
                    ->getFont()
                    ->setBold(true);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A1')
                    ->getFont()
                    ->setSize(10);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A1')
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    );

                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('A2', 'TRIO MOTOR ' . $cab);
                $excel->getActiveSheet()->mergeCells('A2:H2');
                $excel
                    ->getActiveSheet()
                    ->getStyle('A2')
                    ->getFont()
                    ->setBold(true);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A2')
                    ->getFont()
                    ->setSize(10);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A2')
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    );
                 $excel->setActiveSheetIndex(0)->setCellValue('A3','PERIODE ' . strtoupper($tgl2) );
                $excel->getActiveSheet()->mergeCells('A3:H3');
                $excel
                    ->getActiveSheet()
                    ->getStyle('A3')
                    ->getFont()
                    ->setBold(true);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A3')
                    ->getFont()
                    ->setSize(10);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A3')
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    );
                

                 $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('A3', 'PERIODE ' . strtoupper($tgl2));
                $excel->getActiveSheet()->mergeCells('A3:H2');
                $excel
                    ->getActiveSheet()
                    ->getStyle('A3')
                    ->getFont()
                    ->setBold(true);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A3')
                    ->getFont()
                    ->setSize(10);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A3')
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    );


                // logo

                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setName('Paid');
                $drawing->setDescription('Paid');
                $drawing->setPath('assets/images/logo-print.png'); /* put your path and image here */
                $drawing->setHeight(60);
                $drawing->setCoordinates('B5');
                $drawing->setWorksheet($excel->getActiveSheet());

                // ttd
                $excel->setActiveSheetIndex(0)->setCellValue('F5', 'Cek I');
                $excel
                    ->getActiveSheet()
                    ->getStyle('F5')
                    ->applyFromArray($bold);
                
                $excel->setActiveSheetIndex(0)->setCellValue('F6', 'TTD');
                $excel
                    ->getActiveSheet()
                    ->getStyle('F6')
                    ->applyFromArray($bold);
                   

                $excel->setActiveSheetIndex(0)->setCellValue('G5', 'SYAIFUL BAHRI');
                $excel->getActiveSheet()->mergeCells('G5:H5');
                $excel
                    ->getActiveSheet()
                    ->getStyle('G5:H5')
                    ->applyFromArray($bold);

                $excel->setActiveSheetIndex(0)->setCellValue('F8', 'Cek II');
                $excel
                    ->getActiveSheet()
                    ->getStyle('F8')
                    ->applyFromArray($bold);
                
                $excel->setActiveSheetIndex(0)->setCellValue('F9', 'TTD');
                $excel
                    ->getActiveSheet()
                    ->getStyle('F9')
                    ->applyFromArray($bold);

                $excel->setActiveSheetIndex(0)->setCellValue('G8', 'AGUS ZAINUDDIN');
                $excel->getActiveSheet()->mergeCells('G8:H8');
                $excel
                    ->getActiveSheet()
                    ->getStyle('G8:H8')
                    ->applyFromArray($bold);




                $excel->setActiveSheetIndex(0)->setCellValue('G6', '');
                $excel->getActiveSheet()->mergeCells('G6:H7');

                $excel
                    ->getActiveSheet()
                    ->getStyle('G6:H7')
                    ->applyFromArray($styleArray);

                $excel->setActiveSheetIndex(0)->setCellValue('H9', '');
                $excel->getActiveSheet()->mergeCells('G9:H10');

                $excel
                    ->getActiveSheet()
                    ->getStyle('G9:H10')
                    ->applyFromArray($styleArray);
                

                    
                // kondisi part
                $excel->setActiveSheetIndex(0)->setCellValue('A12', '1. STOCK OPNAME SPARE PART / HGP.');
                $excel->getActiveSheet()->mergeCells('A12:H12');
                $excel->setActiveSheetIndex(0)->setCellValue('A13', 'A. SELISIH KURANG SPARE PART (QUANTITY FISIK ADA, QUANTITY SISTEM ADA)');
                $excel->getActiveSheet()->mergeCells('A13:H13');
                


                

                // header tabel
                $excel->setActiveSheetIndex(0)->setCellValue('A14', 'No');
                $excel->getActiveSheet()->mergeCells('A14:A15');
                $excel->setActiveSheetIndex(0)->setCellValue('B14', 'No Part');
                $excel->getActiveSheet()->mergeCells('B14:B15');
                $excel->setActiveSheetIndex(0)->setCellValue('C14', 'Deskripsi');
                $excel->getActiveSheet()->mergeCells('C14:C15');
                $excel->setActiveSheetIndex(0)->setCellValue('D14', 'HET');
                $excel->getActiveSheet()->mergeCells('D14:D15');
                $excel->setActiveSheetIndex(0)->setCellValue('E14', 'QTY');
                $excel->getActiveSheet()->mergeCells('E14:G14');
                $excel->setActiveSheetIndex(0)->setCellValue('E15', 'Systm');
                $excel->setActiveSheetIndex(0)->setCellValue('F15', 'Fisk');
                $excel->setActiveSheetIndex(0)->setCellValue('G15', 'Selisih');
                $excel->setActiveSheetIndex(0)->setCellValue('H14', 'Amount');
                $excel->getActiveSheet()->mergeCells('H14:H15');
                // $excel->setActiveSheetIndex(0)->setCellValue('J14', 'Amount');
                // $excel->getActiveSheet()->mergeCells('J14:J15');

                
                // STYLE HEADER TABLE
                $excel
                    ->getActiveSheet()
                    ->getStyle('A12')
                    ->applyFromArray($bold);
                $excel
                    ->getActiveSheet()
                    ->getStyle('A13')
                    ->applyFromArray($bold);
                    
                $excel
                    ->getActiveSheet()
                    ->getStyle('A14:A15')
                    ->applyFromArray($style_col)
                    ->applyFromArray($styleArray2);
                $excel
                    ->getActiveSheet()
                    ->getStyle('B14:B15')
                    ->applyFromArray($style_col)
                    ->applyFromArray($styleArray2);
                $excel
                    ->getActiveSheet()
                    ->getStyle('C14:C15')                    
                    ->applyFromArray($style_col)
                    ->applyFromArray($styleArray2);
                $excel
                    ->getActiveSheet()
                    ->getStyle('D14:D15')
                    ->applyFromArray($style_col)
                    ->applyFromArray($styleArray2);
                $excel
                    ->getActiveSheet()
                    ->getStyle('E14:G14')
                    ->applyFromArray($style_col)
                    ->applyFromArray($styleArray2);
                $excel
                    ->getActiveSheet()
                    ->getStyle('E15')
                    ->applyFromArray($style_col)
                    ->applyFromArray($systm)
                    ->applyFromArray($styleArray2);
                $excel
                    ->getActiveSheet()
                    ->getStyle('F15')                    
                    ->applyFromArray($style_col)
                    ->applyFromArray($fisk)
                    ->applyFromArray($styleArray2);
                $excel
                    ->getActiveSheet()
                    ->getStyle('G15')
                    ->applyFromArray($style_col)
                    ->applyFromArray($selisih)
                    ->applyFromArray($styleArray2);
                $excel
                    ->getActiveSheet()
                    ->getStyle('H14:H15')
                    ->applyFromArray($style_col)
                    ->applyFromArray($styleArray2);

                $no = 1;
                $seri = 16;

                foreach ($cetak as $c) {
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('A' . $seri, $no);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('B' . $seri, $c['part_number']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('C' . $seri, $c['deskripsi']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('D' . $seri, $c['harga_jual']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('E' . $seri, $c['qty']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('F' . $seri, $c['qty_fsk']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('G' . $seri, $c['selisih']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('H' . $seri, $c['amount'] );
                    
                        
                        
                
                    $excel
                        ->getActiveSheet()
                        ->getStyle('A' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('B' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('C' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('D' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('E' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('F' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('G' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('H' . $seri)
                        ->applyFromArray($style_row);

                    $no++;
                    $seri++;
                    // var_dump($seri);exit;
                }
                // TOTAL SUM
                // $totselisih = $this->mlapaudit->totalselisihkurang($cabang, $idjadwal_audit, $status, $keterangan);
                // $totamount = $this->mlapaudit->amountkurang($cabang, $idjadwal_audit, $status, $keterangan);
                // $jumlah = [$totselisih[] * $totamount[]];
              
                // var_dump($jumlah);exit;
                // $excel->setActiveSheetIndex(0)->setCellValue('H'.$lastrow4+$lastrow3+$lastrow+21., );
                // $excel
                //     ->getActiveSheet()
                //     ->getStyle('H'.$lastrow4+$lastrow3+$lastrow+21.)
                //     ->applyFromArray($bold);
                // TOTAL AMOUNT


// //matikan
               
//                 // BELUM DITEMUKAN REPORT
                $cetak2 = $this->mlapaudit->cetakPartbelumditemukan($cabang, $idjadwal_audit, $status, $keterangan);
                // var_dump($cetak2);exit;
                $lastrow = $this->mlapaudit->Countpartkurang($cabang, $idjadwal_audit, $status, $keterangan);
//                 // var_dump($lastrow);die;
//                 // $tes = str_replace('A', $lastrow +2, 'A');
//                 // $wktnow = str_replace(':', '', $wktnow);
//                 // var_dump($tes);exit;

                // kondisi part
                $excel->setActiveSheetIndex(0)->setCellValue('A'.$lastrow+18.,'B. SELISIH KURANG SPARE PART (QUANTITY FISIK TIDAK ADA, QUANTITY SISTEM ADA)');
                $excel
                    ->getActiveSheet()
                    ->getStyle('A'.$lastrow+18.)
                    ->applyFromArray($bold);
                // $excel->getActiveSheet()->mergeCells('A'($lastrow+17)':H'($lastrow+17));

                

                $no = 1;
                $seri = $lastrow+19;

                foreach ($cetak2 as $c) {
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('A' . $seri, $no);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('B' . $seri, $c['part_number']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('C' . $seri, $c['deskripsi']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('D' . $seri, $c['harga_jual']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('E' . $seri, $c['qty']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('F' . $seri, $c['qty_fsk']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('G' . $seri, $c['selisih']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('H' . $seri, $c['amount'] );
                    
                        
                        
                    $excel
                        ->getActiveSheet()
                        ->getStyle(('A'.$lastrow+18.). $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('B' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('C' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('D' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('E' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('F' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('G' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('H' . $seri)
                        ->applyFromArray($style_row);

                    $no++;
                    $seri++;
                }

//                 // BELUM DITEMUKAN
                $cetak3 = $this->mlapaudit->cetakPartSesuai($cabang, $idjadwal_audit, $status, $keterangan);
                $lastrow3 = $this->mlapaudit->countbelumditemukan($cabang, $idjadwal_audit, $status, $keterangan);
                // var_dump($lastrow3);die;

                $excel->setActiveSheetIndex(0)->setCellValue('A'.$lastrow3+$lastrow+21.,'C. STOCK SPARE PART YANG TIDAK TERDAPAT SELISIH (SESUAI)');
                $excel
                    ->getActiveSheet()
                    ->getStyle('A'.$lastrow3+$lastrow+21.)
                    ->applyFromArray($bold);

                $no = 1;
                $seri = $lastrow3+$lastrow+22;
                // var_dump($seri);exit;

                foreach ($cetak3 as $c) {
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('A' . $seri, $no);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('B' . $seri, $c['part_number']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('C' . $seri, $c['deskripsi']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('D' . $seri, $c['harga_jual']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('E' . $seri, $c['qty']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('F' . $seri, $c['qty_fsk']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('G' . $seri, $c['selisih']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('H' . $seri, $c['amount'] );
                    
                        
                        
                    $excel
                        ->getActiveSheet()
                        ->getStyle('A' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('B' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('C' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('D' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('E' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('F' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('G' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('H' . $seri)
                        ->applyFromArray($style_row);

                    $no++;
                    $seri++;
                }

//                 //LEBIH REPORT
                $cetak4 = $this->mlapaudit->cetakPartLebih($cabang, $idjadwal_audit, $status, $keterangan);
                $lastrow4 = $this->mlapaudit->countpartsesuai($cabang, $idjadwal_audit, $status, $keterangan);

                $excel->setActiveSheetIndex(0)->setCellValue('A'.$lastrow4+$lastrow3+$lastrow+24.,'D. SELISIH LEBIH SPARE PART (QUANTITY SISTEM ADA, QUANTITY FISIK ADA)');
                $excel
                    ->getActiveSheet()
                    ->getStyle('A'.$lastrow4+$lastrow3+$lastrow+24.)
                    ->applyFromArray($bold);
                

                $no = 1;
                $seri = $lastrow4+$lastrow3+$lastrow+25;

                foreach ($cetak4 as $c) {
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('A' . $seri, $no);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('B' . $seri, $c['part_number']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('C' . $seri, $c['deskripsi']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('D' . $seri, $c['harga_jual']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('E' . $seri, $c['qty']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('F' . $seri, $c['qty_fsk']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('G' . $seri, $c['selisih']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('H' . $seri, $c['amount'] );
                    
                        
                        
                    $excel
                        ->getActiveSheet()
                        ->getStyle('A' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('B' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('C' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('D' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('E' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('F' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('G' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('H' . $seri)
                        ->applyFromArray($style_row);

                    $no++;
                    $seri++;
                }

                //MANUAL REPORT
                $cetak5 = $this->mlapaudit->cetakpartqty($cabang, $idjadwal_audit, $qty);
                $lastrow5 = $this->mlapaudit->countpartqty($cabang, $idjadwal_audit, $qty);

                // kondisi part
                $excel->setActiveSheetIndex(0)->setCellValue('A'.$lastrow4+$lastrow3+$lastrow+28.,'E. SELISIH LEBIH SPARE PART (QUANTITY SISTEM TIDAK ADA, QUANTITY FISIK ADA)');
                $excel
                    ->getActiveSheet()
                    ->getStyle('A'.$lastrow4+$lastrow3+$lastrow+28.)
                    ->applyFromArray($bold);

                $no = 1;
                $seri = $lastrow4+$lastrow3+$lastrow+29;

                foreach ($cetak5 as $c) {
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('A' . $seri, $no);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('B' . $seri, $c['part_number']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('C' . $seri, $c['deskripsi']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('D' . $seri, $c['harga_jual']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('E' . $seri, $c['qty']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('F' . $seri, $c['qty_fsk']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('G' . $seri, $c['selisih']);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('H' . $seri, $c['amount'] );
                    
                        
                        
                    $excel
                        ->getActiveSheet()
                        ->getStyle('A' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('B' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('C' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('D' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('E' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('F' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('G' . $seri)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('H' . $seri)
                        ->applyFromArray($style_row);

                    $no++;
                    $seri++;
                }




                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('A')
                    ->setWidth(5);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('B')
                    ->setWidth(20);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('C')
                    ->setWidth(30);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('D')
                    ->setWidth(10);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('E')
                    ->setWidth(7);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('F')
                    ->setWidth(7);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('G')
                    ->setWidth(7);
                $excel
                    ->getActiveSheet()
                    ->getColumnDimension('H')
                    ->setWidth(10);

                $excel
                    ->getActiveSheet()
                    ->getDefaultRowDimension()
                    ->setRowHeight(-1);

                $excel
                    ->getActiveSheet()
                    ->getPageSetup()
                    ->setOrientation(
                        \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT
                    );
                

                
                
                $statu = strtoupper($status);
                $excel->getActiveSheet(0)->setTitle($statu . $tgl);
                $excel->setActiveSheetIndex(0);
                header(
                    'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                );
                header(
                    'Content-Disposition: attachment; filename=REPORT-PART' .
                        $status .
                        $tgl .
                        '.xlsx'
                );
                header('Cache-Control: max-age=0');
                $write = new Xlsx($excel);
                $write->save('php://output');
            } elseif ($type == 'pdf') {
                $pdf = new reportProduct();
                $pdf->setKriteria('status');
                $pdf->AliasNbPages();
                $pdf->AddPage('P', 'A4');
                $cab = $this->mlapaudit->getCabangbyId($cabang);
                foreach ($cab as $c) {
                    $cab = $c['nama_cabang'];
                }

                $stat = strtoupper($status);
                $pdf->SetFont('Arial', 'B', '12');
                $pdf->Cell(190, 7, 'TEMUAN AUDIT ' . $stat, 0, 1, 'C');
                $pdf->Cell(190, 7, 'CABANG ' . $cab, 0, 1, 'C');
                $pdf->Cell(
                    190,
                    7,
                    'PERIODE ' . $tgl_awal . ' s/d ' . $tgl_akhir,
                    0,
                    1,
                    'C'
                );
                $pdf->Cell(10, 7, '', 0, 1);
                $pdf->SetFont('Arial', 'B', 8);
                $pdf->Cell(8, 6, 'NO', 1, 0, 'C');
                $pdf->Cell(25, 6, 'NO MESIN', 1, 0, 'C');
                $pdf->Cell(28, 6, 'NO RANGKA', 1, 0, 'C');
                $pdf->Cell(25, 6, 'KODE ITEM', 1, 0, 'C');
                $pdf->Cell(27, 6, 'TYPE UNIT', 1, 0, 'C');
                $pdf->Cell(20, 6, 'USIA UNIT', 1, 0, 'C');
                $pdf->Cell(40, 6, 'LOKASI', 1, 0, 'C');
                $pdf->Cell(20, 6, 'STATUS', 1, 1, 'C');

                $pdf->SetFont('Arial', 'B', 8);
                $start = 0;

                // var_dump($cetak);die;
                $no = 1;
                foreach ($cetak as $c) {
                    $pdf->Cell(8, 6, $no, 1, 0, 'C');
                    $pdf->Cell(25, 6, $c['part_number'], 1, 0);
                    $pdf->Cell(28, 6, $c['no_rangka'], 1, 0);
                    $pdf->Cell(25, 6, $c['kode_item'], 1, 0);
                    $pdf->Cell(27, 6, $c['type'], 1, 0);
                    $pdf->Cell(20, 6, $c['umur_unit'], 1, 0, 'C');
                    $pdf->Cell(40, 6, $c['nama_gudang'], 1, 0);
                    $pdf->Cell(20, 6, $c['status_unit'], 1, 1);
                    $no++;
                    $start = $start + 15;
                }

                // $pdf->Output('D','REPORT-'.$stat.'.pdf');
                header('Content-type: application/PDF');
                $pdf->Output('D', 'REPORT-' . $stat . '.pdf');
                // $pdf->Output();
            }
        } else {
            echo "<script>alert('Data tidak ditemukan'); history.go(-1);</script>";
        }
    
    }
}

/* End of file laporan_auditor.php */
