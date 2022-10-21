<?php


defined('BASEPATH') or exit('No direct script access allowed');

use Fpdf\Fpdf;

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
            if ($this->session->userdata('usergroup') == 'UG002'  || $this->session->userdata('usergroup') == 'UG003' || $this->session->userdata('usergroup') == 'UG005') {
            } else {
                redirect('error');
            }
        }
    }

    public function Laporan_Unit()
    {

        $data = [
            'judul' => "Audit Data Unit",
            'judul1' => 'Laporan Auditor'
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/laporan_unit/v_filter_kondisi.php', $data);
        $this->load->view('auditorview/laporan_unit/_partial/footer.php');
    }
    public function Laporan_Part()
    {

        $data = [
            'judul' => "Audit Data Unit",
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/laporan_part/v_laporan_part.php', $data);
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
            $tgl_awal = date("Y-m-d");
            $tgl_akhir = "1900-01-01";
            foreach ($cetak as $c) {
                if ($tgl_awal > $c['tanggal_audit']) {
                    $tgl_awal = $c['tanggal_audit'];
                }

                if ($tgl_akhir < $c['tanggal_audit']) {
                    $tgl_akhir = $c['tanggal_audit'];
                }
            }

            $pdf = new reportProduct();
            $pdf->setKriteria('report');
            $pdf->setNama($cab);
            $pdf->AliasNbPages();
            $pdf->AddPage("P", "A4");
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
            $pdf->Cell(8, 15, 'No', 1, 0, 'C', TRUE);
            $pdf->Cell(25, 15, 'No Mesin', 1, 0, 'C', TRUE);
            $pdf->Cell(28, 15, 'No Rangka', 1, 0, 'C', TRUE);
            $pdf->Cell(27, 15, 'Type Unit', 1, 0, 'C', TRUE);
            $pdf->Cell(20, 15, 'Umur Unit', 1, 0, 'C', TRUE);
            $pdf->Cell(25, 15, 'Lokasi', 1, 0, 'C', TRUE);
            $pdf->Cell(25, 15, 'Status Unit', 1, 0, 'C', TRUE);
            $pdf->Cell(25, 15, 'Keterangan', 1, 1, 'C', TRUE);
            $start = null;
            $cetak = $this->mlapaudit->auditPdf($cabang, $idjadwal_audit, $start);
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
                $pdf->myCell(20, 7, $x, (($c['umur_unit'] == "") ? "-" : ($c['umur_unit'] . ' tahun')));
                $x = $pdf->GetX();
                $pdf->myCell(25, 7, $x, $c['nama_gudang']);
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
    public function cetakexcel()
    {
        $excel = new PHPExcel();
        $tgl = date('Ymd');
        $type = $this->input->post('type');
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $status = $this->input->post('status');

        $tgl_awal = date("Y-m-d");
        $tgl_akhir = "1900-01-01";
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
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                        'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                        'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                        'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN]
                    ]

                ];

                $style_row = [
                    'alignment' => [
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                        'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                        'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                        'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN]
                    ]
                ];
                $cab = $this->mlapaudit->getCabangbyId($cabang);
                foreach ($cab as $c) {
                    $cab = $c['nama_cabang'];
                }
                $excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
                $excel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTop('A5');

                $excel->setActiveSheetIndex(0)->setCellValue('A1', 'TEMUAN AUDIT ' . strtoupper($status));
                $excel->getActiveSheet()->mergeCells('A1:H1');
                $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
                $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
                $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $excel->setActiveSheetIndex(0)->setCellValue('A2', 'CABANG ' . $cab);
                $excel->getActiveSheet()->mergeCells('A2:H2');
                $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
                $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
                $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $excel->setActiveSheetIndex(0)->setCellValue('A5', 'NO.');
                $excel->setActiveSheetIndex(0)->setCellValue('B5', 'NO. MESIN');
                $excel->setActiveSheetIndex(0)->setCellValue('C5', 'NO. RANGKA');
                $excel->setActiveSheetIndex(0)->setCellValue('D5', 'KODE ITEM');
                $excel->setActiveSheetIndex(0)->setCellValue('E5', 'TYPE UNIT');
                $excel->setActiveSheetIndex(0)->setCellValue('F5', 'USIA UNIT');
                $excel->setActiveSheetIndex(0)->setCellValue('G5', 'LOKASI');
                $excel->setActiveSheetIndex(0)->setCellValue('H5', 'STATUS');

                $excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
                $excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
                $excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
                $excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
                $excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
                $excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
                $excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_col);
                $excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_col);

                $no = 1;
                $seri = 6;

                foreach ($cetak as $c) {
                    $excel->setActiveSheetIndex(0)->setCellValue('A' . $seri, $no);
                    $excel->setActiveSheetIndex(0)->setCellValue('B' . $seri, $c['no_mesin']);
                    $excel->setActiveSheetIndex(0)->setCellValue('C' . $seri, $c['no_rangka']);
                    $excel->setActiveSheetIndex(0)->setCellValue('D' . $seri, $c['kode_item']);
                    $excel->setActiveSheetIndex(0)->setCellValue('E' . $seri, $c['type']);
                    $excel->setActiveSheetIndex(0)->setCellValue('F' . $seri, $c['umur_unit']);
                    $excel->setActiveSheetIndex(0)->setCellValue('G' . $seri, $c['nama_gudang']);
                    $excel->setActiveSheetIndex(0)->setCellValue('H' . $seri, strtoupper($c['status_unit']));

                    $excel->getActiveSheet()->getStyle('A' . $seri)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('B' . $seri)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('C' . $seri)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('D' . $seri)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('E' . $seri)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('F' . $seri)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('G' . $seri)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('H' . $seri)->applyFromArray($style_row);

                    $no++;
                    $seri++;
                }

                $excel->setActiveSheetIndex(0)->setCellValue('A3', 'PERIODE ' . $tgl_awal . ' s/d ' . $tgl_akhir);
                $excel->getActiveSheet()->mergeCells('A3:H3');
                $excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE);
                $excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
                $excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
                $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
                $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
                $excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
                $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
                $excel->getActiveSheet()->getColumnDimension('H')->setWidth(25);

                $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

                $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
                $statu = strtoupper($status);
                $excel->getActiveSheet(0)->setTitle($statu . $tgl);
                $excel->setActiveSheetIndex(0);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header("Content-Disposition: attachment; filename=REPORT-UNIT" . $statu . $tgl . ".xlsx"); // Set nama file excel nya
                header('Cache-Control: max-age=0');
                $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
                $write->save('php://output');
            } elseif ($type == 'pdf') {
                $pdf = new reportProduct();
                $pdf->setKriteria('status');
                $pdf->AliasNbPages();
                $pdf->AddPage("P", "A4");
                $cab = $this->mlapaudit->getCabangbyId($cabang);
                foreach ($cab as $c) {
                    $cab = $c['nama_cabang'];
                }

                $stat = strtoupper($status);
                $pdf->SetFont('Arial', 'B', '12');
                $pdf->Cell(190, 7, 'TEMUAN AUDIT ' . $stat, 0, 1, 'C');
                $pdf->Cell(190, 7, 'CABANG ' . $cab, 0, 1, 'C');
                $pdf->Cell(190, 7, 'PERIODE ' . $tgl_awal . ' s/d ' . $tgl_akhir, 0, 1, 'C');
                $pdf->Cell(10, 7, '', 0, 1);

                $pdf->SetFont('Arial', 'B', 8);
                $pdf->Cell(8, 6, 'NO', 1, 0, 'C');
                $pdf->Cell(25, 6, 'NO MESIN', 1, 0, 'C');
                $pdf->Cell(28, 6, 'NO RANGKA', 1, 0, 'C');
                $pdf->Cell(25, 6, 'KODE ITEM', 1, 0, 'C');
                $pdf->Cell(27, 6, 'TYPE UNIT', 1, 0, 'C');
                $pdf->Cell(25, 6, 'USIA UNIT', 1, 0, 'C');
                $pdf->Cell(25, 6, 'LOKASI', 1, 0, 'C');
                $pdf->Cell(25, 6, 'STATUS', 1, 1, 'C');

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
                    $pdf->Cell(25, 6, $c['umur_unit'], 1, 0, 'C');
                    $pdf->Cell(25, 6, $c['nama_gudang'], 1, 0);
                    $pdf->Cell(25, 6, $c['status_unit'], 1, 1);
                    $no++;
                    $start = $start + 15;
                }

                // $pdf->Output('D','REPORT-'.$stat.'.pdf');
                header("Content-type: application/PDF");
                $pdf->Output('D', 'REPORT-' . $stat . '.pdf');
                // $pdf->Output();
            }
        } else {
            echo "<script>alert('Data tidak ditemukan'); history.go(-1);</script>";
        }
    }

    public function cetakexcelnotready()
    {
        $excel = new PHPExcel();
        $tgl = "";
        $type = $this->input->post('type');
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $is_ready = $this->input->post('ready');
        $cetak = $this->mlapaudit->cetakUnitnotready($cabang, $idjadwal_audit, $is_ready);
        if ($cetak) {

            $tgl_awal = date("Y-m-d");
            $tgl_akhir = "1900-01-01";
            foreach ($cetak as $c) {
                if ($tgl_awal > $c['tanggal_audit']) {
                    $tgl_awal = $c['tanggal_audit'];
                }

                if ($tgl_akhir < $c['tanggal_audit']) {
                    $tgl_akhir = $c['tanggal_audit'];
                }
            }
            $tgl = $tgl_awal . " s/d " . $tgl_akhir;

            if ($type == 'excel') {
                $style_col = [
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                        'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                        'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                        'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN]
                    ]

                ];

                $style_row = [
                    'alignment' => [
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                        'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                        'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                        'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN]
                    ]
                ];
                $cab = $this->mlapaudit->getCabangbyId($cabang);
                foreach ($cab as $c) {
                    $cab = $c['nama_cabang'];
                }
                $excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
                $excel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTop('A5');

                $excel->setActiveSheetIndex(0)->setCellValue('A1', 'TEMUAN AUDIT NOT READY');
                $excel->getActiveSheet()->mergeCells('A1:H1');
                $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
                $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
                $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $excel->setActiveSheetIndex(0)->setCellValue('A2', 'CABANG ' . $cab);
                $excel->getActiveSheet()->mergeCells('A2:H2');
                $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE);
                $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(14);
                $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $excel->setActiveSheetIndex(0)->setCellValue('A3', 'PERIODE ' . $tgl);
                $excel->getActiveSheet()->mergeCells('A3:H3');
                $excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE);
                $excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
                $excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $excel->setActiveSheetIndex(0)->setCellValue('A5', 'NO.');
                $excel->setActiveSheetIndex(0)->setCellValue('B5', 'NO. MESIN');
                $excel->setActiveSheetIndex(0)->setCellValue('C5', 'NO. RANGKA');
                $excel->setActiveSheetIndex(0)->setCellValue('D5', 'KODE ITEM');
                $excel->setActiveSheetIndex(0)->setCellValue('E5', 'TYPE UNIT');
                $excel->setActiveSheetIndex(0)->setCellValue('F5', 'USIA UNIT');
                $excel->setActiveSheetIndex(0)->setCellValue('G5', 'LOKASI');
                $excel->setActiveSheetIndex(0)->setCellValue('H5', 'READY');

                $excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
                $excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
                $excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
                $excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
                $excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
                $excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
                $excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_col);
                $excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_col);

                $no = 1;
                $seri = 6;

                foreach ($cetak as $c) {
                    // var_dump($c);die;
                    $excel->setActiveSheetIndex(0)->setCellValue('A' . $seri, $no);
                    $excel->setActiveSheetIndex(0)->setCellValue('B' . $seri, $c['no_mesin']);
                    $excel->setActiveSheetIndex(0)->setCellValue('C' . $seri, $c['no_rangka']);
                    $excel->setActiveSheetIndex(0)->setCellValue('D' . $seri, $c['kode_item']);
                    $excel->setActiveSheetIndex(0)->setCellValue('E' . $seri, $c['type']);
                    $excel->setActiveSheetIndex(0)->setCellValue('F' . $seri, $c['umur_unit']);
                    $excel->setActiveSheetIndex(0)->setCellValue('G' . $seri, $c['nama_gudang']);
                    $excel->setActiveSheetIndex(0)->setCellValue('H' . $seri, $c['is_ready']);

                    $excel->getActiveSheet()->getStyle('A' . $seri)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('B' . $seri)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('C' . $seri)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('D' . $seri)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('E' . $seri)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('F' . $seri)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('G' . $seri)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('H' . $seri)->applyFromArray($style_row);

                    $no++;
                    $seri++;
                }

                $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
                $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
                $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
                $excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
                $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
                $excel->getActiveSheet()->getColumnDimension('H')->setWidth(25);

                $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

                $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
                $ready = strtoupper($is_ready);
                $excel->getActiveSheet(0)->setTitle($ready . $idjadwal_audit);
                $excel->setActiveSheetIndex(0);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header("Content-Disposition: attachment; filename=REPORT-UNIT" . $ready . $idjadwal_audit . ".xlsx"); // Set nama file excel nya
                header('Cache-Control: max-age=0');
                $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
                // var_dump($write);die;
                $write->save('php://output');
            } elseif ($type == 'pdf') {

                $pdf = new reportProduct();
                $pdf->setKriteria('status');
                $pdf->AliasNbPages();
                $pdf->AddPage("P", "A4");
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
                header("Content-type: application/PDF");
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
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 3;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;&nbsp;';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['cur_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = $this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        $start = ($page - 1) * $config['per_page'];

        $cetak = $this->mlapaudit->prevAksesoris($cabang, $idjadwal_audit, $start);
        $row_entry = '
                <div class=" label label-default">' . $count . '</div>
            ';
        $output = [
            'pagination_link'   => $this->pagination->create_links(),
            'aksesoris'         => $cetak,
            'row_entry' => $row_entry,
        ];

        echo json_encode($output);
    }
    public function cetakperlokasi()
    {
        $tgl = "";
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
        $cetak = $this->mlapaudit->prevAksesorisPdf($cabang, $idjadwal_audit, $start);
        if ($cetak != null) {

            $tgl_awal = date("Y-m-d");
            $tgl_akhir = "1900-01-01";
            foreach ($cetak as $c) {
                if ($tgl_awal > $c['tanggal_audit']) {
                    $tgl_awal = $c['tanggal_audit'];
                }

                if ($tgl_akhir < $c['tanggal_audit']) {
                    $tgl_akhir = $c['tanggal_audit'];
                }
            }
            $tgl = $tgl_awal . " s/d " . $tgl_akhir;

            $pdf = new reportProduct();
            $pdf->setKriteria('report');
            $pdf->setNama($cab);
            $pdf->AliasNbPages();
            $pdf->AddPage("P", "A4");
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
            $pdf->Cell(30, 15, 'Jenis Kelengkapan', 1, 0, 'C', TRUE);
            $pdf->Cell(25, 15, 'QTY Unit', 1, 0, 'C', TRUE);
            $pdf->Cell(35, 15, 'QTY Fisik Aksesoris', 1, 0, 'C', TRUE);
            $pdf->Cell(27, 15, 'Selisih', 1, 0, 'C', TRUE);
            $pdf->Cell(20, 15, 'Keterangan', 1, 1, 'C', TRUE);
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

            $count = $this->mlapaudit->countunitnotready($cabang, $idjadwal_audit, $is_ready);
            // $base= 'lap_belum_ditemukan';
            $config['base_url'] = base_url() . 'laporan_auditor/previewnotready';
            $config['total_rows'] = $count;
            $config['per_page'] = 15;
            $config['uri_segment'] = 3;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 3;

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = '&gt;';
            $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&lt;&nbsp;';
            $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['cur_tag_close'] = '</li>';

            $this->pagination->initialize($config);

            $page = $this->uri->segment(3);
            if ($page == null) {
                $page = 1;
            }
            $start = ($page - 1) * $config['per_page'];

            $cetak = $this->mlapaudit->previewUnitnotready($cabang, $idjadwal_audit, $is_ready, $start);
            $row_entry = '
                    <div class=" label label-default">' . $count . '</div>
                ';
        }

        $output = [
            // 'pagination_link'   => $count,
            'pagination_link'   => $this->pagination->create_links(),
            'unit_list'         => $cetak,
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

            $count = $this->mlapaudit->countunit($cabang, $idjadwal_audit, $status);
            // $base= 'lap_belum_ditemukan';
            $config['base_url'] = base_url() . 'laporan_auditor/preview';
            $config['total_rows'] = $count;
            $config['per_page'] = 15;
            $config['uri_segment'] = 3;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 3;

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = '&gt;';
            $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&lt;&nbsp;';
            $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['cur_tag_close'] = '</li>';

            $this->pagination->initialize($config);

            $page = $this->uri->segment(3);
            if ($page == null) {
                $page = 1;
            }
            $start = ($page - 1) * $config['per_page'];

            $cetak = $this->mlapaudit->previewUnit($cabang, $idjadwal_audit, $status, $start);
            $row_entry = '
                    <div class=" label label-default">' . $count . '</div>
                ';
        } elseif ($status == null) {
            $count = $this->mlapaudit->countunitvalid($cabang, $idjadwal_audit);
            // $count= 13;
            // $this->load->library('pagination');
            $config['base_url'] = base_url() . 'laporan_auditor/preview';
            $config['total_rows'] = $count;
            $config['per_page'] = 15;
            $config['uri_segment'] = 3;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 3;

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = '&gt;';
            $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&lt;&nbsp;';
            $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['cur_tag_close'] = '</li>';

            $this->pagination->initialize($config);

            $page = $this->uri->segment(3);
            if ($page == null) {
                $page = 1;
            }
            $start = ($page - 1) * $config['per_page'];

            $cetak = $this->mlapaudit->auditUnit($cabang, $idjadwal_audit, $start);
            $row_entry = '
                    <div class=" label label-default">' . $count . '</div>
                ';
        }

        $output = [
            // 'pagination_link'   => $count,
            'pagination_link'   => $this->pagination->create_links(),
            'unit_list'         => $cetak,
            'row_entry' => $row_entry,
        ];

        echo json_encode($output);
    }
    public function previewPart()
    {
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $this->load->library('pagination');

        $count = $this->mlapaudit->countpartvalid($cabang, $idjadwal_audit);
        // $count= 13;
        // $this->load->library('pagination');
        $config['base_url'] = base_url() . 'laporan_auditor/previewpart';
        $config['total_rows'] = $count;
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 3;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;&nbsp;';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['cur_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = $this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        $start = ($page - 1) * $config['per_page'];

        $cetak = $this->mlapaudit->auditPart($cabang, $idjadwal_audit, $start);
        $row_entry = '
                    <div class=" label label-default">' . $count . '</div>
                ';

        $output = [
            // 'pagination_link'   => $count,
            'pagination_link'   => $this->pagination->create_links(),
            'part_list'         => $cetak,
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
        $tgl_awal = "";
        $tgl_akhir = "";


        $cab = $this->mlapaudit->getCabangbyId($cabang);
        foreach ($cab as $c) {
            $cab = $c['nama_cabang'];
        }
        $start = 0;
        $cetak = $this->mlapaudit->partvalid($cabang, $idjadwal_audit);

        if ($cetak != null) {
            $tgl_awal = date("Y-m-d");
            $tgl_akhir = "1900-01-01";
            foreach ($cetak as $c) {
                if ($tgl_awal > $c['tanggal_audit']) {
                    $tgl_awal = $c['tanggal_audit'];
                }

                if ($tgl_akhir < $c['tanggal_audit']) {
                    $tgl_akhir = $c['tanggal_audit'];
                }
            }
            $tgl = $tgl_awal . " s/d " . $tgl_akhir;

            $pdf = new reportProduct();
            $pdf->setKriteria('report');
            $pdf->setNama($cab);
            $pdf->AliasNbPages();
            $pdf->AddPage("P", "A4");
            $pdf->SetFont('Times', 'B', '16');
            $pdf->Cell(0, 30, 'Kertas Kerja Audit', 0, 1, 'L');
            $pdf->SetFont('Times', '', '10');
            $pdf->SetXY(120, 34);
            $pdf->cell(0, 0, 'Auditee', 0, 1);
            $pdf->SetXY(152, 34);
            $pdf->cell(0, 0, ': Part', 0, 1);
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
            $pdf->Cell(8, 15, 'No', 1, 0, 'C', TRUE);
            $pdf->Cell(25, 15, 'LOKASI', 1, 0, 'C', TRUE);
            $pdf->Cell(28, 15, 'PART NUMBER', 1, 0, 'C', TRUE);
            $pdf->Cell(27, 15, 'DESKRIPSI', 1, 0, 'C', TRUE);
            $pdf->Cell(20, 15, 'KD RAK BIN', 1, 0, 'C', TRUE);
            $pdf->Cell(25, 15, 'QTY', 1, 1, 'C', TRUE);
            $start = null;

            $no = 1;
            $pdf->SetFont('Times', '', 8);
            foreach ($cetak as $c) {
                $pdf->Cell(8, 6, $no, 1, 0, 'C');
                $pdf->Cell(25, 6, $c['nama_gudang'], 1, 0);
                $pdf->Cell(28, 6, $c['part_number'], 1, 0);
                $pdf->Cell(27, 6, $c['deskripsi'], 1, 0);
                $pdf->Cell(20, 6, $c['kd_lokasi_rak'], 1, 0, 'C');
                $pdf->Cell(25, 6, $c['qty'], 1, 1);
                $no++;
            }
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

            redirect('laporan_auditor/lap_audit_unit', 'refresh');
        }
    }

    public function Filter_Cabang()
    {
        $data = [
            'judul' => "Filter Cabang",
            'judul1' => 'Laporan Auditor'
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/laporan_unit/v_filter_cabang.php', $data);
        $this->load->view('auditorview/laporan_unit/_partial/footer.php');
    }

    public function Filter_Kondisi()
    {
        $data = [
            'judul' => "Filter Cabang",
            'judul1' => 'Laporan Auditor'
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/laporan_unit/v_filter_kondisi.php', $data);
        $this->load->view('auditorview/laporan_unit/_partial/footer.php');
    }


    public function Lap_Audit_unit()
    {
        $data = [
            'judul' => "Laporan Audit Unit",
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/laporan_unit/v_laporan_audit_unit.php', $data);
        $this->load->view('auditorview/laporan_unit/_partial/footer.php');
    }

    public function Lap_Perlokasi()
    {
        $data = [
            'judul' => "Laporan Perlokasi",
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),

        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/laporan_unit/v_laporan_perlokasi.php', $data);
        $this->load->view('auditorview/laporan_unit/_partial/footer3.php');
    }

    public function Lap_sesuai()
    {
        $data = [
            'judul' => "Laporan Data Sesuai",
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),
        ];

        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/laporan_unit/v_laporan_sesuai.php', $data);
        $this->load->view('auditorview/laporan_unit/_partial/footer.php');
    }

    public function Lap_belum_sesuai()
    {
        $data = [
            'judul' => "Laporan Data Belum Sesuai",
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/laporan_unit/v_laporan_belum_sesuai.php', $data);
        $this->load->view('auditorview/laporan_unit/_partial/footer.php');
    }

    public function Lap_belum_ditemukan()
    {
        $data = [
            'judul' => "Laporan Belum Ditemukan",
            'tgl' => date('m/d/Y'),
            'judul1' => 'Laporan Auditor',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/laporan_unit/v_laporan_belum_ditemukan.php', $data);
        $this->load->view('auditorview/laporan_unit/_partial/footer.php');
    }

    public function Lap_not_ready()
    {
        $data = [
            'judul' => "Laporan Not Ready",
            'judul1' => 'Laporan Auditor',
            'tgl' => date('m/d/Y'),
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/laporan_unit/v_laporan_not_ready.php', $data);
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
            $output .= '
				<option value="' . $list['id_cabang'] . '">' . $list['id_cabang'] . ' - ' . $list['nama_cabang'] . '</option>
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
                $output .= '
                <tr> 
                    <td>' . $no . '</td>
                    <td>
                    <a id="' . $list['id_usergroup'] . '" class="text-warning"><i class="fa fa-pencil"></i></a>
                    <a href="' . $base . 'master_data/delete_usergroup/' . $list['id_usergroup'] . '" class="text-danger" onclick=\'return confirm("Konfirmasi menghapus data ' . $list['id_usergroup'] . ' - ' . $list['user_group'] . ' ? ");\'><i class="fa fa-trash"></i></a>
                    </td>
                    <td>' . $list['id_usergroup'] . '</td>
                    <td>' . $list['user_group'] . '</td>
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
}

/* End of file laporan_auditor.php */
