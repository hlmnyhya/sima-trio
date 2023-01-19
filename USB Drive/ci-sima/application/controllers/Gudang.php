<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Zend\Barcode\Barcode;

class Gudang extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        ini_set('max_execution_time', 0);
        $this->load->model('m_barcode', 'mbarcode');
    
        $this->load->model('m_laporan_auditor', 'mlapaudit');
        $this->load->model('m_transaksi_auditor', 'mtransauditor');
        $this->load->model('m_transaksi_ga', 'mtransga');
        $this->load->model('m_master_data', 'mmasdat');
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Login Dulu!</div>');

            redirect('login/sima_login');
        } else {
            if ($this->session->userdata('usergroup') == 'UG006' || $this->session->userdata('usergroup') == 'UG005') {
            } else {
                redirect('error');
            }
        }
    }

    public function Part()
    {
        $data = [
            'judul' => "Data Part",
            'judul1' => 'Cetak Barcode',
            'tgl' => date('m/d/Y')
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('gudangview/barcode_part/v_data_part.php', $data);
        $this->load->view('gudangview/barcode_part/_partial/footer.php');
    }

    public function Unit()
    {
        $data = [
            'judul' => "Data Unit",
            'judul1' => 'Cetak Barcode',
            'tgl' => date('m/d/Y')
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('gudangview/barcode_unit/v_data_unit.php', $data);
        $this->load->view('gudangview/barcode_unit/_partial/footer.php');
    }


    public function Office()
    {
        $data = [
            'judul' => "Data Office",
            'judul1' => 'Cetak Barcode',
            'tgl' => date('m/d/Y')
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('gudangview/barcode_office/v_data_office.php', $data);
        $this->load->view('gudangview/barcode_office/_partial/footer.php');
    }

    public function ajax_get_cabang2()
    {
        $output = '';
        $no = 0;
        $listcabang = $this->mbarcode->getCabang();
        foreach ($listcabang as $list) {
            $no++;
            $output .= '
				<option value="' . $list['id_cabang'] . '">' . $list['id_cabang'] . ' - ' . $list['nama_cabang'] . '</option>
			';
        }
        echo '<option value="">-- Pilih Cabang --</option>';
        echo $output;
    }
    public function preview()
    {
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $status = $this->input->post('status');

        $count = $this->mtransauditor->countunit($cabang, $idjadwal_audit, $status);
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'transaksi_auditor/preview';
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

        $cetak = $this->mbarcode->previewUnit($cabang, $idjadwal_audit, $status, $start);
        $row_entry = '
                <div class=" label label-default">' . $count . '</div>
            ';
        $output = [
            'pagination_link'   => $this->pagination->create_links(),
            'unit_list'         => $cetak,
            'row_entry' => $row_entry,
        ];

        echo json_encode($output);
    }
    public function previewPart()
    {
        $cabang = $this->input->post('id_cabang');
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_awal = strtotime($tgl_awal);
        $tgl_awal = date('Y-m-d', $tgl_awal);
        $tgl_akhir = $this->input->post('tgl_akhir');
        $tgl_akhir = strtotime($tgl_akhir);
        $tgl_akhir = date('Y-m-d', $tgl_akhir);
        // var_dump($this->input->post());die;
        $this->load->library('pagination');

        $count = $this->mlapaudit->countpartvalid($cabang, $tgl_awal, $tgl_akhir);
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

        $cetak = $this->mbarcode->auditPart($cabang, $tgl_awal, $tgl_akhir, $start);
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
    public function cetak()
    {
        $id = $this->input->get('id');
        // var_dump(FCPATH);die;
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = 'assets/'; //string, the default is application/cache/
        $config['errorlog']     = 'assets/'; //string, the default is application/logs/
        $config['imagedir']     = 'assets/images/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        $detail = $this->mbarcode->getUnit($id);
        foreach ($detail as $d) {
            $no_mesin = $d['no_mesin'];
            $tipe = $d['type'];
            $kode = $d['kode_item'];
            $no_rangka = $d['no_rangka'];
        }

        $image_name = $no_mesin . '.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $no_mesin; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $pdf = new reportProduct();
        $pdf->setKriteria('status');
        $pdf->AliasNbPages();
        $pdf->AddPage("P", "A4");

        $pdf->Image(FCPATH . 'assets/images/' . $image_name, 40, 10, 14, 14);
        
     
        $pdf->Rect(40, 8, 41, 16);
        // $pdf->Rect(41, 10, 12, 13);
        $pdf->Rect(63, 11.5, 17, 3);
        $pdf->Rect(63, 16, 17, 3);
        $pdf->Rect(63, 20, 17, 3);
        $pdf->SetFont('Arial', '', 5);
        $pdf->SetXY(53, 13);
        $pdf->cell(12, 0, "No. Mesin  ", 16, 12);
        $pdf->SetXY(63, 13);
        $pdf->cell(0, 0, $no_mesin, 0, 1);
        $pdf->SetXY(53, 18);
        $pdf->cell(0, 0, "Tipe Unit ", 0, 1);
        $pdf->SetXY(63, 17.6);
        $pdf->cell(0, 0, $tipe, 0, 1);
        $pdf->SetXY(53, 22);
        $pdf->cell(0, 0, "Kode Item ", 0, 1);
        $pdf->SetXY(63, 21.6);
        $pdf->cell(0, 0, $kode, 0, 1);

        //No Rangka
        $image_name1 = $no_rangka . '.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $no_rangka; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 5;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name1; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $pdf->Image(FCPATH . 'assets/images/' . $image_name1, 90, 10, 14, 14);
        $pdf->Rect(90, 8, 41, 16);
        $pdf->SetFont('Arial', 'B', 8 );
        $pdf->SetXY(106, 13);
        $pdf->cell(0, 0, "No. Rangka", 0, 1);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(104, 18);
        $pdf->cell(0, 0, $no_rangka, 0, 1);

        //BARCODE
        $pdf->SetFont('Arial', 'B', 6);
        $pdf->Code128(39, 40, $no_mesin, 40, 12.5);
        $pdf->SetFont('Arial', 'B', 8);

        $pdf->Rect(34, 35, 50, 18);
        $pdf->SetXY(42, 35);
        $pdf->Write(5, 'No. Mesin. ' . $no_mesin);

        $pdf->SetFont('Arial', 'B', 6);
        $pdf->Code128(96, 40, $no_rangka, 40, 12.5);
        $pdf->SetFont('Arial', 'B', 8);

        $pdf->Rect(92, 35, 50, 18);
        $pdf->SetXY(95, 34);
        $pdf->Write(7, 'No. Rangka. ' . $no_rangka);
        // $pdf->Output('D','REPORT-'.$stat.'.pdf');
        header("Content-type: application/PDF");
        // $pdf->Output('D','QRCODE.pdf');
        $pdf->Output();
    }
    public function cetakPart()
    {
        $id = $this->input->get('id');
        // var_dump(FCPATH);die;
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = 'assets/'; //string, the default is application/cache/
        $config['errorlog']     = 'assets/'; //string, the default is application/logs/
        $config['imagedir']     = 'assets/images/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $id . '.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $id; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $pdf = new reportProduct();
        $pdf->setKriteria('status');
        $pdf->AliasNbPages();
        $pdf->AddPage("P", "A4");

        $pdf->Image(FCPATH . 'assets/images/' . $image_name, 13, 10, 18, 15);
        $detail = $this->mbarcode->getPart($id);
        foreach ($detail as $d) {
            $part = $d['part_number'];
            $desc = $d['deskripsi'];
        }
        $i = 1;
        // while($i= 1){
        $pdf->Rect(13, 10, 43, 15);
        $pdf->SetFont('Arial', 'B', 6);
        $pdf->SetXY(33, 15);
        $pdf->cell(0, 0, "Part Number", 0, 1);
        $pdf->SetXY(33, 18);
        $pdf->cell(0, 0, $part, 0, 1);
        $pdf->SetXY(33, 21);
        $pdf->cell(0, 0, $desc, 0, 1);

        $pdf->Image(FCPATH . 'assets/images/' . $image_name, 64, 10, 18, 15);
        $pdf->Rect(64, 10, 43, 15);
        $pdf->SetFont('Arial', 'B', 6);
        $pdf->SetXY(84, 15);
        $pdf->cell(0, 0, "Part Number", 0, 1);
        $pdf->SetXY(84, 18);
        $pdf->cell(0, 0, $part, 0, 1);
        $pdf->SetXY(84, 21);
        $pdf->cell(0, 0, $desc, 0, 1);

        // $code='12345678901234567890';
        $pdf->Code128(15, 27, $id, 37, 8);
        $pdf->SetFont('Arial', 'B', 8);

        $pdf->Rect(13, 25, 43, 15);
        $pdf->SetXY(14, 35);
        $pdf->Write(5, 'Part Number. ' . $id);

        $pdf->Code128(66, 27, $id, 37, 8);
        $pdf->SetFont('Arial', 'B', 8);

        $pdf->Rect(64, 25, 43, 15);
        $pdf->SetXY(65, 35);
        $pdf->Write(5, 'Part Number. ' . $id);
        // $pdf->Output('D','REPORT-'.$stat.'.pdf');
        header("Content-type: application/PDF");
        // $pdf->Output('D','QRCODE.pdf');
        $pdf->Output();
    }
    public function cetakOffice()
    {
        $id = $this->input->get('id');
        $id2 = $this->input->get('id');
        // var_dump(FCPATH);die;
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = 'assets/'; //string, the default is application/cache/
        $config['errorlog']     = 'assets/'; //string, the default is application/logs/
        $config['imagedir']     = 'assets/images/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $id = md5($id);
        $image_name = $id . '.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $id2; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 9;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $pdf = new reportProduct();
        $pdf->setKriteria('status');
        $pdf->AliasNbPages();
        $pdf->AddPage("P", "A4");

        $pdf->Image(FCPATH . 'assets/images/' . $image_name, 14, 20, 10, 10);
        // var_dump($detail);die;
        $detail = $this->mtransga->getinvbyid($id2);

        foreach ($detail as $d) {
            $part = $d['idtransaksi_inv'];
            $lokasi = $d['id_lokasi'];
            $sub = $d['idsub_inventory'];
            $sub = $this->mmasdat->getsubinvbyid($sub);
            foreach ($sub as $l) {
                $sub = $l['sub_inventory'];
            }
            $lokasi =  $this->mmasdat->getLokasiById($lokasi);
            // var_dump($lokasi);die;
            foreach ($lokasi as $s) {
                $lokasi = $s['nama_lokasi'];
            }
        }
        $i = 1;
        $pdf->Rect(13, 18, 70, 14);
        // $pdf->Rect(13, 18, 35, 30);
        $pdf->Rect(43, 20, 35, 3);
        $pdf->Rect(43, 24, 35, 3);
        $pdf->Rect(43, 28, 35, 3);
        $pdf->SetFont('Arial', '', 5);
        $pdf->SetXY(24, 21.4);
        $pdf->cell(0, 0, "Trio Asset Code  ", 0, 1);
        $pdf->SetXY(44, 22);
        $pdf->cell(0, 0, $part, 0, 1);
        $pdf->SetXY(24, 25);
        $pdf->cell(0, 0, "Type ", 0, 1);
        $pdf->SetXY(44, 25.5);
        $pdf->cell(0, 0, $sub, 0, 1);
        $pdf->SetXY(24, 29);
        $pdf->cell(0, 0, "Lokasi ", 0, 1);
        $pdf->SetXY(44, 29.5);
        $pdf->cell(0, 0, $lokasi, 0, 1);

        $pdf->Code128(15, 34, $id2, 66, 8);
        // $pdf->SetFont('Arial', 'B', 13.5);

        $pdf->Rect(13, 32, 70, 14);
        $pdf->SetXY(15, 41.4);
        $pdf->Write(5, 'Trio Asset Code. ' . $id2);
        header("Content-type: application/PDF");
        // $pdf->Output('D','QRCODE.pdf');
        $pdf->Output();
    }

    public function ajax_get_Inventory()
    {
        $output = '';
        $no = 0;
        $count = $this->mtransga->getCountInv();
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'transaksi_auditor/ajax_get_Inventory';
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
        $listinv = $this->mtransga->getInv($start);
        foreach ($listinv as $list) {
            $tgl = strtotime($list['tanggal_barang_diterima']);
            if ($tgl != 0) {
                $tgl = date('d M Y', $tgl);
            }
            $no++;
            $aksi = '
                    <a href="' . base_url() . "gudang/cetakOffice?id=" . $list['idtransaksi_inv'] . '" class="text-blue"> <h4><i class="fa fa-print"></i></h4></a>
                    ';
            $output .= '
                <tr>
                    <td>' . $no . '</td>
                    <td class="tooltip-demo">
                    ' . $aksi . '
                    </td>
                    <td>' . $list['idtransaksi_inv'] . '</td>
                    <td>' . $list['jenis_inventory'] . '</td>
                    <td>' . $list['sub_inventory'] . '</td>
                    <td>' . $list['nilai_awal'] . '</td>
                    <td>' . $tgl . '</td>
                    <td>' . $list['nama_vendor'] . '</td>
                    <td>' . $list['jenis_pembayaran'] . '</td>
                    <td>' . $list['nama_lokasi'] . '</td>
                    <td>' . $list['nama_pengguna'] . '</td>               
                    <td>' . $list['keterangan'] . '</td>
                    
                </tr>
              ';
        }
        $data = array(
            'output' => $output,
            'pagination' => $this->pagination->create_links()
        );
        echo json_encode($data, true);
    }
    public function search()
    {
        $id = $this->input->post('id');
        $listinv = $this->mtransga->cariinv($id);
        $no = 0;
        $output = '';
        if ($listinv) {
            foreach ($listinv as $list) {
                $tgl = strtotime($list['tanggal_barang_diterima']);
                if ($tgl != 0) {
                    $tgl = date('d M Y', $tgl);
                }
                $no++;
                $aksi = '
                    <a href="' . base_url() . "gudang/cetakOffice?id=" . $list['idtransaksi_inv'] . '" class="text-blue"> <h4><i class="fa fa-print"></i></h4></a>
                    ';
                $output .= '
                 <tr>
                     <td>' . $no . '</td>
                     <td>
                     ' . $aksi . '
                     </td>
                     <td>' . $list['idtransaksi_inv'] . '</td>
                     <td>' . $list['jenis_inventory'] . '</td>
                     <td>' . $list['sub_inventory'] . '</td>
                     <td>' . $list['nilai_awal'] . '</td>
                     <td>' . $tgl . '</td>
                     <td>' . $list['nama_vendor'] . '</td>
                     <td>' . $list['jenis_pembayaran'] . '</td>
                     <td>' . $list['nama_lokasi'] . '</td>
                     <td>' . $list['nama_pengguna'] . '</td>               
                     <td>' . $list['keterangan'] . '</td>
                     
                 </tr>
               ';
            }
        } else {
            $output .= '
            <tr><td colspan="13" class="text-center">data not found</td></tr>
            ';
        }
        echo json_encode($output, true);
    }
}

/* End of file Barcode.php */
