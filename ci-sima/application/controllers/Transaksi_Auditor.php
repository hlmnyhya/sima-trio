<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_Auditor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        ini_set('max_execution_time', 0);
        $this->load->model('m_transaksi_auditor', 'mtransauditor');
        $this->load->model('m_master_data', 'mmasdat');
        $this->load->library('pagination');
        if (!$this->session->userdata('username')) {
            redirect('login/login');
        } else {
            if (
                $this->session->userdata('usergroup') == 'UG002' ||
                $this->session->userdata('usergroup') == 'UG005'
            ) {
            } else {
                require_once 'Login.php';
            }
        }
    }

    public function Aksesoris()
    {
        $data = [
            'judul' => 'Aksesoris',
            'judul1' => 'Transaksi Auditor',
            'tgl' => date('m/d/Y'),
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php', $data);
        $this->load->view('auditorview/aksesoris/v_aksesoris.php', $data);
        $this->load->view('auditorview/aksesoris/_partial/footer.php');
    }

    public function ajax_get_lokasi2()
    {
        $output = '';
        $no = 0;
        $id = $this->input->post('id_cabang');
        $key = $this->input->post('key');
        $lokasicabang = $this->mmasdat->getLokasiCabang($id);

        $output .= '<option value="">--- Pilih Lokasi ---</option>';
        foreach ($lokasicabang as $lokcab) {
            $idlokasi = $lokcab['kd_gudang'];
            //$listlokasi = $this->mmasdat->getLokasiByid($idlokasi);
            //foreach ($listlokasi as $list) {
            //$no++;
            if ($lokcab['kd_gudang'] == $key) {
                $output .=
                    '
                        <option value="' .
                    $lokcab['kd_gudang'] .
                    '" selected>' .
                    '(' .
                    $lokcab['jenis_gudang'] .
                    ') ' .
                    $lokcab['nama_gudang'] .
                    ' - ' .
                    $lokcab['alamat'] .
                    '</option>
                    ';
            } else {
                $output .=
                    '
                        <option value="' .
                    $lokcab['kd_gudang'] .
                    '">' .
                    '(' .
                    $lokcab['jenis_gudang'] .
                    ') ' .
                    $lokcab['nama_gudang'] .
                    ' - ' .
                    $lokcab['alamat'] .
                    '</option>
                    ';
            }
            //}
        }
        echo json_encode($output, true);
    }
    public function ajax_get_rakbin()
    {
        $output = '';
        $no = 0;
        $id = $this->input->post('kd_gudang');
        $key = $this->input->post('key');
        $listrak = $this->mmasdat->getLokasirak($id);
        // var_dump($listrak);exit;

        $output .= '<option value="">--- Pilih Lokasi Rak ---</option>';

        foreach ($listrak as $list) {
            $idlokasi = $list['kd_lokasi_rak'];
            // if ($idlokasi == $key) {
            //     $output .= '
            //     <option value="' . $list['kd_lokasi_rak'] . '"selected>' . $list['id_lokasi'] . ' - '  . $list['kd_rak'] . ' - ' . $list['kd_binbox'] . ' </option>
            //         ';
            // } else {
            $output .=
                '
                <option value="' .
                $list['kd_lokasi_rak'] .
                '" >' .
                $list['id_lokasi'] .
                ' - ' .
                $list['kd_rak'] .
                ' - ' .
                $list['kd_binbox'] .
                ' </option>
                    ';
            // }
        }
        echo json_encode($output, true);
    }

    public function ajax_get_gudang()
    {
        $output = '';
        $no = 0;
        $listgudang = $this->mtransauditor->getGudang();
        foreach ($listgudang as $list) {
            $no++;
            $output .=
                '
				<option value="' .
                $list['kd_gudang'] .
                '">' .
                $list['kd_gudang'] .
                ' - ' .
                $list['nama_gudang'] .
                '</option>
			';
        }
        echo '<option value="">--- Pilih Gudang ---</option>';
        echo $output;
    }

    // public function ajax_get_rakbin()
    // {
    //     $output = '';
    //     $no = 0;
    //     $listrak = $this->mmasdat->getLokasirak();
    //     foreach ($listrak as $list) {
    //         $no++;
    //         $output .= '
    // 			<option value="' . $list['kd_lokasi_rak'] . '">' . $list['kd_lokasi_rak'] . '</option>
    // 		';
    //     }
    //     echo '<option value="">--- Pilih Rak Bin ---</option>';
    //     echo $output;
    // }

    public function ajax_get_cabang2()
    {
        $output = '';
        $no = 0;
        $listcabang = $this->mtransauditor->getCabang();
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

    // <!-- UNIT || AUDIT  -->
    public function Audit()
    {
        $data = [
            'judul' => 'Audit',
            'judul1' => 'Transaksi Auditor',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('auditorview/audit/v_audit.php', $data);
        $this->load->view('auditorview/audit/_partial/footer.php');
    }
    public function temp_unit()
    {
        $data = [
            'judul' => 'Audit',
            'judul1' => 'Transaksi Auditor',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('auditorview/audit/v_temp_unit.php', $data);
        $this->load->view('auditorview/audit/_partial/footer3.php');
    }
    public function downloadunit()
    {
        $id = $this->input->post('id');
        $idaudit = $this->input->post('idaudit');
        $tgl = $_tgl;
        $output = '';
        if ($this->mtransauditor->downloadunit($id, $idaudit)) {
            $output .=
                '<div class="text-success">Data Berhasil Didownload</div>';
        } else {
            $output .= '<div class="text-danger"> Data Gagal Didownload</div>';
        }
        echo json_encode($output, true);
    }

    public function ListAudit_Inventory()
    {
        $cabang = $this->input->post('id_cabang');
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_awal = strtotime($tgl_awal);
        $tgl_awal = date('Y-m-d', $tgl_awal);
        $tgl_akhir = $this->input->post('tgl_akhir');
        $tgl_akhir = strtotime($tgl_akhir);
        $tgl_akhir = date('Y-m-d', $tgl_akhir);
        $status = $this->input->post('status');
        $data = [
            'judul' => 'List Audit Inventory',
            'judul1' => 'Transaksi Auditor',
            'tgl' => date('m/d/Y'),
        ];

        $config['base_url'] = base_url() . 'transaksi/audit_unit';
        $config['total_rows'] = $this->mtransauditor->countunit(
            $cabang,
            $tgl_awal,
            $tgl_akhir,
            $status
        );
        $config['per_page'] = 15;
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'pages';
        $config['num_links'] = 2;

        $config['full_tag_open'] =
            '<div class="pagination"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
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
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'auditorview/audit_inventory/v_list_audit_inventory.php',
            $data
        );
        $this->load->view('auditorview/audit_inventory/_partial/footer.php');
    }

    public function Manual_Audit()
    {
        $no_mesin = $this->input->get('no_mesin');
        $data = [
            'judul' => 'Manual Audit',
            'judul1' => 'Transaksi Auditor',
            'edit' => $this->mtransauditor->getUnitField($no_mesin),
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/audit/v_manual.php', $data);
        $this->load->view('auditorview/audit/_partial/footer.php');
    }

    public function Scaning_Audit()
    {
        $data = [
            'judul' => 'Scaning Audit',
            'judul1' => 'Transaksi Auditor',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/audit/v_scaning.php', $data);
        $this->load->view('auditorview/audit/_partial/footer.php');
    }

    public function Edit_Audit()
    {
        $id = base64_decode($this->input->get('id'));
        $data = [
            'judul' => 'Audit Unit',
            'judul1' => 'Transaksi Auditor',
            'edit' => $this->mtransauditor->getUnitById($id),
        ];
        // var_dump($data['edit']);die;
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/audit_unit/v_edit_unit.php', $data);
        $this->load->view('auditorview/audit_unit/_partial/footer2.php', $data);
    }

    public function Edit_Part()
    {
        $id = base64_decode($this->input->get('id'));
        $data = [
            'judul' => 'Audit Unit',
            'judul1' => 'Transaksi Auditor',
            'edit' => $this->mtransauditor->getPartById($id),
        ];
        // var_dump($data['edit']);die;
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/audit_part/v_edit_part.php', $data);
        $this->load->view('auditorview/audit_part/_partial/footer2.php', $data);
    }

    public function Audit_Unit()
    {
        $cabang = $this->input->post('id_cabang');
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_awal = strtotime($tgl_awal);
        $tgl_awal = date('Y-m-d', $tgl_awal);
        $tgl_akhir = $this->input->post('tgl_akhir');
        $tgl_akhir = strtotime($tgl_akhir);
        $tgl_akhir = date('Y-m-d', $tgl_akhir);
        $status = $this->input->post('status');
        $data = [
            'judul' => 'Audit Unit',
            'judul1' => 'Transaksi Auditor',
            'tgl' => date('m/d/Y'),
        ];

        $config['base_url'] = base_url() . 'transaksi/audit_unit';
        $config['total_rows'] = $this->mtransauditor->countunit(
            $cabang,
            $tgl_awal,
            $tgl_akhir,
            $status
        );
        $config['per_page'] = 15;
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'pages';
        $config['num_links'] = 2;

        $config['full_tag_open'] =
            '<div class="pagination"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
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
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/audit_unit/v_audit_unit.php', $data);
        $this->load->view('auditorview/audit_unit/_partial/footer.php');
    }
    public function preview($page)
    {
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $status = $this->input->post('status');

        $count = $this->mtransauditor->countunit(
            $cabang,
            $idjadwal_audit,
            $status
        );
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'transaksi_auditor/preview';
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

        //$page = floor($count / 15);
        //$page = $this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        $start = ($page - 1) * $config['per_page'];

        $cetak = $this->mtransauditor->previewUnit(
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
        $output = [
            'pagination_link' => $this->pagination->create_links(),
            'unit_list' => $cetak,
            'row_entry' => $row_entry,
        ];

        echo json_encode($output);
    }
    public function ajax_get_unit()
    {
        $output = '';
        $base = base_url();
        $no = 0;
        if ($this->input->post('pages') != 'undefined') {
            $offset = $this->input->post('pages');
        } else {
            $offset = 0;
        }
        // data['kodeunik'] = $this->musergroup->kode();
        $listUnit = $this->mtransauditor->getUnit($offset);
        foreach ($listUnit as $list) {
            $offset++;
            $output .=
                '
        <tr> 
            <td class="text-center">' .
                $offset .
                '</td>
            <td class="text-center"></td>
            <td class="text-center">' .
                $list['id_unit'] .
                '</td>
            <td class="text-center">' .
                $list['no_mesin'] .
                '</td>
            <td class="text-center">' .
                $list['no_rangka'] .
                '</td>
            <td class="text-center">' .
                $list['nama_cabang'] .
                '</td>
            <td class="text-center">' .
                $list['nama_gudang'] .
                '</td>
            <td class="text-center">' .
                $list['umur_unit'] .
                '</td>
            <td class="text-center">' .
                $list['status_unit'] .
                '</td>
            <td class="text-center">' .
                $list['aki'] .
                '</td>
            <td class="text-center">' .
                $list['spion'] .
                '</td>
            <td class="text-center">' .
                $list['helm'] .
                '</td>
            <td class="text-center">' .
                $list['tools'] .
                '</td>
            <td class="text-center">' .
                $list['buku_service'] .
                '</td>
            <td class="text-center">' .
                $list['tahun'] .
                '</td>
            <td class="text-center">' .
                $list['type'] .
                '</td>
            <td class="text-center">' .
                $list['kode_item'] .
                '</td>
            <td class="text-center">' .
                $list['foto'] .
                '</td>
            <td class="text-center">' .
                $list['keterangan'] .
                '</td>
            <td class="text-center">' .
                $list['is_ready'] .
                '</td>
            <td class="text-center">' .
                $list['tanggal_audit'] .
                '</td>
        </tr>     
        ';
        }
        echo $output;
    }
    public function ajax_get_jadwalaudit($idcabang = null)
    {
        $output = '';
        $no = 0;
        $listcabang = $this->mtransauditor->getJadwalAudit($idcabang);
        foreach ($listcabang as $list) {
            $no++;
            $output .=
                '
            <option value="' .
                $list['idjadwal_audit'] .
                '">' .
                $list['idjadwal_audit'] .
                ' (' .
                $list['tanggal'] .
                ')</option>
        ';
        }
        echo '<option value="">--- Pilih ID Audit ---</option>';
        echo $output;
    }

    public function post_unitmanual()
    {
        $data = [
            'id_unit' => $this->input->post('id_unit', true),
            'no_mesin' => $this->input->post('no_mesin', true),
            'no_rangka' => $this->input->post('no_rangka', true),
            'type_unit' => $this->input->post('type_unit', true),
            'usia_unit' => $this->input->post('usia_unit', true),
            'is_ra' => $this->input->post('usia_unit', true),
            'user' => $this->session->userdata('username'),
        ];

        $id = $data['id_unit'];

        $cek = $this->mtransauditor->getUnitById($id);
        // var_dump($cek);die;
        if ($cek['status'] === true) {
            $this->session->set_flashdata('warning', 'Data sudah ada');
            redirect('transaksi_auditor/audit_unit');
        } else {
            $exec = $this->mtransauditor->addUnit($data);
            if ($exec) {
                $this->session->set_flashdata(
                    'berhasil',
                    'Data Berhasil Ditambahkan'
                );
                redirect('transaksi_auditor/audit_unit');
            } else {
                $this->session->set_flashdata('gagal', 'gagal ditambahkan');
                redirect('transaksi_auditor/audit_unit');
            }
        }
    }


    public function edit_audit_unit()
    {
        $data = [
            'id_unit' => $this->input->post('id_unit'),
            'no_mesin' => $this->input->post('no_mesin'),
            'no_rangka' => $this->input->post('no_rangka'),
            'umur_unit' => $this->input->post('umur_unit'),
            'tahun' => $this->input->post('tahun'),
            'id_cabang' => $this->input->post('id_cabang'),
            'id_lokasi' => $this->input->post('id_lokasi'),
            'status' => 'Sesuai',
            'is_ready' => $this->input->post('is_ready'),
            'type' => $this->input->post('type'),
            'kode_item' => $this->input->post('kode_item'),
            'keterangan' => $this->input->post('keterangan'),
        ];
        // var_dump(count($this->input->post('ket')));die;
        $name = $_POST['part_number'];
        for ($i = 0; $i < count($name); $i++) {
            $phar[$i] = [
                'part_number' => $_POST['part_number'][$i],
                'no_mesin' => $_POST['no_mesin'],
                'no_rangka' => $_POST['no_rangka'],
                'keterangan' => $_POST['ket'][$i],
                'id_cabang' => $this->input->post('id_cabang'),
                'id_lokasi' => $this->input->post('id_lokasi'),
                'kondisi' => $_POST['kondisi_part'][$i],
                'penanggung_jawab' => $_POST['penanggungjawab'][$i],
            ];
            if ($this->mtransauditor->addunitready($phar[$i])) {
            } else {
                $this->session->set_flashdata('gagal', 'Gagal Diedit');

                redirect('transaksi/audit_unit', 'refresh');
            }
        }
        // print_r($phar);
        if ($this->mtransauditor->editUnit($data)) {
            $this->session->set_flashdata('berhasil', 'Berhasil Diedit');

            redirect('transaksi/audit_unit', 'refresh');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Diedit');

            redirect('transaksi/audit_unit', 'refresh');
        }
    }

    public function edit_audit_part() {
        $data = [
            'part_number' => $this->input->post('part_number'),
            'kd_lokasi_rak' => $this->input->post('kd_lokasi_rak'),
            'deskripsi' => $this->input->post('deskripsi'),
            'id_cabang' => $this->input->post('id_cabang'),
            'id_lokasi' => $this->input->post('id_lokasi'),
            'kondisi' => $this->input->post('kondisi'),
            'status' => 'Sesuai',
            'penanggung_jawab' => $this->input->post('penanggung_jawab')
        ];
        if ($this->mtransauditor->editPart($data)) {
            $this->session->set_flashdata('berhasil', 'Berhasil Diedit');

            redirect('transaksi/audit_part', 'refresh');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Diedit');

            redirect('transaksi/audit_part', 'refresh');
        }
    }

    public function doAudit()
    {
        $manual = false;
        $scanunit = $this->input->post('no_mesin');
        $cabang = $this->input->post('cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $lokasi = $this->input->post('lokasi');
        $data = [
            'no_mesin' => $this->input->post('no_mesin'),
            'no_rangka' => $this->input->post('no_rangka'),
            'status_unit' => 'Belum Sesuai',
            'id_cabang' => $cabang,
            'id_lokasi' => $lokasi,
            'is_ready' => 'RFS',
            'idjadwal_audit' => $idjadwal_audit,
        ];

        $cek = $this->mtransauditor->cek($scanunit, $cabang, $idjadwal_audit);
        if ($cek) {
            $info = 'Data Telah diaudit';
            $output = '';
            $count = $this->mtransauditor->countunit1($cabang, $idjadwal_audit);
            $this->load->library('pagination');

            $config['base_url'] =
                base_url() . 'transaksi_auditor/ajax_unitvalid';
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

            $page = floor($count / 15); //$this->uri->segment(3);
            if ($page == null) {
                $page = 1;
            }
            $start = ($page - 1) * $config['per_page'];
            $getunit = $this->mtransauditor->getUnit(
                $cabang,
                $start,
                $idjadwal_audit
            );
            if ($getunit) {
                foreach ($getunit as $list) {
                    $start++;
                    $output .=
                        '
                                <tr> 
                                    <td class="text-center">' .
                        $start .
                        '</td>
                                    <td></td>
                                    <td class="text-center">' .
                        $list['no_mesin'] .
                        '</td>
                                    <td class="text-center">' .
                        $list['no_rangka'] .
                        '</td>
                                    <td class="text-center">' .
                        $list['nama_cabang'] .
                        '</td>
                                    <td class="text-center">' .
                        $list['nama_gudang'] .
                        '</td>
                                    <td class="text-center">' .
                        $list['status_unit'] .
                        '</td>
                                    <td class="text-center">' .
                        $list['tahun'] .
                        '</td>
                                    <td class="text-center">' .
                        $list['type'] .
                        '</td>
                                    <td class="text-center">' .
                        $list['kode_item'] .
                        '</td>
                                    <td class="text-center">' .
                        $list['keterangan'] .
                        '</td>
                                    <td class="text-center">' .
                        $list['is_ready'] .
                        '</td>
                                </tr>     
                                ';
                }
            }
        } else {
            if ($this->mtransauditor->addscanunit($data)) {
                $info = 'Data Berhasil diaudit';
                $output = '';
                $count = $this->mtransauditor->countunit1(
                    $cabang,
                    $idjadwal_audit
                );
                $this->load->library('pagination');

                $config['base_url'] =
                    base_url() . 'transaksi_auditor/ajax_unitvalid';
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

                $page = floor($count / 15); //$this->uri->segment(3);
                if ($page == null) {
                    $page = 1;
                }
                $start = ($page - 1) * $config['per_page'];
                $getunit = $this->mtransauditor->getUnit(
                    $cabang,
                    $start,
                    $idjadwal_audit
                );
                if ($getunit) {
                    foreach ($getunit as $list) {
                        $start++;
                        $output .=
                            '
                                    <tr> 
                                        <td class="text-center">' .
                            $start .
                            '</td>
                                        <td></td>
                                        <td class="text-center">' .
                            $list['no_mesin'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['no_rangka'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['nama_cabang'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['nama_gudang'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['status_unit'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['tahun'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['type'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['kode_item'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['keterangan'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['is_ready'] .
                            '</td>
                                    </tr>     
                                    ';
                    }
                }
            } else {
                $info = 'Data Gagal diaudit';
                $output = '';
                $count = $this->mtransauditor->countunit1(
                    $cabang,
                    $idjadwal_audit
                );
                $this->load->library('pagination');

                $config['base_url'] =
                    base_url() . 'transaksi_auditor/ajax_unitvalid';
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

                $page = floor($count / 15); //$this->uri->segment(3);
                if ($page == null) {
                    $page = 1;
                }
                $start = ($page - 1) * $config['per_page'];
                $getunit = $this->mtransauditor->getUnit(
                    $cabang,
                    $start,
                    $idjadwal_audit
                );
                if ($getunit) {
                    foreach ($getunit as $list) {
                        $start++;
                        $output .=
                            '
                                    <tr> 
                                        <td class="text-center">' .
                            $start .
                            '</td>
                                        <td></td>
                                        <td class="text-center">' .
                            $list['no_mesin'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['no_rangka'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['nama_cabang'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['nama_gudang'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['status_unit'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['tahun'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['type'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['kode_item'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['keterangan'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['is_ready'] .
                            '</td>
                                    </tr>     
                                    ';
                    }
                }
            }
        }
        $data = [
            'info' => $info,
            'output' => $output,
            'manual' => $manual,
        ];
        echo json_encode($data, true);
    }

    public function scan_data_unit()
    {
        $scanunit = $this->input->post('id');
        $cabang = $this->input->post('cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $lokasi = $this->input->post('lokasi');
        $manual = false;

        // $scanunit = 'JBN1E1172125';
        // $cabang ='T13';
        $output = '';
        $base = base_url();
        $info = '';

        if ($scanunit != null) {
            $dataUnit = $this->mtransauditor->cariscanunit($scanunit, $cabang);
        }
        if ($dataUnit) {
            foreach ($dataUnit as $unit) {
                if ($unit['id_lokasi'] == $lokasi) {
                    $data = [
                        'id_unit' => $unit['id_unit'],
                        'no_mesin' => $unit['no_mesin'],
                        'no_rangka' => $unit['no_rangka'],
                        'umur_unit' => $unit['umur'],
                        'tahun' => $unit['tahun'],
                        'id_cabang' => $unit['id_cabang'],
                        'id_lokasi' => $unit['id_lokasi'],
                        'buku_service' => null,
                        'helm' => null,
                        'aki' => null,
                        'tools' => null,
                        'spion' => null,
                        'status_unit' => 'Sesuai',
                        'is_ready' => 'RFS',
                        'foto' => null,
                        'type' => $unit['type'],
                        'kode_item' => $unit['kode_item'],
                        'keterangan' =>  'Lokasi Sesuai',
                        'idjadwal_audit' => $idjadwal_audit,
                    ];
                } else {
                    $data = [
                        'id_unit' => $unit['id_unit'],
                        'no_mesin' => $unit['no_mesin'],
                        'no_rangka' => $unit['no_rangka'],
                        'umur_unit' => $unit['umur'],
                        'tahun' => $unit['tahun'],
                        'id_cabang' => $unit['id_cabang'],
                        'id_lokasi' => $lokasi,
                        'buku_service' => null,
                        'helm' => null,
                        'aki' => null,
                        'tools' => null,
                        'spion' => null,
                        'status_unit' => 'Sesuai',
                        'is_ready' => 'RFS',
                        'foto' => null,
                        'type' => $unit['type'],
                        'kode_item' => $unit['kode_item'],
                        'keterangan' => 'Lokasi Tidak Sesuai',
                        'idjadwal_audit' => $idjadwal_audit,
                    ];
                }
            }
            $cek = $this->mtransauditor->cek(
                $scanunit,
                $cabang,
                $idjadwal_audit
            );
            // var_dump($cek);exit;
            if ($cek) {
                $info = 'Data Telah diaudit';
                $output = '';
                $count = $this->mtransauditor->countunit1(
                    $cabang,
                    $idjadwal_audit
                );
                $this->load->library('pagination');

                $config['base_url'] =
                    base_url() . 'transaksi_auditor/ajax_unitvalid';
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

                $page = ceil($count / 15); //$this->uri->segment(3);
                if ($page == null) {
                    $page = 1;
                }
                $start = ($page - 1) * $config['per_page'];
                $getunit = $this->mtransauditor->getUnit(
                    $cabang,
                    $start,
                    $idjadwal_audit
                );
                if ($getunit) {
                    foreach ($getunit as $list) {
                        $start++;
                        $output .=
                            '
                                <tr> 
                                    <td class="text-center">' .
                            $start .
                            '</td>
                                    <td></td>
                                    <td class="text-center">' .
                            $list['no_mesin'] .
                            '</td>
                                    <td class="text-center">' .
                            $list['no_rangka'] .
                            '</td>
                                    <td class="text-center">' .
                            $list['nama_cabang'] .
                            '</td>
                                    <td class="text-center">' .
                            $list['nama_gudang'] .
                            '</td>
                                    <td class="text-center">' .
                            $list['status_unit'] .
                            '</td>
                                    <td class="text-center">' .
                            $list['tahun'] .
                            '</td>
                                    <td class="text-center">' .
                            $list['type'] .
                            '</td>
                                    <td class="text-center">' .
                            $list['kode_item'] .
                            '</td>
                                    <td class="text-center">' .
                            $list['keterangan'] .
                            '</td>
                                    <td class="text-center">' .
                            $list['is_ready'] .
                            '</td>
                                </tr>     
                                ';
                    }
                }
            } else {
                $info = 'Data Berhasil diaudit';
                if ($this->mtransauditor->addscanunit($data)) {
                    $output = '';
                    $count = $this->mtransauditor->countunit1(
                        $cabang,
                        $idjadwal_audit
                    );
                    $this->load->library('pagination');

                    $config['base_url'] =
                        base_url() . 'transaksi_auditor/ajax_unitvalid';
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

                    $page = ceil($count / 15); //$this->uri->segment(3);
                    if ($page == null) {
                        $page = 1;
                    }
                    $start = ($page - 1) * $config['per_page'];
                    $getunit = $this->mtransauditor->getUnit(
                        $cabang,
                        $start,
                        $idjadwal_audit
                    );
                    if ($getunit) {
                        foreach ($getunit as $list) {
                            $start++;
                            $output .=
                                '
                                    <tr> 
                                        <td>' .
                                $start .
                                '</td>
                                        <td></td>
                                        <td>' .
                                $list['no_mesin'] .
                                '</td>
                                        <td>' .
                                $list['no_rangka'] .
                                '</td>
                                        <td>' .
                                $list['nama_cabang'] .
                                '</td>
                                        <td>' .
                                $list['nama_gudang'] .
                                '</td>
                                        <td>' .
                                $list['status_unit'] .
                                '</td>
                                        <td>' .
                                $list['tahun'] .
                                '</td>
                                        <td>' .
                                $list['type'] .
                                '</td>
                                        <td>' .
                                $list['kode_item'] .
                                '</td>
                                        <td>' .
                                $list['keterangan'] .
                                '</td>
                                        <td>' .
                                $list['is_ready'] .
                                '</td>
                                    </tr>     
                                    ';
                        }
                    }
                }
            }
        } else {
            $info = 'Data not found';
            $manual = true;
            $output = '';
            $count = $this->mtransauditor->countunit1($cabang, $idjadwal_audit);
            $this->load->library('pagination');

            $config['base_url'] =
                base_url() . 'transaksi_auditor/ajax_unitvalid';
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

            $page = ceil($count / 15); //$this->uri->segment(3);
            if ($page == null) {
                $page = 1;
            }
            $start = ($page - 1) * $config['per_page'];
            $getunit = $this->mtransauditor->getUnit(
                $cabang,
                $start,
                $idjadwal_audit
            );
            if ($getunit) {
                foreach ($getunit as $list) {
                    $start++;
                    $output .=
                        '
                            <tr> 
                                <td>' .
                        $start .
                        '</td>
                                <td></td>
                                <td>' .
                        $list['no_mesin'] .
                        '</td>
                                <td>' .
                        $list['no_rangka'] .
                        '</td>
                                <td>' .
                        $list['nama_cabang'] .
                        '</td>
                                <td>' .
                        $list['nama_gudang'] .
                        '</td>
                                <td>' .
                        $list['status_unit'] .
                        '</td>
                                <td>' .
                        $list['tahun'] .
                        '</td>
                                <td>' .
                        $list['type'] .
                        '</td>
                                <td>' .
                        $list['kode_item'] .
                        '</td>
                                <td>' .
                        $list['keterangan'] .
                        '</td>
                                <td>' .
                        $list['is_ready'] .
                        '</td>
                            </tr>     
                            ';
                }
            }
        }
        $data = [
            'info' => $info,
            'output' => $output,
            'manual' => $manual,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }

    public function ajax_unitvalid($page)
    {
        $cabang = $this->input->post('cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        // $cabang='T13';

        $output = '';
        $count = $this->mtransauditor->Countunit1($cabang, $idjadwal_audit);
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'transaksi_auditor/ajax_unitvalid';
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

        //$page = floor($count / 15); //$this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        $start = ($page - 1) * $config['per_page'];
        $getunit = $this->mtransauditor->getUnit(
            $cabang,
            $start,
            $idjadwal_audit
        );

        if ($getunit) {
            foreach ($getunit as $list) {
                $start++;
                $output .=
                    '
                        <tr> 
                            <td>' .
                    $start .
                    '</td>
                            <td></td>
                            <td>' .
                    $list['no_mesin'] .
                    '</td>
                            <td>' .
                    $list['no_rangka'] .
                    '</td>
                            <td>' .
                    $list['nama_cabang'] .
                    '</td>
                            <td>' .
                    $list['nama_gudang'] .
                    '</td>
                            <td>' .
                    $list['status_unit'] .
                    '</td>
                            <td>' .
                    $list['tahun'] .
                    '</td>
                            <td>' .
                    $list['type'] .
                    '</td>
                            <td>' .
                    $list['kode_item'] .
                    '</td>
                            <td>' .
                    $list['keterangan'] .
                    '</td>
                            <td>' .
                    $list['is_ready'] .
                    '</td>
                        </tr>     
                        ';
            }
        } else {
            $output .=
                '<tr><td colspan="13" class="text-center">data not found</td></tr>';
        }
        $data = [
            'pagination' => $this->pagination->create_links(),
            'output' => $output,
        ];

        echo json_encode($data, true);
    }
    public function ajax_tempunit($p)
    {
        $cabang = $this->input->post('cabang');
        // $cabang='T13';
        $output = '';
        $count = $this->mtransauditor->counttempunit($cabang);
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'transaksi_auditor/ajax_tempunit';
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

        $page = $p; //floor($count / 15); //$this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        $start = ($page - 1) * $config['per_page'];
        $getunit = $this->mtransauditor->getToUnit($cabang, $start);
        if ($getunit) {
            foreach ($getunit as $list) {
                $start++;
                $output .=
                    '
                        <tr> 
                            <td>' .
                    $start .
                    '</td>
                            <td>' .
                    $list['no_mesin'] .
                    '</td>
                            <td>' .
                    $list['no_rangka'] .
                    '</td>
                            <td>' .
                    $list['nama_gudang'] .
                    '</td>
                            <td>' .
                    ($list['tahun'] == ''
                        ? ''
                        : ((int) date('Y')) - $list['tahun']) .
                    '</td>
                            <td>' .
                    $list['tahun'] .
                    '</td>
                            <td>' .
                    $list['type'] .
                    '</td>
                            <td>' .
                    $list['kode_item'] .
                    '</td>
                        </tr>     
                        ';
            }
        } else {
            $output .=
                '<tr><td colspan="13" class="text-center">data not found</td></tr>';
        }
        $data = [
            'pagination' => $this->pagination->create_links(),
            'output' => $output,
        ];

        echo json_encode($data, true);
    }

    public function closeaudit()
    {
        $id = $this->input->post('id');
        $a = base64_decode($this->input->post('a'));
        if ($id == null) {
            $data = [
                'status' => false,
                'info' => 'Check your data',
            ];
        } else {
            $list = $this->mtransauditor->closeaudit($id, $a);
            if ($list) {
                $data = [
                    'status' => true,
                    'info' => 'Success',
                ];
            } else {
                $data = [
                    'status' => false,
                    'info' => 'Failed Closed',
                ];
            }
        }
        echo json_encode($data, true);
    }

    // <!-- ADUIT PART -->
    public function temp_part()
    {
        $data = [
            'judul' => 'Audit',
            'judul1' => 'Transaksi Auditor',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('auditorview/audit/v_temp_part.php', $data);
        $this->load->view('auditorview/audit/_partial/footer4.php');
    }

    public function downloadpart()
    {
        $id = $this->input->post('id');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $output = '';
        $time = date('Y-m-d H:i:s');
        if ($this->mtransauditor->downloadpart($id, $idjadwal_audit, $time)) {
            $output .=
                '<div class="text-success"> Data Berhasil Didownload Pada </div>';
        } else {
            $output .= '<div class="text-danger"> Data Diperbarui Pada </div>';
        }

        echo json_encode($output, true);
    }
    // punya nya temp part
    public function AuditPart()
    {
        $data = [
            'judul' => 'Audit',
            'judul1' => 'Transaksi Auditor',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('auditorview/audit/v_audit_part.php', $data);
        $this->load->view('auditorview/audit/_partial/footer2.php');
    }
    public function ajax_partvalid($page)
    {
        $cabang = $this->input->post('cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $rakbin = $this->input->post('kd_lokasi_rak');
        // $cabang='T13';
        $output = '';
        $count = $this->mtransauditor->countpart1(
            $cabang,
            $idjadwal_audit,
            $rakbin
        );
        // var_dump($count);exit;
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'transaksi_auditor/ajax_partvalid';
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

        //$page = $this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        $start = ($page - 1) * $config['per_page'];
        $getpart = $this->mtransauditor->getPartValid(
            $cabang,
            $start,
            $idjadwal_audit
        );
        if ($getpart) {
            foreach ($getpart as $list) {
                $start++;
                $output .=
                    '
                        <tr> 
                            <td>' .
                    $start .
                    '</td>
                            <td>' .
                    $list['nama_cabang'] .
                    '</td>
                            <td>' .
                    $list['nama_gudang'] .
                    '</td>
                            <td>' .
                    $list['part_number'] .
                    '</td>
                            <td>' .
                    $list['deskripsi'] .
                    '</td>
                            <td>' .
                    $list['qty'] .
                    '</td>
                            <td>' .
                    $list['kd_lokasi_rak'] .
                    '</td>
                            <td>' .
                    $list['status'] .
                    '</td>
                            <td>' .
                    $list['kondisi'] .
                    '</td>
                            <td>' .
                    $list['keterangan'] .
                    '</td>
                        </tr>       
                        ';
            }
        } else {
            $output .=
                '<tr><td colspan="13" class="text-center">data not found</td></tr>';
        }
        $data = [
            'pagination' => $this->pagination->create_links(),
            'output' => $output,
        ];

        echo json_encode($data, true);
    }

    public function ListAudit_Part()
    {
        $cabang = $this->input->post('id_cabang');
        $lokasi = $this->input->post('id_lokasi');
        $part_number = $this->input->post('part_number');
        $kondisi = $this->input->post('kondisi');
        $data = [
            'judul' => 'List Audit Part',
            'judul1' => 'Transaksi Auditor',
            'tgl' => date('m/d/Y'),
        ];

        $config['base_url'] = base_url() . 'transaksi/audit_part';
        $config['total_rows'] = $this->mtransauditor->countpart1(
            $cabang,
            $lokasi,
            $part_number,
            $kondisi
        );
        $config['per_page'] = 15;
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'pages';
        $config['num_links'] = 2;

        $config['full_tag_open'] =
            '<div class="pagination"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
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
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'auditorview/audit_part/v_list_audit_part.php',
            $data
        );
        $this->load->view('auditorview/audit_part/_partial/footer.php');
    }

    public function Audit_Part()
    {
        $data = [
            'judul' => 'Audit Part',
            'judul1' => 'Transaksi Auditor',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/audit_part/v_audit_part.php', $data);
        $this->load->view('auditorview/audit_part/_partial/footer.php');
    }

    public function ajax_get_part()
    {
        $output = '';
        $base = base_url();
        $no = 0;
        // data['kodeunik'] = $this->musergroup->kode();
        $listPart = $this->mtransauditor->getPart();
        if (isset($listPart) && $listPart != null) {
            foreach ($listPart as $list) {
                $no++;
                $output .=
                    '
            <tr> 
                <td class="text-center">' .
                    $no .
                    '</td>
                <td class="text-center"><a onclick="edit_part(id=\'' .
                    $list['id_part'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a></td>
                <td class="text-center">' .
                    $list['nama_cabang'] .
                    '</td>
                <td class="text-center">' .
                    $list['nama_gudang'] .
                    '</td>
                <td class="text-center">' .
                    $list['part_number'] .
                    '</td>
                <td class="text-center">' .
                    $list['kd_lokasi_rak'] .
                    '</td>
                <td class="text-center">' .
                    $list['status'] .
                    '</td>
                <td class="text-center">' .
                    $list['deskripsi'] .
                    '</td>
                <td class="text-center">' .
                    $list['qty'] .
                    '</td>
                <td class="text-center">' .
                    $list['kondisi'] .
                    '</td>
                <td class="text-center">' .
                    $list['keterangan'] .
                    '</td>
            </tr>
            
            ';
            }
        } else {
            $output .=
                '<tr><td colspan="9" class="text-center">Belum Ada Data</td></tr>';
        }
        echo $output;
    }
    public function ajax_get_jadwalauditpart($idcabang = null)
    {
        $output = '';
        $no = 0;
        $listcabang = $this->mtransauditor->getJadwalAuditPart($idcabang);
        foreach ($listcabang as $list) {
            $no++;
            $output .=
                '
            <option value="' .
                $list['idjadwal_audit'] .
                '">' .
                $list['idjadwal_audit'] .
                ' (' .
                $list['tanggal'] .
                ')</option>
        ';
        }
        echo '<option value="">--- Pilih ID Audit ---</option>';
        echo $output;
    }

    public function doPart()
    {
        // var_dump("aaa");exit;
        $manual = false;
        $scanpart = $this->input->post('id');
        // $part_number = $this->input->post('part_number');
        $cabang = $this->input->post('cabang');
        $lokasi = $this->input->post('lokasi');
        $rakbin = $this->input->post('kd_lokasi_rak');
        $kondisi = $this->input->post('kondisi');
        $qty = $this->input->post('qty');
        $status = $this->input->post('status');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $data = [
            'id' => $this->input->post('id'),
            'id_cabang' => $cabang,
            'id_lokasi' => $lokasi,
            'kd_lokasi_rak' => $rakbin,
            'kondisi' => $kondisi,
            'status' => 'tidak diketahui',
            'qty' => $qty,
            'keterangan' => 'Tidak diketahui',
            'part_number' => $this->input->post('part_number'),
            'deskripsi' => "-",
            'idjadwal_audit' => $this->input->post('idjadwal_audit'),
        ];

        $cek = $this->mtransauditor->cekPart(
            $scanpart,
            $cabang,
            $idjadwal_audit
        );
        if ($cek) {
            $info = 'Data Berhasil diaudit';
            if ($this->mtransauditor->addScanPart($data)) {      
                $output = '';
                $count = $this->mtransauditor->countpart1(
                    $cabang,
                    $idjadwal_audit
                );
                $this->load->library('pagination');

                $config['base_url'] =
                    base_url() . 'transaksi_auditor/ajax_partvalid';
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

                $page = floor($count / 15); //$this->uri->segment(3);
                if ($page == null) {
                    $page = 1;
                }
                $start = ($page - 1) * $config['per_page'];
                $getPartValid = $this->mtransauditor->getPartValid(
                    $cabang,
                    $start,
                    $idjadwal_audit
                );
                if ($getPartValid) {
                    foreach ($getPartValid as $list) {
                        $start++;
                        $output .=
                            '
                            <tr> 
                            <td>' .
                    $start .
                    '</td>
                            <td class="text-center">' .
                    $list['nama_cabang'] .
                    '</td>
                            <td class="text-center">' .
                    $list['nama_gudang'] .
                    '</td>
                            <td class="text-center">' .
                    $list['part_number'] .
                    '</td>
                            <td class="text-center">' .
                    $list['deskripsi'] .
                    '</td>
                            <td class="text-center">' .
                    $list['qty'] .
                    '</td>
                            <td class="text-center">' .
                    $list['kd_lokasi_rak'] .
                    '</td>
                            <td class="text-center">' .
                    $list['status'] .
                    '</td>
                            <td class="text-center">' .
                    $list['kondisi'] .
                    '</td>
                            <td class="text-center">' .
                    $list['keterangan'] .
                    '</td>
                            </tr> 
                                    ';
                    }
                }
            } else {
                $info = 'Data Gagal diaudit';
                $output = '';
                $count = $this->mtransauditor->countpart1(
                    $cabang,
                    $idjadwal_audit
                );
                $this->load->library('pagination');

                $config['base_url'] =
                    base_url() . 'transaksi_auditor/ajax_partvalid';
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

                $page = floor($count / 15); //$this->uri->segment(3);
                if ($page == null) {
                    $page = 1;
                }
                $start = ($page - 1) * $config['per_page'];
                $getPartValid = $this->mtransauditor->getPartValid(
                    $cabang,
                    $start,
                    $idjadwal_audit
                );
                if ($getPartValid) {
                    foreach ($getPartValid as $list) {
                        $start++;
                        $output .=
                            '
                                    <tr> 
                                        <td class="text-center">' .
                            $start .
                            '</td>
                                        <td></td>
                                        <td class = "text-center>' .
                            $list['nama_gudang'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['part_number'] .
                            '</td>
                                        <td  class="text-center">' .
                            $list['deskripsi'] .
                            '</td>
                                        <td  class="text-center">' .
                            $list['kd_lokasi_rak'] .
                            '</td>
                                        <td  class="text-center">' .
                            $list['qty'] .
                            '</td>
                                        <td  class="text-center">' .
                            $list['status'] .
                            '</td>
                                    </tr>     
                                    ';
                    }
                }
            }
        }
        $data = [
            'info' => $info,
            'output' => $output,
            'manual' => $manual,
        ];
        echo json_encode($data, true);
    }

    //

    public function scan_data_part()
    {
        // var_dump("tes123");exit;
        $scanpart = $this->input->post('id');
        $cabang = $this->input->post('cabang');
        $lokasi = $this->input->post('lokasi');
        $rakbin = $this->input->post('kd_lokasi_rak');
        $kondisi = $this->input->post('kondisi');
        $status = $this->input->post('status');
        $qty = $this->input->post('qty');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        // $qty = $this->input->post('qty');
        $output = '';
        $manual = false;
        $base = base_url();
        $info = '';
        // var_dump($lokasi);exit;
        $param=array(
            $scanpart, $cabang, $rakbin, $lokasi, $idjadwal_audit
        );
        // var_dump($rakbin);exit;
        // var_dump($status);exit;

        $dataPart = $this->mtransauditor->caripart(
            $scanpart,
            $cabang,
            $idjadwal_audit,
            $rakbin
        );
        // var_dump($dataPart);exit;
        if ($dataPart) {
            foreach ($dataPart as $part) {
                if ($part['id_lokasi'] == $lokasi AND $part['kd_lokasi_rak'] == $rakbin) {
                    $data = [
                        'id_part' => $part['id_part'],
                        'id_cabang' => $part['id_cabang'],
                        'id_lokasi' => $part['id_lokasi'],
                        'part_number' => $part['part_number'],
                        'kd_lokasi_rak' => $rakbin,
                        'deskripsi' => $part['deskripsi'],
                        'qty' => 1,
                        'kondisi' => $kondisi,
                        'status' => 'Sesuai',
                        'idjadwal_audit' => $idjadwal_audit,
                    ];
                }elseif($part['kd_lokasi_rak'] == $rakbin) {
                    $data = [
                        'id_part' => $part['id_part'],
                        'id_cabang' => $part['id_cabang'],
                        'id_lokasi' => $part['id_lokasi'],
                        'part_number' => $part['part_number'],
                        'kd_lokasi_rak' => $rakbin,
                        'deskripsi' => $part['deskripsi'],
                        'qty' => 1,
                        'kondisi' => $kondisi,
                        'status' => ' Rakbin Belum Sesuai',
                        'idjadwal_audit' => $idjadwal_audit,
                    ]; 
                }else {
                    $data = [
                        'id_part' => $part['id_part'],
                        'id_cabang' => $part['id_cabang'],
                        'id_lokasi' => $lokasi,
                        'part_number' => $part['part_number'],
                        'kd_lokasi_rak' => $rakbin,
                        'deskripsi' => $part['deskripsi'],
                        'qty' => 1,
                        'kondisi' => $kondisi,
                        'status' => 'belum sesuai',
                        'idjadwal_audit' => $idjadwal_audit,
                    ];
                }
            }
            // var_dump($data);exit;
            $cek_part = $this->mtransauditor->cekPart(
                $scanpart,
                $cabang,
                $idjadwal_audit
            );
            // var_dump($cek_part[0]["id_part"]);exit;
            if ($cek_part) {
                $info = 'Data diupdate';
                $output = '';

                $qty_temppart = $part['qty'];
                $qty_part = $cek_part[0]['qty'] + 1;
                // var_dump($part);
                // var_dump($qty_part);
                // var_dump($qty_temppart);
                // exit;
                if($qty_part > $qty_temppart){
                    $data_edit = [
                        'id_part' => $cek_part[0]["id_part"],
                        'id_cabang' => $part['id_cabang'],
                        'id_lokasi' => $part['id_lokasi'],
                        'part_number' => $part['part_number'],
                        'kd_lokasi_rak' => $part['kd_lokasi_rak'],
                        'deskripsi' => $part['deskripsi'],
                        'qty' => $qty_part,
                        'kondisi' => $kondisi,
                        'status' => $status,
                        'keterangan' => 'Part Lebih',
                        'idjadwal_audit' => $idjadwal_audit
                    ];
                    
                // var_dump($data_edit);exit;
                $this->mtransauditor->editscanpart($data_edit);
                } elseif ($qty_part < $qty_temppart){
                    $data_edit = [
                        'id_part' => $cek_part[0]["id_part"],
                        'id_cabang' => $part['id_cabang'],
                        'id_lokasi' => $part['id_lokasi'],
                        'part_number' => $part['part_number'],
                        'kd_lokasi_rak' => $part['kd_lokasi_rak'],
                        'deskripsi' => $part['deskripsi'],
                        'qty' => $qty_part,
                        'kondisi' => $kondisi,
                        'status' => $status,
                        'keterangan' => 'Part Kurang',
                        'idjadwal_audit' => $idjadwal_audit
                    ];
                    
                // var_dump($data_edit);exit;
                $this->mtransauditor->editscanpart($data_edit);
                // exit;
                } elseif ($qty_part == $qty_temppart){
                    $data_edit = [
                        'id_part' => $cek_part[0]["id_part"],
                        'id_cabang' => $part['id_cabang'],
                        'id_lokasi' => $part['id_lokasi'],
                        'part_number' => $part['part_number'],
                        'kd_lokasi_rak' => $part['kd_lokasi_rak'],
                        'deskripsi' => $part['deskripsi'],
                        'qty' => $qty_part,
                        'kondisi' => $kondisi,
                        'status' => $status,
                        'keterangan' => 'Part Sesuai',
                        'idjadwal_audit' => $idjadwal_audit
                    ];
                    
                // var_dump($data_edit);exit;
                $this->mtransauditor->editscanpart($data_edit);
                }

                // exit;
                $count = $this->mtransauditor->countpart1(
                    $cabang,
                    $idjadwal_audit
                );
                // var_dump($count);exit;
               
                $this->load->library('pagination');

                $config['base_url'] =
                    base_url() . 'transaksi_auditor/ajax_partvalid';
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
                $config['last\_tag_close'] = '</li>';
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

                $page = ceil($count / 15); //$this->uri->segment(3);
                if ($page == null) {
                    $page = 1;
                }
                $start = ($page - 1) * $config['per_page'];
                $getpart = $this->mtransauditor->getPartValid(
                    $cabang,
                    $start,
                    $idjadwal_audit
                );
                // var_dump($getpart);exit;
                if ($getpart) {
                    foreach ($getpart as $list) {
                        $start++;
                        $output .=
                            '
                                    <tr> 
                                        <td class="text-center">' .
                            $start .
                            '</td>
                                        <td class="text-center">' .
                            $list['nama_cabang'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['nama_gudang'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['part_number'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['deskripsi'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['qty'] .
                            '</td>
                                        <td class=a"text-center">' .
                            $list['kd_lokasi_rak'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['status'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['kondisi'] .
                            '</td>
                                        <td class="text-center">' .
                            $list['keterangan'] .
                            '</td>
                                    </tr>     
                                    ';
                    }
                }
            } else {
                $info = 'Data Ditambahkan';
                if ($this->mtransauditor->addscanpart($data)) {
                    $output = '';
                    $count = $this->mtransauditor->countpart1(
                        $cabang,
                        $idjadwal_audit
                    );
                    $this->load->library('pagination');

                    $config['base_url'] =
                        base_url() . 'transaksi_auditor/ajax_partvalid';
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
                    $getpart = $this->mtransauditor->getPartValid(
                        $cabang,
                        $start,
                        $idjadwal_audit
                    );
                    // var_dump($getpart);exit;
                    if ($getpart) {
                        foreach ($getpart as $list) {
                            $start++;
                            $output .=
                                '
                                        <tr> 
                                        <td>' .
                                $start .
                                '</td>
                                        <td class="text-center">' .
                                $list['nama_cabang'] .
                                '</td>
                                        <td class="text-center">' .
                                $list['nama_gudang'] .
                                '</td>
                                        <td class="text-center">' .
                                $list['part_number'] .
                                '</td>
                                        <td class="text-center">' .
                                $list['deskripsi'] .
                                '</td>
                                        <td class="text-center">' .
                                $list['qty'] .
                                '</td>
                                        <td class="text-center">' .
                                $list['kd_lokasi_rak'] .
                                '</td>
                                        <td class="text-center">' .
                                $list['status'] .
                                '</td>
                                        <td class="text-center">' .
                                $list['kondisi'] .
                                '</td>
                                        <td class="text-center">' .
                                $list['keterangan'] .
                                '</td>
                                        </tr>     
                                        ';
                        }
                    }
                }
            }
        } else {
            $info = 'Data not found';
            $manual = true;
            $output = '';
            $manual = true;
            $count = $this->mtransauditor->countpart1($cabang, $idjadwal_audit);
            $this->load->library('pagination');

            $config['base_url'] =
                base_url() . 'transaksi_auditor/ajax_partvalid';
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

            $page = ceil($count / 15); //$this->uri->segment(3);
            if ($page == null) {
                $page = 1;
            }
            $start = ($page - 1) * $config['per_page'];
            $getpart = $this->mtransauditor->getPartValid(
                $cabang,
                $start,
                $idjadwal_audit
            );
            if ($getpart) {
                foreach ($getpart as $list) {
                    $start++;
                    $output .=
                        '
                        <tr> 
                        <td>' .
                $start .
                '</td>
                        <td class="text-center">' .
                $list['nama_cabang'] .
                '</td>
                        <td class="text-center">' .
                $list['nama_gudang'] .
                '</td>
                        <td class="text-center">' .
                $list['part_number'] .
                '</td>
                        <td class="text-center">' .
                $list['deskripsi'] .
                '</td>
                        <td class="text-center">' .
                $list['qty'] .
                '</td>
                        <td class="text-center">' .
                $list['kd_lokasi_rak'] .
                '</td>
                        <td class="text-center">' .
                $list['status'] .
                '</td>
                        <td class="text-center">' .
                $list['kondisi'] .
                '</td>
                        <td class="text-center">' .
                $list['keterangan'] .
                '</td>
                        </tr> 
                                    ';
                }
            }
        }
        $data = [
            'info' => $info,
            'output' => $output,
            'manual' => $manual,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }

    public function ajax_temppart()
    {
        $cabang = $this->input->post('cabang');
        // $cabang='T13';
        $output = '';
        $count = $this->mtransauditor->counttemppart($cabang);
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'transaksi_auditor/ajax_temppart';
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

        //$page = floor($count / 15);
        $page = $this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        // tes
        $start = ($page - 1) * $config['per_page'];
        $getunit = $this->mtransauditor->getToPart($cabang, $start);
        if ($getunit) {
            foreach ($getunit as $list) {
                $start++;
                $output .=
                    '
                    <tr> 
                            <td>' .
                    $start .
                    '</td>
                            <td>' .
                    $list['nama_cabang'] .
                    '</td>
                            <td>' .
                    $list['nama_gudang'] .
                    '</td>
                            <td>' .
                    $list['part_number'] .
                    '</td>
                            <td>' .
                    $list['deskripsi'] .
                    '</td>
                            <td>' .
                    $list['kd_lokasi_rak'] .
                    '</td>
                            <td>' .
                    $list['qty'] .
                    '</td>
                        </tr>    
                        ';
            }
        } else {
            $output .=
                '<tr><td colspan="13" class="text-center">data not found</td></tr>';
        }
        $row_entry =
            '
    <div class=" label label-default">' .
            $count .
            '</div>
';
        $data = [
            'pagination' => $this->pagination->create_links(),
            'output' => $output,
        ];

        echo json_encode($data, true);
    }

    public function closepart()
    {
        $id = $this->input->post('id');
        $a = base64_decode($this->input->post('a'));
        if ($id == null) {
            $data = [
                'status' => false,
                'info' => 'Check your data',
            ];
        } else {
            $list = $this->mtransauditor->closepart($id, $a);
            if ($list) {
                $data = [
                    'status' => true,
                ];
            } else {
                $data = [
                    'status' => false,
                    'info' => 'Failed Closed',
                ];
            }
        }
        echo json_encode($data, true);
    }

    public function previewpart($page)
    {
        $cabang = $this->input->post('id_cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $status = $this->input->post('status');
        $kondisi = $this->input->post('kondisi');

        $count = $this->mtransauditor->countpart(
            $cabang,
            $idjadwal_audit,
            $status,
            $kondisi
        );
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'transaksi_auditor/previewpart';
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

        //$page = floor($count / 15);
        // $page = $this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        $start = ($page - 1) * $config['per_page'];

        $cetak = $this->mtransauditor->previewPart(
            $cabang,
            $idjadwal_audit,
            $status,
            $start,
            $kondisi
        );
        $row_entry =
            '
            <div class=" label label-default">' .
            $count .
            '</div>
        ';
        $output = [
            'pagination_link' => $this->pagination->create_links(),
            'part_list' => $cetak,
            'row_entry' => $row_entry,
        ];

        echo json_encode($output);
    }

    // tidak ada preview
    // tidakk ada fungsi manual yang digunakan untuk menambahkan data part (mungkin data dimasukan dari SIMANDE)
    /* END OF PART */
}
