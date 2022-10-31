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
            if ($this->session->userdata('usergroup') == 'UG002' || $this->session->userdata('usergroup') == 'UG005') {
            } else {
                require_once('Login.php');
            }
        }
    }

    public function Audit()
    {
        $data = [
            'judul' => "Audit",
            'judul1' => 'Transaksi Auditor'
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('auditorview/audit/v_audit.php', $data);
        $this->load->view('auditorview/audit/_partial/footer.php');
    }
    public function temp_unit()
    {

        $data = [
            'judul' => "Audit",
            'judul1' => 'Transaksi Auditor'
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('auditorview/audit/v_temp_unit.php', $data);
        $this->load->view('auditorview/audit/_partial/footer3.php');
    }
    public function temp_part()
    {

        $data = [
            'judul' => "Audit",
            'judul1' => 'Transaksi Auditor'
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('auditorview/audit/v_temp_part.php', $data);
        $this->load->view('auditorview/audit/_partial/footer4.php');
    }
    public function downloadunit()
    {
        $id = $this->input->post('id');
        $idaudit = $this->input->post('idaudit');
        $output = '';
        if ($this->mtransauditor->downloadunit($id, $idaudit)) {
            $output .= '<div class="text-success"> Data Berhasil Didownload</div>';
        } else {
            $output .= '<div class="text-danger"> Data Telah Didownload</div>';
        }

        echo json_encode($output, true);
    }
    public function downloadpart()
    {
        $id = $this->input->post('id');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $output = '';
        if ($this->mtransauditor->downloadpart($id, $idjadwal_audit)) {
            $output .= '<div class="text-success"> Data Berhasil Didownload</div>';
        } else {
            $output .= '<div class="text-danger"> Data Telah Didownload</div>';
        }

        echo json_encode($output, true);
    }
    public function AuditPart()
    {
        $data = [
            'judul' => "Audit",
            'judul1' => 'Transaksi Auditor'
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('auditorview/audit/v_audit_part.php', $data);
        $this->load->view('auditorview/audit/_partial/footer2.php');
    }
    public function ajax_partvalid($page)
    {
        $cabang = $this->input->post('cabang');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        // $cabang='T13';
        $output = '';
        $count = $this->mtransauditor->countpart1($cabang, $idjadwal_audit);
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'transaksi_auditor/ajax_partvalid';
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

        //$page = $this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        $start = ($page - 1) * $config['per_page'];
        $getpart = $this->mtransauditor->getDataPart($cabang, $start, $idjadwal_audit);
        if ($getpart) {
            foreach ($getpart as $list) {
                $start++;
                $output .= '
                            <tr> 
                                <td>' . $start . '</td>
                                <td></td>
                                <td>' . $list['nama_gudang'] . '</td>
                                <td>' . $list['part_number'] . '</td>
                                <td>' . $list['deskripsi'] . '</td>
                                <td>' . $list['kd_lokasi_rak'] . '</td>
                                <td>' . $list['qty'] . '</td>
                                <td>' . $list['status'] . '</td>
                            </tr>       
                            ';
            }
        } else {
            $output .= '<tr><td colspan="13" class="text-center">data not found</td></tr>';
        }
        $data = [
            'pagination' => $this->pagination->create_links(),
            'output' => $output
        ];

        echo json_encode($data, true);
    }

    public function Aksesoris()
    {
        $data = [
            'judul' => "Aksesoris",
            'judul1' => 'Transaksi Auditor',
            'tgl' => date('m/d/Y')
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php', $data);
        $this->load->view('auditorview/aksesoris/v_aksesoris.php', $data);
        $this->load->view('auditorview/aksesoris/_partial/footer.php');
    }

    // public function Audit_Inventory()
    // {
    //     $data = [
    //         'judul' => "Audit Inventory",
    //         'judul1' => 'Transaksi Auditor'
    //     ];
    //     $this->load->view('_partial/header.php', $data);
    //     $this->load->view('_partial/sidebar.php');
    //     $this->load->view('auditorview/audit_inventory/v_audit_inventory.php', $data);
    //     $this->load->view('auditorview/audit_inventory/_partial/footer.php');
    // }

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
            'judul' => "List Audit Inventory",
            'judul1' => 'Transaksi Auditor',
            'tgl' => date('m/d/Y')
        ];

        $config['base_url'] = base_url() . "transaksi/audit_unit";
        $config['total_rows'] = $this->mtransauditor->countunit($cabang, $tgl_awal, $tgl_akhir, $status);
        $config['per_page'] = 15;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'pages';
        $config['num_links'] = 2;

        $config['full_tag_open'] = '<div class="pagination"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
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
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/audit_inventory/v_list_audit_inventory.php', $data);
        $this->load->view('auditorview/audit_inventory/_partial/footer.php');
    }

    public function Manual_Audit()
    {
        $no_mesin = $this->input->get('no_mesin');
        $data = [
            'judul' => "Manual Audit",
            'judul1' => 'Transaksi Auditor',
            'edit' => $this->mtransauditor->getUnitField($no_mesin)
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/audit/v_manual.php', $data);
        $this->load->view('auditorview/audit/_partial/footer.php');
    }

    public function ListAudit_Part()
    {
        $cabang = $this->input->post('id_cabang');
        $lokasi = $this->input->post('id_lokasi');
        $part_number = $this->input->post('part_number');
        $status = $this->input->post('status');
        $data = [
            'judul' => "List Audit Part",
            'judul1' => 'Transaksi Auditor',
            'tgl' => date('m/d/Y')
        ];

        $config['base_url'] = base_url() . "transaksi/audit_part";
        $config['total_rows'] = $this->mtransauditor->countpart($cabang, $lokasi, $part_number, $status);
        $config['per_page'] = 15;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'pages';
        $config['num_links'] = 2;

        $config['full_tag_open'] = '<div class="pagination"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
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
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/audit_part/v_list_audit_part.php', $data);
        $this->load->view('auditorview/audit_part/_partial/footer.php');
    }



    public function Scaning_Audit()
    {
        $data = [
            'judul' => "Scaning Audit",
            'judul1' => 'Transaksi Auditor'
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
            'judul' => "Audit Unit",
            'judul1' => 'Transaksi Auditor',
            'edit' => $this->mtransauditor->getUnitById($id)

        ];
        // var_dump($data['edit']);die;
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/audit_unit/v_edit_unit.php', $data);
        $this->load->view('auditorview/audit_unit/_partial/footer2.php', $data);
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
            'judul' => "Audit Unit",
            'judul1' => 'Transaksi Auditor',
            'tgl' => date('m/d/Y')
        ];

        $config['base_url'] = base_url() . "transaksi/audit_unit";
        $config['total_rows'] = $this->mtransauditor->countunit($cabang, $tgl_awal, $tgl_akhir, $status);
        $config['per_page'] = 15;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'pages';
        $config['num_links'] = 2;

        $config['full_tag_open'] = '<div class="pagination"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
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
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/audit_unit/v_audit_unit.php', $data);
        $this->load->view('auditorview/audit_unit/_partial/footer.php');
    }

    public function Audit_Part()
    {
        $data = [
            'judul' => "Audit Part",
            'judul1' => 'Transaksi Auditor'
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('auditorview/audit_part/v_audit_part.php', $data);
        $this->load->view('auditorview/audit_part/_partial/footer.php');
    }


    public function preview($page)
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

        //$page = floor($count / 15); 
        //$page = $this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        $start = ($page - 1) * $config['per_page'];

        $cetak = $this->mtransauditor->previewUnit($cabang, $idjadwal_audit, $status, $start);
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

    //-------------------------GET--------------------------------///
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
                $output .= '
                        <option value="' . $lokcab['kd_gudang'] . '" selected>' . '(' . $lokcab['jenis_gudang'] . ') ' . $lokcab['nama_gudang'] . ' - ' . $lokcab['alamat'] . '</option>
                    ';
            } else {
                $output .= '
                        <option value="' . $lokcab['kd_gudang'] . '">' . '(' . $lokcab['jenis_gudang'] . ') ' . $lokcab['nama_gudang'] . ' - ' . $lokcab['alamat'] . '</option>
                    ';
            }
            //}
        }
        echo json_encode($output, true);
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
            $output .= '
            <tr> 
                <td class="text-center">' . $offset . '</td>
                <td class="text-center"></td>
                <td class="text-center">' . $list['id_unit'] . '</td>
                <td class="text-center">' . $list['no_mesin'] . '</td>
                <td class="text-center">' . $list['no_rangka'] . '</td>
                <td class="text-center">' . $list['nama_cabang'] . '</td>
                <td class="text-center">' . $list['nama_gudang'] . '</td>
                <td class="text-center">' . $list['umur_unit'] . '</td>
                <td class="text-center">' . $list['status_unit'] . '</td>
                <td class="text-center">' . $list['aki'] . '</td>
                <td class="text-center">' . $list['spion'] . '</td>
                <td class="text-center">' . $list['helm'] . '</td>
                <td class="text-center">' . $list['tools'] . '</td>
                <td class="text-center">' . $list['buku_service'] . '</td>
                <td class="text-center">' . $list['tahun'] . '</td>
                <td class="text-center">' . $list['type'] . '</td>
                <td class="text-center">' . $list['kode_item'] . '</td>
                <td class="text-center">' . $list['foto'] . '</td>
                <td class="text-center">' . $list['keterangan'] . '</td>
                <td class="text-center">' . $list['is_ready'] . '</td>
                <td class="text-center">' . $list['tanggal_audit'] . '</td>
            </tr>     
            ';
        }
        echo $output;
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
                $output .= '
				<tr> 
					<td class="text-center">' . $no . '</td>
					<td class="text-center"><a onclick="edit(id=\'' . $list['id_part'] . '\')" class="text-warning" ><i class="fa fa-pencil"></i></a></td>
					<td class="text-center">' . $list['nama_cabang'] . '</td>
					<td class="text-center">' . $list['nama_gudang'] . '</td>
					<td class="text-center">' . $list['part_number'] . '</td>
					<td class="text-center">' . $list['kd_lokasi_rak'] . '</td>
					<td class="text-center">' . $list['deskripsi'] . '</td>
					<td class="text-center">' . $list['qty'] . '</td>
					<td class="text-center">' . $list['status'] . '</td>
				</tr>
				
				';
            }
        } else {
            $output .= '<tr><td colspan="9" class="text-center">Belum Ada Data</td></tr>';
        }
        echo $output;
    }

    public function ajax_get_cabang2()
    {
        $output = '';
        $no = 0;
        $listcabang = $this->mtransauditor->getCabang();
        foreach ($listcabang as $list) {
            $no++;
            $output .= '
				<option value="' . $list['id_cabang'] . '">' . $list['id_cabang'] . ' - ' . $list['nama_cabang'] . '</option>
			';
        }
        echo '<option value="">--- Pilih Cabang ---</option>';
        echo $output;
    }

    public function ajax_get_jadwalaudit($idcabang = null)
    {
        $output = '';
        $no = 0;
        $listcabang = $this->mtransauditor->getJadwalAudit($idcabang);
        foreach ($listcabang as $list) {
            $no++;
            $output .= '
				<option value="' . $list['idjadwal_audit'] . '">' . $list['idjadwal_audit'] . ' (' . $list['tanggal'] . ')</option>
			';
        }
        echo '<option value="">--- Pilih ID Audit ---</option>';
        echo $output;
    }

    public function ajax_get_jadwalauditpart($idcabang = null)
    {
        $output = '';
        $no = 0;
        $listcabang = $this->mtransauditor->getJadwalAuditPart($idcabang);
        foreach ($listcabang as $list) {
            $no++;
            $output .= '
				<option value="' . $list['idjadwal_audit'] . '">' . $list['idjadwal_audit'] . ' (' . $list['tanggal'] . ')</option>
			';
        }
        echo '<option value="">--- Pilih ID Audit ---</option>';
        echo $output;
    }

    public function post_unitmanual()
    {
        $data = [
            'id_unit'     => $this->input->post('id_unit', true),
            'no_mesin'    => $this->input->post('no_mesin', true),
            'no_rangka'   => $this->input->post('no_rangka', true),
            'type_unit'   => $this->input->post('type_unit', true),
            'usia_unit'   => $this->input->post('usia_unit', true),
            'is_ra'   => $this->input->post('usia_unit', true),
            'user'        => $this->session->userdata('username')
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
                $this->session->set_flashdata('berhasil', 'Data Berhasil Ditambahkan');
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
            'keterangan' => $this->input->post('keterangan')

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
                'penanggung_jawab' => $_POST['penanggungjawab'][$i]
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
            'idjadwal_audit' => $idjadwal_audit
        ];

        $cek = $this->mtransauditor->cek($scanunit, $cabang, $idjadwal_audit);
        if ($cek) {
            $info = 'Data Telah diaudit';
            $output = '';
            $count = $this->mtransauditor->countunit1($cabang, $idjadwal_audit);
            $this->load->library('pagination');

            $config['base_url'] = base_url() . 'transaksi_auditor/ajax_unitvalid';
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

            $page = floor($count / 15); //$this->uri->segment(3);
            if ($page == null) {
                $page = 1;
            }
            $start = ($page - 1) * $config['per_page'];
            $getunit = $this->mtransauditor->getUnit($cabang, $start, $idjadwal_audit);
            if ($getunit) {
                foreach ($getunit as $list) {
                    $start++;
                    $output .= '
                                    <tr> 
                                        <td class="text-center">' . $start . '</td>
                                        <td></td>
                                        <td class="text-center">' . $list['no_mesin'] . '</td>
                                        <td class="text-center">' . $list['no_rangka'] . '</td>
                                        <td class="text-center">' . $list['nama_cabang'] . '</td>
                                        <td class="text-center">' . $list['nama_gudang'] . '</td>
                                        <td class="text-center">' . $list['status_unit'] . '</td>
                                        <td class="text-center">' . $list['tahun'] . '</td>
                                        <td class="text-center">' . $list['type'] . '</td>
                                        <td class="text-center">' . $list['kode_item'] . '</td>
                                        <td class="text-center">' . $list['keterangan'] . '</td>
                                        <td class="text-center">' . $list['is_ready'] . '</td>
                                    </tr>     
                                    ';
                }
            }
        } else {
            if ($this->mtransauditor->addscanunit($data)) {
                $info = 'Data Berhasil diaudit';
                $output = '';
                $count = $this->mtransauditor->countunit1($cabang, $idjadwal_audit);
                $this->load->library('pagination');

                $config['base_url'] = base_url() . 'transaksi_auditor/ajax_unitvalid';
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

                $page = floor($count / 15); //$this->uri->segment(3);
                if ($page == null) {
                    $page = 1;
                }
                $start = ($page - 1) * $config['per_page'];
                $getunit = $this->mtransauditor->getUnit($cabang, $start, $idjadwal_audit);
                if ($getunit) {
                    foreach ($getunit as $list) {
                        $start++;
                        $output .= '
                                        <tr> 
                                            <td class="text-center">' . $start . '</td>
                                            <td></td>
                                            <td class="text-center">' . $list['no_mesin'] . '</td>
                                            <td class="text-center">' . $list['no_rangka'] . '</td>
                                            <td class="text-center">' . $list['nama_cabang'] . '</td>
                                            <td class="text-center">' . $list['nama_gudang'] . '</td>
                                            <td class="text-center">' . $list['status_unit'] . '</td>
                                            <td class="text-center">' . $list['tahun'] . '</td>
                                            <td class="text-center">' . $list['type'] . '</td>
                                            <td class="text-center">' . $list['kode_item'] . '</td>
                                            <td class="text-center">' . $list['keterangan'] . '</td>
                                            <td class="text-center">' . $list['is_ready'] . '</td>
                                        </tr>     
                                        ';
                    }
                }
            } else {
                $info = 'Data Gagal diaudit';
                $output = '';
                $count = $this->mtransauditor->countunit1($cabang, $idjadwal_audit);
                $this->load->library('pagination');

                $config['base_url'] = base_url() . 'transaksi_auditor/ajax_unitvalid';
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

                $page = floor($count / 15); //$this->uri->segment(3);
                if ($page == null) {
                    $page = 1;
                }
                $start = ($page - 1) * $config['per_page'];
                $getunit = $this->mtransauditor->getUnit($cabang, $start, $idjadwal_audit);
                if ($getunit) {
                    foreach ($getunit as $list) {
                        $start++;
                        $output .= '
                                        <tr> 
                                            <td class="text-center">' . $start . '</td>
                                            <td></td>
                                            <td class="text-center">' . $list['no_mesin'] . '</td>
                                            <td class="text-center">' . $list['no_rangka'] . '</td>
                                            <td class="text-center">' . $list['nama_cabang'] . '</td>
                                            <td class="text-center">' . $list['nama_gudang'] . '</td>
                                            <td class="text-center">' . $list['status_unit'] . '</td>
                                            <td class="text-center">' . $list['tahun'] . '</td>
                                            <td class="text-center">' . $list['type'] . '</td>
                                            <td class="text-center">' . $list['kode_item'] . '</td>
                                            <td class="text-center">' . $list['keterangan'] . '</td>
                                            <td class="text-center">' . $list['is_ready'] . '</td>
                                        </tr>     
                                        ';
                    }
                }
            }
        }
        $data = [
            'info' => $info,
            'output' => $output,
            'manual' => $manual
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
                        'keterangan' => null,
                        'idjadwal_audit' => $idjadwal_audit
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
                        'idjadwal_audit' => $idjadwal_audit
                    ];
                }
            }
            $cek = $this->mtransauditor->cek($scanunit, $cabang, $idjadwal_audit);
            if ($cek) {
                $info = 'Data Telah diaudit';
                $output = '';
                $count = $this->mtransauditor->countunit1($cabang, $idjadwal_audit);
                $this->load->library('pagination');

                $config['base_url'] = base_url() . 'transaksi_auditor/ajax_unitvalid';
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

                $page = ceil($count / 15); //$this->uri->segment(3);
                if ($page == null) {
                    $page = 1;
                }
                $start = ($page - 1) * $config['per_page'];
                $getunit = $this->mtransauditor->getUnit($cabang, $start, $idjadwal_audit);
                if ($getunit) {
                    foreach ($getunit as $list) {
                        $start++;
                        $output .= '
                                    <tr> 
                                        <td class="text-center">' . $start . '</td>
                                        <td></td>
                                        <td class="text-center">' . $list['no_mesin'] . '</td>
                                        <td class="text-center">' . $list['no_rangka'] . '</td>
                                        <td class="text-center">' . $list['nama_cabang'] . '</td>
                                        <td class="text-center">' . $list['nama_gudang'] . '</td>
                                        <td class="text-center">' . $list['status_unit'] . '</td>
                                        <td class="text-center">' . $list['tahun'] . '</td>
                                        <td class="text-center">' . $list['type'] . '</td>
                                        <td class="text-center">' . $list['kode_item'] . '</td>
                                        <td class="text-center">' . $list['keterangan'] . '</td>
                                        <td class="text-center">' . $list['is_ready'] . '</td>
                                    </tr>     
                                    ';
                    }
                }
            } else {
                $info = 'Data Berhasil diaudit';
                if ($this->mtransauditor->addscanunit($data)) {
                    $output = '';
                    $count = $this->mtransauditor->countunit1($cabang, $idjadwal_audit);
                    $this->load->library('pagination');

                    $config['base_url'] = base_url() . 'transaksi_auditor/ajax_unitvalid';
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

                    $page = ceil($count / 15); //$this->uri->segment(3);
                    if ($page == null) {
                        $page = 1;
                    }
                    $start = ($page - 1) * $config['per_page'];
                    $getunit = $this->mtransauditor->getUnit($cabang, $start, $idjadwal_audit);
                    if ($getunit) {
                        foreach ($getunit as $list) {
                            $start++;
                            $output .= '
                                        <tr> 
                                            <td>' . $start . '</td>
                                            <td></td>
                                            <td>' . $list['no_mesin'] . '</td>
                                            <td>' . $list['no_rangka'] . '</td>
                                            <td>' . $list['nama_cabang'] . '</td>
                                            <td>' . $list['nama_gudang'] . '</td>
                                            <td>' . $list['status_unit'] . '</td>
                                            <td>' . $list['tahun'] . '</td>
                                            <td>' . $list['type'] . '</td>
                                            <td>' . $list['kode_item'] . '</td>
                                            <td>' . $list['keterangan'] . '</td>
                                            <td>' . $list['is_ready'] . '</td>
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

            $config['base_url'] = base_url() . 'transaksi_auditor/ajax_unitvalid';
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

            $page = ceil($count / 15); //$this->uri->segment(3);
            if ($page == null) {
                $page = 1;
            }
            $start = ($page - 1) * $config['per_page'];
            $getunit = $this->mtransauditor->getUnit($cabang, $start, $idjadwal_audit);
            if ($getunit) {
                foreach ($getunit as $list) {
                    $start++;
                    $output .= '
                                <tr> 
                                    <td>' . $start . '</td>
                                    <td></td>
                                    <td>' . $list['no_mesin'] . '</td>
                                    <td>' . $list['no_rangka'] . '</td>
                                    <td>' . $list['nama_cabang'] . '</td>
                                    <td>' . $list['nama_gudang'] . '</td>
                                    <td>' . $list['status_unit'] . '</td>
                                    <td>' . $list['tahun'] . '</td>
                                    <td>' . $list['type'] . '</td>
                                    <td>' . $list['kode_item'] . '</td>
                                    <td>' . $list['keterangan'] . '</td>
                                    <td>' . $list['is_ready'] . '</td>
                                </tr>     
                                ';
                }
            }
        }
        $data = [
            'info' => $info,
            'output' => $output,
            'manual' => $manual,
            'pagination' => $this->pagination->create_links()
        ];
        echo json_encode($data, true);
    }

    public function scan_data_part()
    {
        $scanpart = $this->input->post('id');
        $cabang = $this->input->post('cabang');
        $lokasi = $this->input->post('lokasi');
        $rakbin = $this->input->post('rakbin');
        $kondisi = $this->input->post('kondisi');
        $idjadwal_audit = $this->input->post('idjadwal_audit');
        $output = '';
        $base = base_url();
        $info = '';
        if ($scanpart != null) {
            $dataPart = $this->mtransauditor->caripart($scanpart, $cabang, $idjadwal_audit);
        } else {
            $dataPart = null;
        }
        if ($dataPart) {
            $cek = $this->mtransauditor->cekPart($scanpart, $cabang, $rakbin, $lokasi, $kondisi, $idjadwal_audit);
            if ($cek) {
                foreach ($cek as $c) {
                    $part = $c['qty'];
                    $data = [
                        'id' => $c['id_part'],
                        'qty' => $part + 1,
                    ];
                }
                // var_dump($data);
                $info = 'Data Diupdate';
                if ($this->mtransauditor->editscanpart($data)) {
                    $output = '';
                    $count = $this->mtransauditor->countpart1($cabang, $idjadwal_audit);
                    $this->load->library('pagination');
                    $page = ceil($count / 15);

                    $config['base_url'] = base_url() . 'transaksi_auditor/ajax_partvalid';
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
                    $config["cur_page"] = $page;

                    $this->pagination->initialize($config);

                    //$page = $this->uri->segment(3);
                    //$this->uri->segment(3);
                    if ($page == null) {
                        $page = 1;
                    }
                    $start = ($page - 1) * $config['per_page'];
                    $getpart = $this->mtransauditor->getpartvalid($cabang, $start, $idjadwal_audit);
                    if ($getpart) {
                        foreach ($getpart as $list) {
                            $start++;
                            $output .= '
                                            <tr> 
                                                <td>' . $start . '</td>
                                                <td></td>
                                                <td>' . $list['nama_gudang'] . '</td>
                                                <td>' . $list['part_number'] . '</td>
                                                <td>' . $list['deskripsi'] . '</td>
                                                <td>' . $list['kd_lokasi_rak'] . '</td>
                                                <td>' . $list['qty'] . '</td>
                                                <td>' . $list['status'] . '</td>
                                            </tr>       
                                            ';
                        }
                    }
                }
            } else {

                foreach ($dataPart as $part) {
                    $data = [
                        'id_cabang' => $part['id_cabang'],
                        'id_lokasi' => $lokasi,
                        'part_number' => $part['part_number'],
                        'kd_lokasi_rak' => $rakbin,
                        'deskripsi' => $part['deskripsi'],
                        'qty' => 1,
                        'status' => $kondisi,
                        'idjadwal_audit' => $idjadwal_audit
                    ];
                }
                $info = 'Data Ditambahkan';
                if ($this->mtransauditor->addscanpart($data)) {
                    $output = '';
                    $count = $this->mtransauditor->countpart1($cabang, $idjadwal_audit);
                    $this->load->library('pagination');
                    $page = ceil($count / 15);

                    $config['base_url'] = base_url() . 'transaksi_auditor/ajax_partvalid';
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
                    $config["cur_page"] = $page;

                    $this->pagination->initialize($config);

                    //$page = $this->uri->segment(3);
                    if ($page == null) {
                        $page = 1;
                    }
                    $start = ($page - 1) * $config['per_page'];
                    $getpart = $this->mtransauditor->getpartvalid($cabang, $start, $idjadwal_audit);
                    if ($getpart) {
                        foreach ($getpart as $list) {
                            $start++;
                            $output .= '
                                            <tr> 
                                                <td>' . $start . '</td>
                                                <td></td>
                                                <td>' . $list['nama_gudang'] . '</td>
                                                <td>' . $list['part_number'] . '</td>
                                                <td>' . $list['deskripsi'] . '</td>
                                                <td>' . $list['kd_lokasi_rak'] . '</td>
                                                <td>' . $list['qty'] . '</td>
                                                <td>' . $list['status'] . '</td>
                                            </tr>       
                                            ';
                        }
                    }
                }
            }
        } else {
            $info = 'Data not found';
            $output = '';
            $count = $this->mtransauditor->countpart1($cabang, $idjadwal_audit);
            $this->load->library('pagination');
            $page = ceil($count / 15);

            $config['base_url'] = base_url() . 'transaksi_auditor/ajax_partvalid';
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
            $config["cur_page"] = $page;

            $this->pagination->initialize($config);

            //$page = $this->uri->segment(3);
            if ($page == null) {
                $page = 1;
            }
            $start = ($page - 1) * $config['per_page'];
            $getpart = $this->mtransauditor->getpartvalid($cabang, $start, $idjadwal_audit);
            if ($getpart) {
                foreach ($getpart as $list) {
                    $start++;
                    $output .= '
                                            <tr> 
                                                <td>' . $start . '</td>
                                                <td></td>
                                                <td>' . $list['nama_gudang'] . '</td>
                                                <td>' . $list['part_number'] . '</td>
                                                <td>' . $list['deskripsi'] . '</td>
                                                <td>' . $list['kd_lokasi_rak'] . '</td>
                                                <td>' . $list['qty'] . '</td>
                                                <td>' . $list['status'] . '</td>
                                            </tr>       
                                            ';
                }
            }
        }
        $data = [
            'info' => $info,
            'output' => $output,
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
        $count = $this->mtransauditor->countunit1($cabang, $idjadwal_audit);
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'transaksi_auditor/ajax_unitvalid';
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

        //$page = floor($count / 15); //$this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        $start = ($page - 1) * $config['per_page'];
        $getunit = $this->mtransauditor->getUnit($cabang, $start, $idjadwal_audit);

        if ($getunit) {
            foreach ($getunit as $list) {
                $start++;
                $output .= '
                            <tr> 
                                <td>' . $start . '</td>
                                <td></td>
                                <td>' . $list['no_mesin'] . '</td>
                                <td>' . $list['no_rangka'] . '</td>
                                <td>' . $list['nama_cabang'] . '</td>
                                <td>' . $list['nama_gudang'] . '</td>
                                <td>' . $list['status_unit'] . '</td>
                                <td>' . $list['tahun'] . '</td>
                                <td>' . $list['type'] . '</td>
                                <td>' . $list['kode_item'] . '</td>
                                <td>' . $list['keterangan'] . '</td>
                                <td>' . $list['is_ready'] . '</td>
                            </tr>     
                            ';
            }
        } else {
            $output .= '<tr><td colspan="13" class="text-center">data not found</td></tr>';
        }
        $data = [
            'pagination' => $this->pagination->create_links(),
            'output' => $output
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

        $page = $p; //floor($count / 15); //$this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        $start = ($page - 1) * $config['per_page'];
        $getunit = $this->mtransauditor->getToUnit($cabang, $start);
        if ($getunit) {
            foreach ($getunit as $list) {
                $start++;
                $output .= '
                            <tr> 
                                <td>' . $start . '</td>
                                <td>' . $list['no_mesin'] . '</td>
                                <td>' . $list['no_rangka'] . '</td>
                                <td>' . $list['nama_gudang'] . '</td>
                                <td>' . (($list['tahun'] == "") ? "" : (((int)date("Y")) - $list['tahun'])) . '</td>
                                <td>' . $list['tahun'] . '</td>
                                <td>' . $list['type'] . '</td>
                                <td>' . $list['kode_item'] . '</td>
                            </tr>     
                            ';
            }
        } else {
            $output .= '<tr><td colspan="13" class="text-center">data not found</td></tr>';
        }
        $data = [
            'pagination' => $this->pagination->create_links(),
            'output' => $output
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

        $page = floor($count / 15); //$this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        $start = ($page - 1) * $config['per_page'];
        $getunit = $this->mtransauditor->getToPart($cabang, $start);
        if ($getunit) {
            foreach ($getunit as $list) {
                $start++;
                $output .= '
                        <tr> 
                                <td>' . $start . '</td>
                                <td></td>
                                <td>' . $list['nama_gudang'] . '</td>
                                <td>' . $list['part_number'] . '</td>
                                <td>' . $list['deskripsi'] . '</td>
                                <td>' . $list['kd_lokasi_rak'] . '</td>
                                <td>' . $list['qty'] . '</td>
                            </tr>    
                            ';
            }
        } else {
            $output .= '<tr><td colspan="13" class="text-center">data not found</td></tr>';
        }
        $data = [
            'pagination' => $this->pagination->create_links(),
            'output' => $output
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
                'info' => "Check your data"
            ];
        } else {
            $list = $this->mtransauditor->closeaudit($id, $a);
            if ($list) {
                $data = [
                    'status' => true
                ];
            } else {
                $data = [
                    'status' => false,
                    'info' => "Failed Closed"
                ];
            }
        }
        echo json_encode($data, true);
    }
}

/* End of file Transaksi_A.php */
