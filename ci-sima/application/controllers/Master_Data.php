<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_Data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->$this->load->library('pagination');
        ini_set('max_execution_time', 0);
        $this->load->model('m_master_data', 'mmasdat');
        $this->load->model('m_transaksi_ga', 'm_transga');
        $this->load->library('pagination');
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger">Login Dulu!</div>'
            );
            redirect('login/sima_login');
        } else {
            if (
                $this->session->userdata('usergroup') == 'UG001' ||
                $this->session->userdata('usergroup') == 'UG005'
            ) {
            } else {
                require_once 'Login.php';
            }
        }
    }
    public function viewUser()
    {
        $data = [
            'judul' => 'User',
            'judul1' => 'Master Data',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('general_affairview/user/v_user.php', $data);
        $this->load->view('general_affairview/user/_partial/footer.php');
    }

    public function viewUserGroup()
    {
        $data = [
            'judul' => 'User Group',
            'judul1' => 'Master Data',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'general_affairview/user_group/v_user_group.php',
            $data
        );
        $this->load->view('general_affairview/user_group/_partial/footer.php');
    }

    public function viewJenisinv()
    {
        $data = [
            'judul' => 'Jenis Inventory',
            'judul1' => 'Master Data',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'general_affairview/jenis_inventory/v_jenis_inventory.php',
            $data
        );
        $this->load->view(
            'general_affairview/jenis_inventory/_partial/footer.php'
        );
    }

    public function viewSubInv()
    {
        $data = [
            'judul' => 'Sub Inventory',
            'judul1' => 'Master Data',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'general_affairview/sub_inventory/v_sub_inventory.php',
            $data
        );
        $this->load->view(
            'general_affairview/sub_inventory/_partial/footer.php'
        );
    }

    public function viewStatusInv()
    {
        $data = [
            'judul' => 'Status Inventory',
            'judul1' => 'Master Data',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'general_affairview/status_inventory/v_status_inventory.php',
            $data
        );
        $this->load->view(
            'general_affairview/status_inventory/_partial/footer.php'
        );
    }

    public function viewPerusahaan()
    {
        $data = [
            'judul' => 'Perusahaan',
            'judul1' => 'Master Data',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'general_affairview/perusahaan/v_perusahaan.php',
            $data
        );
        $this->load->view('general_affairview/perusahaan/_partial/footer.php');
    }
    public function viewRakbin()
    {
        $data = [
            'judul' => 'Rakbin',
            'judul1' => 'Master Data',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'general_affairview/rakbin/v_rakbin.php',
            $data
        );
        $this->load->view('general_affairview/rakbin/_partial/footer.php');
        $this->load->view('general_affairview/rakbin/_partial/footer2.php');
    }
    public function  ViewRakbinBaru()
    {
        $data = [
            'judul' => 'Rakbin',
            'judul1' => 'Master Data',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view(
            'general_affairview/rakbin/v_input_rakbin.php',
            $data
        );
        $this->load->view('general_affairview/rakbin/_partial/footer.php');
        $this->load->view('general_affairview/rakbin/_partial/footer2.php');
    }

    public function viewCabang()
    {
        $data = [
            'judul' => 'Cabang',
            'judul1' => 'Master Data',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('general_affairview/cabang/v_cabang.php', $data);
        $this->load->view('general_affairview/cabang/_partial/footer.php');
    }

    public function viewLokasi()
    {
        $data = [
            'judul' => 'Lokasi',
            'judul1' => 'Master Data',
        ];

        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('general_affairview/lokasi/v_lokasi.php', $data);
        $this->load->view('general_affairview/lokasi/_partial/footer.php');
    }

    public function viewVendor()
    {
        $data = [
            'judul' => 'Vendor',
            'judul1' => 'Master Data',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('general_affairview/vendor/v_vendor.php', $data);
        $this->load->view('general_affairview/vendor/_partial/footer.php');
    }

    public function viewJenisAudit()
    {
        $data = [
            'judul' => 'Jenis Audit',
            'judul1' => 'Master Data',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'general_affairview/jenis_audit/v_jenis_audit.php',
            $data
        );
        $this->load->view('general_affairview/jenis_audit/_partial/footer.php');
    }

    public function viewBuatBarQRcode()
    {
        $data = [
            'judul' => 'Buat Barcode dan QR',
            'judul1' => 'Master Data',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view(
            'general_affairview/barqrcode/v_buat_barqrcode.php',
            $data
        );
        $this->load->view('general_affairview/barqrcode/_partial/footer.php');
    }

    public function gudang()
    {
        $data = [
            'judul' => 'Gudang',
            'judul1' => 'Master Data',
        ];

        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('general_affairview/gudang/v_gudang.php', $data);
        $this->load->view(
            'general_affairview/gudang/_partial/footerv_gudang.php'
        );
    }

    //----------------------------------------------------AJAX GET DATA---------------------------------------------//
    public function ajax_get_user()
    {
        $output = '';
        $no = 0;
        $base = base_url();
        $offset = 0;
        $count = $this->mmasdat->countUser();
        $config['base_url'] = base_url() . 'laporan_auditor/ajax_get_user';
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
        $listUser = $this->mmasdat->getUser($start);
        if ($listUser) {
            if ($this->session->userdata('usergroup') == 'UG005') {
                foreach ($listUser as $list) {
                    $start++;
                    if ($list['status'] == 'Aktif') {
                        $hapus = '';
                    } else {
                        $hapus =
                            "<a href='" .
                            $base .
                            'master_data/delete_user/' .
                            $list['nik'] .
                            "' class='text-danger' onclick=\"return confirm('Konfirmasi menghapus data " .
                            $list['nik'] .
                            "');\"><i class='fa fa-trash'></i></a>";
                    }
                    $output .=
                        "
                            <tr>
                                <td class='text-center'>" .
                        $start .
                        "</td>
                                <td class='text-center' >
                                <a href='" .
                        $base .
                        'master_data/edit_user?id=' .
                        $list['nik'] .
                        '&&usergroup=' .
                        $list['id_usergroup'] .
                        '&&perusahaan=' .
                        $list['id_perusahaan'] .
                        '&&lokasi=' .
                        $list['id_lokasi'] .
                        '&&cabang=' .
                        $list['id_cabang'] .
                        "' class='text-warning'><i class='fa fa-pencil'></i></a>
                                " .
                        $hapus .
                        "
                                </td>
                                <td >" .
                        $list['nik'] .
                        "</td>
                                <td >" .
                        $list['username'] .
                        "</td>
                                <td >" .
                        $list['nama'] .
                        "</td>
                                <td >" .
                        $list['nama_perusahaan'] .
                        "</td>
                                <td >" .
                        $list['nama_cabang'] .
                        "</td>
                                <td >" .
                        $list['nama_gudang'] .
                        "</td>
                                <td >" .
                        $list['user_group'] .
                        "</td>
                                <td class='text-center'>" .
                        $list['status'] .
                        "</td>
                            </tr>
                        ";
                }
            } else {
                foreach ($listUser as $list) {
                    $start++;
                    if ($list['id_usergroup'] != 'UG005') {
                        if ($list['status'] == 'Aktif') {
                            $hapus = '';
                        } else {
                            $hapus =
                                "<a href='" .
                                $base .
                                'master_data/delete_user/' .
                                $list['nik'] .
                                "' class='text-danger' onclick=\"return confirm('Konfirmasi menghapus data " .
                                $list['nik'] .
                                "');\"><i class='fa fa-trash'></i></a>";
                        }
                        $output .=
                            "
                                <tr>
                                    <td class='text-center'>" .
                            $start .
                            "</td>
                                    <td class='text-center' >
                                    <a href='" .
                            $base .
                            'master_data/edit_user?id=' .
                            $list['nik'] .
                            '&&usergroup=' .
                            $list['id_usergroup'] .
                            '&&perusahaan=' .
                            $list['id_perusahaan'] .
                            '&&lokasi=' .
                            $list['id_lokasi'] .
                            '&&cabang=' .
                            $list['id_cabang'] .
                            "' class='text-warning'><i class='fa fa-pencil'></i></a>
                                    " .
                            $hapus .
                            "
                                    </td>
                                    <td >" .
                            $list['nik'] .
                            "</td>
                                    <td >" .
                            $list['username'] .
                            "</td>
                                    <td >" .
                            $list['nama'] .
                            "</td>
                                    <td >" .
                            $list['nama_perusahaan'] .
                            "</td>
                                    <td >" .
                            $list['nama_cabang'] .
                            "</td>
                                    <td >" .
                            $list['nama_gudang'] .
                            "</td>
                                    <td >" .
                            $list['user_group'] .
                            "</td>
                                    <td class='text-center'>" .
                            $list['status'] .
                            "</td>
                                </tr>
                            ";
                    } else {
                        $start--;
                    }
                }
            }
        } else {
            $output .= '
            <tr >
            <td colspan="10" class="text-center">data not found</td>
            </tr>
            ';
        }
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];

        echo json_encode($data, true);
    }

    public function ajax_get_usergroup()
    {
        $output = '';
        $base = base_url();
        $no = 0;
        // data['kodeunik'] = $this->musergroup->kode();
        $count = $this->mmasdat->buatkodeusergroup();
        $config['base_url'] = base_url() . 'laporan_auditor/ajax_get_usergroup';
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
        $listUserGroup = $this->mmasdat->getUserGroup($start);
        // var_dump($listUserGroup);die;

        foreach ($listUserGroup as $list) {
            $no++;
            $output .=
                '
                <tr> 
                    <td class="text-center">' .
                $no .
                '</td>
                    <td class="text-center">
                    <a onclick="edit(id=\'' .
                $list['id_usergroup'] .
                '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
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
                    <td class="">' .
                $list['id_usergroup'] .
                '</td>
                    <td class="">' .
                $list['user_group'] .
                '</td>
                </tr>
                
                ';
        }
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }

    public function ajax_get_jenis_inv()
    {
        $output = '';
        $base = base_url();
        $no = 0;
        // data['kodeunik'] = $this->musergroup->kode();
        $count = $this->mmasdat->buatkodejenisinv();
        $config['base_url'] = base_url() . 'laporan_auditor/ajax_get_jenis_inv';
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
        $listJenisInv = $this->mmasdat->getJenisInv($start);
        if ($listJenisInv) {
            foreach ($listJenisInv as $list) {
                $no++;
                $output .=
                    '
                <tr> 
                    <td class="text-center">' .
                    $no .
                    '</td>
                    <td class="text-center">
                    <a onclick="edit(id=\'' .
                    $list['idjenis_inventory'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                    <a href="' .
                    $base .
                    'master_data/delete_jenisinv/' .
                    $list['idjenis_inventory'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi menghapus data ' .
                    $list['idjenis_inventory'] .
                    ' - ' .
                    $list['jenis_inventory'] .
                    ' ? ");\'><i class="fa fa-trash"></i></a>
                    </td>
                    <td >' .
                    $list['idjenis_inventory'] .
                    '</td>
                    <td >' .
                    $list['jenis_inventory'] .
                    '</td>
                </tr>
                
                ';
            }
        } else {
            $output .= '
                <tr>
                <td class="text-center" colspan="4"> data not found </td>
                </tr>
            ';
        }
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }
    public function ajax_get_jenis_inv2($id = null)
    {
        $output = '';
        $no = 0;
        $listtypeinv = $this->mmasdat->getJenisInv();
        foreach ($listtypeinv as $list) {
            $no++;
            if ($list['idjenis_inventory'] == $id) {
                $output .=
                    '
                    <option value="' .
                    $list['idjenis_inventory'] .
                    '" selected>' .
                    $list['idjenis_inventory'] .
                    ' - ' .
                    $list['jenis_inventory'] .
                    '</option>
                ';
            } else {
                $output .=
                    '
                    <option value="' .
                    $list['idjenis_inventory'] .
                    '">' .
                    $list['idjenis_inventory'] .
                    ' - ' .
                    $list['jenis_inventory'] .
                    '</option>
                ';
            }
        }
        echo '<option value="">--- Pilih jenis Inventory ---</option>';
        echo $output;
    }
    public function ajax_get_jenis_inv3()
    {
        $output = '';
        $no = 0;
        $listtypeinv = $this->mmasdat->getJenisInv();
        foreach ($listtypeinv as $list) {
            $no++;
            $output .=
                '
                    <option value="' .
                $list['idjenis_inventory'] .
                '">' .
                $list['idjenis_inventory'] .
                ' - ' .
                $list['jenis_inventory'] .
                '</option>
                ';
        }
        echo '<option value="">--- Pilih jenis Inventory ---</option>';
        echo $output;
    }

    public function ajax_get_sub_inv()
    {
        $output = '';
        $base = base_url();
        $no = 0;
        // data['kodeunik'] = $this->musergroup->kode();
        $count = $this->mmasdat->buatkodesubinventory();
        $config['base_url'] = base_url() . 'master_data/ajax_get_status_inv';
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
        $listSubInventory = $this->mmasdat->getSubInv($start);
        if ($listSubInventory) {
            foreach ($listSubInventory as $list) {
                $start++;
                $output .=
                    '
                <tr> 
                    <td class="text-center">' .
                    $start .
                    '</td>
                    <td class="text-center">
                    <a onclick="edit(id=\'' .
                    $list['idsub_inventory'] .
                    '\',jenis=\'' .
                    $list['idjenis_inventory'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                    <a href="' .
                    $base .
                    'master_data/delete_subinv/' .
                    $list['idsub_inventory'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi menghapus data ' .
                    $list['idsub_inventory'] .
                    ' - ' .
                    $list['sub_inventory'] .
                    ' ? ");\'><i class="fa fa-trash"></i></a>
                    </td>
                    <td>' .
                    $list['idsub_inventory'] .
                    '</td>
                    <td>' .
                    $list['sub_inventory'] .
                    '</td>
                    <td>' .
                    $list['idjenis_inventory'] .
                    ' - ' .
                    $list['jenis_inventory'] .
                    '</td>
                </tr>
                
                ';
            }
        } else {
            $output .= '
            <tr>
            <td colspan="5" class="text-center">data not found</td>
            </tr>
            ';
        }
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }

    public function ajax_get_status_inv()
    {
        $output = '';
        $base = base_url();
        $no = 0;
        // data['kodeunik'] = $this->musergroup->kode();

        $listStatusInventory = $this->mmasdat->getStatusInv();

        if ($listStatusInventory != null) {
            foreach ($listStatusInventory as $list) {
                $no++;
                $output .=
                    '
                    <tr> 
                        <td class="text-center">' .
                    $no .
                    '</td>
                        <td class="text-center">
                        <a onclick="edit(id=\'' .
                    $list['idstatus_inventory'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                        <a href="' .
                    $base .
                    'master_data/delete_statusinv/' .
                    $list['idstatus_inventory'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi menghapus data ' .
                    $list['idstatus_inventory'] .
                    ' - ' .
                    $list['status_inventory'] .
                    ' ? ");\'><i class="fa fa-trash"></i></a>
                        </td>
                        <td>' .
                    $list['idstatus_inventory'] .
                    '</td>
                        <td>' .
                    $list['status_inventory'] .
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

        echo json_encode($output, true);
    }

    public function ajax_get_perusahaan()
    {
        $output = '';
        $base = base_url();
        $no = 0;
        // data['kodeunik'] = $this->musergroup->kode();
        $count = $this->mmasdat->perusahaancount();
        $config['base_url'] =
            base_url() . 'laporan_auditor/ajax_get_perusahaan';
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
        $listPerusahaan = $this->mmasdat->getPerusahaan($start);
        if ($listPerusahaan) {
            foreach ($listPerusahaan as $list) {
                $no++;
                $output .=
                    '
                <tr> 
                    <td class="text-center">' .
                    $no .
                    '</td>
                    <td class="text-center">
                    <a onclick="edit(id=\'' .
                    $list['id_perusahaan'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                    <a href="' .
                    $base .
                    'master_data/delete_perusahaan/' .
                    $list['id_perusahaan'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi menghapus data ' .
                    $list['id_perusahaan'] .
                    ' - ' .
                    $list['nama_perusahaan'] .
                    ' ? ");\'><i class="fa fa-trash"></i></a>
                    </td>
                    <td class="text-center">' .
                    $list['id_perusahaan'] .
                    '</td>
                    <td class="text-center">' .
                    $list['nama_perusahaan'] .
                    '</td>
                </tr>
                
                ';
            }
        } else {
            $output .= '
            <tr>
            <td colspan="4" class="text-center"> data not found</td>
            </tr>
            ';
        }
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }

    public function ajax_get_rakbinSima()
    {
        $output = '';
        $base = base_url();
        $no = 0;
        // data['kodeunik'] = $this->musergroup->kode();
        $count = $this->mmasdat->rakbincount();
        $config['base_url'] =
            base_url() . 'laporan_auditor/ajax_get_rakbinSima';
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
        $listRakbin = $this->mmasdat->getRakbin($start);
        if ($listRakbin) {
            foreach ($listRakbin as $list) {
                $no++;
                $output .=
                    '
                <tr> 
                   <td class="text-center">' .
                    $no .
                    '</td>
                    <td class="text-center">
                    <a onclick="edit(id=\'' .
                    $list['id_cabang'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                    <a href="' .
                    $base .
                    'master_data/delete_rakbin/' .
                    $list['id_lokasi'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi menghapus data ' .
                    $list['kd_lokasi_rak_baru'] .
                    ' - ' .
                    $list['kd_lokasi_rak_baru'] .
                    ' ? ");\'><i class="fa fa-trash"></i></a>
                   
                    <td class="text-center">' .
                    $list['id_lokasi'] .
                    '</td>
                    <td class="text-center">' .
                    $list['id_cabang'] .
                    '</td>
                    <td class="text-center">' .
                    $list['kd_lokasi_rak_baru'] .
                    '</td>
                    </tr>
                
                ';
            }
        } else {
            $output .= '
            <tr>
            <td colspan="4" class="text-center"> data not found</td>
            </tr>
            ';
        }
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }




    public function ajax_get_cabang()
    {
        $output = '';
        $base = base_url();
        $no = 0;
        // data['kodeunik'] = $this->musergroup->kode();
        $count = $this->mmasdat->buatkodecabang();
        $config['base_url'] = base_url() . 'laporan_auditor/ajax_get_cabang';
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
        $listCabang = $this->mmasdat->getCabang($start);
        if ($listCabang) {
            foreach ($listCabang as $list) {
                $start++;
                $output .=
                    '
                <tr> 
                    <td class="text-center">' .
                    $start .
                    '</td>
                    <td class="text-center">
                    <a onclick="edit(id=\'' .
                    $list['id_cabang'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                    <a href="' .
                    $base .
                    'master_data/delete_cabang/' .
                    $list['id_cabang'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi menghapus data ' .
                    $list['id_cabang'] .
                    ' - ' .
                    $list['nama_cabang'] .
                    ' ? ");\'><i class="fa fa-trash"></i></a>
                    </td>
                    <td>' .
                    $list['id_cabang'] .
                    '</td>
                    <td>' .
                    $list['nama_cabang'] .
                    '</td>
                </tr>
                
                ';
            }
        } else {
            $output .= '
            <tr>
            <td colspan="4" class="text-center> data not found </td>
            </tr>
            ';
        }
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }

    public function ajax_get_lokasi()
    {
        $output = '';
        $base = base_url();
        $no = 0;
        $config['base_url'] = base_url() . 'master_data/ajax_get_lokasi';
        $config['total_rows'] = $this->mmasdat->countlokasi();
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = true;
        $config['num_links'] = 3;

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
        $page = $this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        $start = ($page - 1) * $config['per_page'];
        $listLokasi = $this->mmasdat->getLokasi($start);
        foreach ($listLokasi as $list) {
            $start++;
            $output .=
                '
            <tr> 
                <td class="text-center">' .
                $start .
                '</td>
                <td class="text-center">
                <a onclick="edit(id=\'' .
                $list['id_lokasi'] .
                '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                <a href="' .
                $base .
                'master_data/delete_lokasi/' .
                $list['id_lokasi'] .
                '" class="text-danger" onclick=\'return confirm("Konfirmasi menghapus data ' .
                $list['id_lokasi'] .
                ' - ' .
                $list['nama_lokasi'] .
                ' ? ");\'><i class="fa fa-trash"></i></a>
                </td>
                <td>' .
                $list['id_cabang'] .
                '</td>
                <td>' .
                $list['id_lokasi'] .
                '</td>
                <td>' .
                $list['nama_lokasi'] .
                '</td>
            </tr>
            
            ';
        }
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }

    public function ajax_get_gudang()
    {
        $output = '';
        $base = base_url();
        $no = 0;
        $config['base_url'] = base_url() . 'master_data/ajax_get_gudang';
        $config['total_rows'] = $this->mmasdat->countgudang();
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = true;
        $config['num_links'] = 3;

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
        $page = $this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        $start = ($page - 1) * $config['per_page'];
        $listLokasi = $this->mmasdat->getGudang($start);
        foreach ($listLokasi as $list) {
            $start++;
            $output .=
                '
            <tr> 
                <td class="text-center">' .
                $start .
                '</td>
                <td class="text-center">
                <a onclick="edit(id=\'' .
                $list['kd_gudang'] .
                '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                <a href="' .
                $base .
                'master_data/delete_gudang/' .
                $list['kd_gudang'] .
                '" class="text-danger" onclick=\'return confirm("Konfirmasi menghapus data ' .
                $list['kd_gudang'] .
                ' - ' .
                $list['nama_gudang'] .
                ' ? ");\'><i class="fa fa-trash"></i></a>
                </td>
                <td>' .
                $list['kd_gudang'] .
                '</td>
                <td>' .
                $list['nama_gudang'] .
                '</td>
                <td>' .
                $list['jenis_gudang'] .
                '</td>
                <td>' .
                $list['alamat'] .
                '</td>
            </tr>
            
            ';
        }
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }

    public function ajax_get_vendor()
    {
        $output = '';
        $base = base_url();
        $no = 0;
        $config['base_url'] = base_url() . 'master_data/ajax_get_vendor';
        $config['total_rows'] = $this->mmasdat->buatkodevendor();
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = true;
        $config['num_links'] = 3;

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
        $page = $this->uri->segment(3);
        if ($page == null) {
            $page = 1;
        }
        $start = ($page - 1) * $config['per_page'];
        // data['kodeunik'] = $this->musergroup->kode();
        $listVendor = $this->mmasdat->getVendor($start);
        if ($listVendor != null) {
            foreach ($listVendor as $list) {
                $start++;
                $output .=
                    '
                <tr> 
                    <td class="text-center">' .
                    $start .
                    '</td>
                    <td class="text-center">
                    <a onclick="edit(id=\'' .
                    $list['id_vendor'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                    <a href="' .
                    $base .
                    'master_data/delete_vendor/' .
                    $list['id_vendor'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi menghapus data ' .
                    $list['id_vendor'] .
                    ' - ' .
                    $list['nama_vendor'] .
                    ' ? ");\'><i class="fa fa-trash"></i></a>
                    </td>
                    <td >' .
                    $list['id_vendor'] .
                    '</td>
                    <td >' .
                    $list['nama_vendor'] .
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
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }

    public function ajax_get_jenis_audit()
    {
        $output = '';
        $base = base_url();
        $no = 0;
        // data['kodeunik'] = $this->musergroup->kode();
        $listJenisAudit = $this->mmasdat->getJenisAudit();
        if ($listJenisAudit) {
            foreach ($listJenisAudit as $list) {
                $no++;
                $output .=
                    '
                <tr> 
                    <td>' .
                    $no .
                    '</td>
                    <td>
                    <a onclick="edit(id=\'' .
                    $list['idjenis_audit'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                    <a href="' .
                    $base .
                    'master_data/delete_jenisaudit/' .
                    $list['idjenis_audit'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi menghapus data ' .
                    $list['idjenis_audit'] .
                    ' - ' .
                    $list['jenis_audit'] .
                    ' ? ");\'><i class="fa fa-trash"></i></a>
                    </td>
                    <td >' .
                    $list['idjenis_audit'] .
                    '</td>
                    <td >' .
                    $list['jenis_audit'] .
                    '</td>
                </tr>
                
                ';
            }
        } else {
            $output .= '
            <tr>
            <td colspan="8">data not found</td>
            </tr>
            ';
        }
        echo json_encode($output, true);
    }

    //-------------------------------------------------------INPUT---------------------------------------------------//
    public function input_user()
    {
        $data = ['judul' => 'User', 'judul1' => 'Master Data'];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php', $data);
        $this->load->view('general_affairview/user/v_input_user.php', $data);
        $this->load->view('general_affairview/user/_partial/footer.php');
    }

    public function input_usergroup()
    {
        $data = [
            'code' => $this->mmasdat->buatkodeusergroup(),
        ];
        $this->load->view('general_affairview/user_group/v_inputUG.php', $data);
        $this->load->view('general_affairview/user_group/_partial/footer2.php');
    }

    public function input_jenisinv()
    {
        $this->load->view(
            'general_affairview/jenis_inventory/v_input_jenisinv.php'
        );
        $this->load->view(
            'general_affairview/jenis_inventory/_partial/footer2.php'
        );
    }

    public function input_subinv()
    {
        $data = [
            'code' => $this->mmasdat->buatkodesubinventory(),
        ];
        $this->load->view(
            'general_affairview/sub_inventory/v_input_subinv.php',
            $data
        );
        $this->load->view(
            'general_affairview/sub_inventory/_partial/footer2.php'
        );
    }

    public function input_statusinv()
    {
        $data = [
            'code' => $this->mmasdat->buatkodestatusinventory(),
        ];
        $this->load->view(
            'general_affairview/status_inventory/v_input_statusinv.php',
            $data
        );
        $this->load->view(
            'general_affairview/status_inventory/_partial/footer2.php'
        );
    }

    public function input_perusahaan()
    {
        $this->load->view(
            'general_affairview/perusahaan/v_input_perusahaan.php'
        );
        $this->load->view('general_affairview/perusahaan/_partial/footer2.php');
    }
    public function input_rakbin()
    {
        $this->load->view(
            'general_affairview/rakbin/v_input_rakbin.php'
        );
        $this->load->view('general_affairview/rakbin/_partial/footer2.php');
    }

    public function input_cabang()
    {
        $this->load->view('general_affairview/cabang/v_input_cabang.php');
        $this->load->view('general_affairview/cabang/_partial/footer2.php');
    }

    public function input_lokasi()
    {
        $this->load->view('general_affairview/lokasi/v_input_lokasi.php');
        $this->load->view('general_affairview/lokasi/_partial/footer2.php');
    }

    public function input_gudang()
    {
        $this->load->view('general_affairview/gudang/v_input_gudang.php');
        $this->load->view(
            'general_affairview/gudang/_partial/footerinput_gudang.php'
        );
    }

    public function input_vendor()
    {
        $data = [
            'code' => $this->mmasdat->buatkodevendor(),
        ];
        $this->load->view(
            'general_affairview/vendor/v_input_vendor.php',
            $data
        );
        $this->load->view('general_affairview/vendor/_partial/footer2.php');
    }

    public function input_jenisaudit()
    {
        $data = [
            'code' => $this->mmasdat->buatkodejenisaudit(),
        ];
        $this->load->view(
            'general_affairview/jenis_audit/v_input_jenisaudit.php',
            $data
        );
        $this->load->view(
            'general_affairview/jenis_audit/_partial/footer2.php'
        );
    }

    //------------------------------------------------EDIT--------------------------------------------------------//
    public function edit_user()
    {
        $id = $this->input->get('id');
        $cabang = $this->input->get('cabang');
        $lokasi = $this->input->get('lokasi');
        $perusahaan = $this->input->get('perusahaan');
        $usergroup = $this->input->get('usergroup');

        $data = [
            'judul' => 'User',
            'judul1' => 'Master Data',
            'user' => $this->mmasdat->getUserById($id),
            'cabang' => $cabang,
            'lokasi' => $lokasi,
            'perusahaan' => $perusahaan,
            'usergroup' => $usergroup,
        ];

        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php', $data);
        $this->load->view('general_affairview/user/v_edit_user.php', $data);
        $this->load->view('general_affairview/user/_partial/footer2.php');
    }
    public function edit_rakbin()
    {
        $id = $this->input->get('id');
         // var_dump($id);die;

        $data = [
            'edit' => $this->mmasdat->getRakbinById($id),
        ];

        // $this->load->view('_partial/header.php', $data);
        // $this->load->view('_partial/sidebar.php', $data);
        $this->load->view('general_affairview/rakbin/v_edit_rakbin.php', $data);
        $this->load->view('general_affairview/rakbin/_partial/footer2.php');
    }

    public function edit_usergroup()
    {
        $id = $this->input->get('id');
        // var_dump($id);die;
        $data = [
            'edit' => $this->mmasdat->getUsergroupById($id),
        ];
        // var_dump($data);die;
        $this->load->view('general_affairview/user_group/v_editUG.php', $data);
        $this->load->view('general_affairview/user_group/_partial/footer2.php');
    }

    public function edit_jenisinv()
    {
        $id = $this->input->post('id');
        // var_dump($this->input->post());die;
        $data = [
            'edit' => $this->mmasdat->getJenisInvById($id),
        ];

        $this->load->view(
            'general_affairview/jenis_inventory/v_edit_jenisinv.php',
            $data
        );
        $this->load->view(
            'general_affairview/jenis_inventory/_partial/footer2.php'
        );
    }

    public function edit_subinv()
    {
        $id = $this->input->post('id');
        $jenis = $this->input->post('jenis');
        $data = [
            'edit' => $this->mmasdat->getSubInvById($id),
            'id' => $jenis,
        ];

        $this->load->view(
            'general_affairview/sub_inventory/v_edit_subinv.php',
            $data
        );
        $this->load->view(
            'general_affairview/sub_inventory/_partial/footer3.php'
        );
    }

    public function edit_statusinv()
    {
        $id = $this->input->post('id');
        // var_dump($id);die;
        $data = [
            'edit' => $this->mmasdat->getStatusInvById($id),
        ];

        $this->load->view(
            'general_affairview/status_inventory/v_edit_statusinv.php',
            $data
        );
        $this->load->view(
            'general_affairview/status_inventory/_partial/footer2.php'
        );
    }

    public function edit_perusahaan()
    {
        $id = $this->input->post('id');
        // var_dump($id);die;
        $data = [
            'edit' => $this->mmasdat->getPerusahaanById($id),
        ];

        $this->load->view(
            'general_affairview/perusahaan/v_edit_perusahaan.php',
            $data
        );
        $this->load->view('general_affairview/perusahaan/_partial/footer2.php');
    }

    public function edit_cabang()
    {
        $id = $this->input->post('id');
        // var_dump($id);die;
        $data = [
            'edit' => $this->mmasdat->getCabangById($id),
        ];

        $this->load->view('general_affairview/cabang/v_edit_cabang.php', $data);
        $this->load->view('general_affairview/cabang/_partial/footer2.php');
    }

    public function edit_lokasi()
    {
        $id = $this->input->post('id');
        // var_dump($id);die;
        $data = [
            'edit' => $this->mmasdat->getLokasiById($id),
        ];

        $this->load->view('general_affairview/lokasi/v_edit_lokasi.php', $data);
        $this->load->view('general_affairview/lokasi/_partial/footer2.php');
    }

    public function edit_gudang()
    {
        $id = $this->input->post('id');
        // var_dump($id);die;
        $data = [
            'edit' => $this->mmasdat->getGudangById($id),
        ];

        $this->load->view('general_affairview/gudang/v_edit_gudang.php', $data);
        $this->load->view(
            'general_affairview/gudang/_partial/footerinput_gudang.php'
        );
    }

    public function edit_vendor()
    {
        $id = $this->input->get('id');
        // var_dump($id);die;
        $data = [
            'edit' => $this->mmasdat->getVendorById($id),
        ];

        $this->load->view('general_affairview/vendor/v_edit_vendor.php', $data);
        $this->load->view('general_affairview/vendor/_partial/footer2.php');
    }

    public function edit_jenisaudit()
    {
        $id = $this->input->post('id');
        // var_dump($id);die;
        $data = [
            'edit' => $this->mmasdat->getJenisAuditById($id),
        ];
        // var_dump($data);die;

        $this->load->view(
            'general_affairview/jenis_audit/v_edit_jenis_audit.php',
            $data
        );
        $this->load->view(
            'general_affairview/jenis_audit/_partial/footer2.php'
        );
    }
    //---------------------------------------------------POST------------------------------------------------------//
    public function post_user()
    {
        $data = [
            'nik' => html_escape($this->input->post('nik', true)),
            'username' => html_escape($this->input->post('username')),
            'nama' => html_escape($this->input->post('nama')),
            'password' => html_escape($this->input->post('password')),
            'id_perusahaan' => html_escape($this->input->post('id_perusahaan')),
            'id_cabang' => html_escape($this->input->post('id_cabang')),
            'id_lokasi' => html_escape($this->input->post('id_lokasi')),
            'id_usergroup' => $this->input->post('id_usergroup'),
            'user' => $this->session->userdata('username'),
        ];
        $id = $data['nik'];

        $cek = $this->mmasdat->getUserById($id);
        if ($cek) {
            $this->session->set_flashdata('warning', 'sudah ada');

            redirect('master_data/input_user');
        } else {
            $exec = $this->mmasdat->addUser($data);
            if ($exec) {
                $this->session->set_flashdata(
                    'berhasil',
                    'berhasil ditambahkan'
                );
                redirect('master_data/input_user');
            } else {
                $this->session->set_flashdata('gagal', 'gagal ditambahkan');
                redirect('master_data/input_user');
            }
        }
    }

    public function post_usergroup()
    {
        $data = [
            'id_usergroup' => $this->input->post('id_usergroup', true, 'UTF-8'),
            'user_group' => html_escape(
                $this->input->post('user_group', true, 'UTF-8')
            ),
            'user' => html_escape($this->session->userdata('username')),
        ];

        $id = $data['id_usergroup'];

        $cek = $this->mmasdat->getUserGroupById($id);
        // var_dump($cek);die;
        if ($cek) {
            $this->session->set_flashdata('warning', 'Data sudah ada');

            redirect('master_data/user_group');
        } else {
            $exec = $this->mmasdat->addUserGroup($data);
            if ($exec) {
                $this->session->set_flashdata(
                    'berhasil',
                    'Data Berhasil Ditambahkan'
                );
                redirect('master_data/user_group');
            } else {
                $this->session->set_flashdata('gagal', 'gagal ditambahkan');
                redirect('user_group/user_group');
            }
        }
    }

    public function post_jenis_inv()
    {
        $data = [
            'idjenis_inventory' => $this->input->post(
                'idjenis_inventory',
                true
            ),
            'jenis_inventory' => $this->input->post('jenis_inventory', true),
            'user' => $this->session->userdata('username'),
        ];

        $id = $this->input->post('idjenis_inventory', true);

        $jenisinv = $this->mmasdat->getJenisInvById($id);
        if ($jenisinv) {
            $this->session->set_flashdata('warning', 'sudah ada');

            redirect('master_data/jenis_inventory', 'refresh');
        } else {
            if ($result = $this->mmasdat->addJenisInv($data)) {
                $this->session->set_flashdata('berhasil', 'berhasil ditambah');

                redirect('master_data/jenis_inventory', 'refresh');
            } else {
                $this->session->set_flashdata('gagal', 'gagal ditambah');

                redirect('master_data/jenis_inventory', 'refresh');
            }
        }
    }

    public function post_sub_inv()
    {
        $data = [
            'idjenis_inventory' => $this->input->post('jenis_inv', true),
            'idsub_inventory' => $this->input->post('idsub_inventory', true),
            'sub_inventory' => $this->input->post('sub_inventory', true),
            'user' => $this->session->userdata('username'),
        ];

        $id = $this->input->post('idsub_inventory', true);

        $subinv = $this->mmasdat->getSubInvById($id);
        if ($subinv) {
            $this->session->set_flashdata('warning', 'sudah ada');
            redirect('master_data/sub_inventory', 'refresh');
        } else {
            if ($result = $this->mmasdat->addSubInv($data)) {
                $this->session->set_flashdata('berhasil', 'berhasil ditambah');

                redirect('master_data/sub_inventory', 'refresh');
            } else {
                $this->session->set_flashdata('gagal', 'gagal ditambah');

                redirect('master_data/sub_inventory', 'refresh');
            }
        }
    }

    public function post_status_inv()
    {
        $data = [
            'idstatus_inventory' => $this->input->post(
                'idstatus_inventory',
                true
            ),
            'status_inventory' => $this->input->post('status_inventory', true),
            'user' => $this->session->userdata('username'),
        ];

        $id = $this->input->post('idstatus_inventory', true);

        $statusinv = $this->mmasdat->getStatusInvById($id);
        // var_dump($id);die;
        if ($statusinv) {
            $this->session->set_flashdata('warning', 'sudah ada');

            redirect('master_data/status_inventory', 'refresh');
        } else {
            if ($result = $this->mmasdat->addStatusInv($data)) {
                $this->session->set_flashdata('berhasil', 'berhasil ditambah');

                redirect('master_data/status_inventory', 'refresh');
            } else {
                $this->session->set_flashdata('gagal', 'gagal ditambah');

                redirect('master_data/status_inventory', 'refresh');
            }
        }
    }

    public function post_perusahaan()
    {
        $data = [
            'id_perusahaan' => $this->input->post('id_perusahaan', true),
            'nama_perusahaan' => $this->input->post('nama_perusahaan', true),
            'user' => $this->session->userdata('username'),
        ];

        $id = $this->input->post('id_perusahaan', true);

        $perusahaan = $this->mmasdat->getPerusahaanById($id);
        if ($perusahaan) {
            $this->session->set_flashdata('warning', 'sudah ada');

            redirect('master_data/perusahaan', 'refresh');
        } else {
            if ($result = $this->mmasdat->addPerusahaan($data)) {
                $this->session->set_flashdata('berhasil', 'berhasil ditambah');

                redirect('master_data/perusahaan', 'refresh');
            } else {
                $this->session->set_flashdata('gagal', 'gagal ditambah');

                redirect('master_data/perusahaan', 'refresh');
            }
        }
    }

    public function post_rakbin()
    {
        $data = [
            'id_cabang' => $this->input->post('id_cabang', true),
            'id_lokasi' => $this->input->post('id_lokasi', true),
            'kd_lokasi_rak_baru' => $this->input->post('kd_lokasi_rak', true),
            'kd_rak' => $this->input->post('kd_rak', true),
            'kd_binbox' => $this->input->post('kd_binbox', true),
            'user' => $this->session->userdata('username'),
        ];

        $id = $data['kd_lokasi_rak_baru'];

        // var_dump($data);exit;
        // $result = $this->mmasdat->addRakbin($data);
        // var_dump($result);exit;
        

        $rakbin = $this->mmasdat->getRakbinById($id);
        if ($rakbin) {
            $this->session->set_flashdata('warning', 'sudah ada');

            redirect('master_data/rakbin', 'refresh');
        } else {
            if ($result = $this->mmasdat->addRakbin($data)) {
                $this->session->set_flashdata('berhasil', 'berhasil ditambah');

              

                redirect('master_data/rakbin', 'refresh');
            } else {
                $this->session->set_flashdata('gagal', 'gagal ditambah');

                redirect('master_data/rakbin', 'refresh');
            }
        }
    }



    public function post_cabang()
    {
        $data = [
            'id_cabang' => $this->input->post('id_cabang', true),
            'nama_cabang' => $this->input->post('nama_cabang', true),
            'user' => $this->session->userdata('username'),
        ];

        $id = $this->input->post('id_cabang', true);

        $cabang = $this->mmasdat->getCabangById($id);
        if ($cabang) {
            $this->session->set_flashdata('warning', 'sudah ada');

            redirect('master_data/cabang', 'refresh');
        } else {
            if ($result = $this->mmasdat->addCabang($data)) {
                $this->session->set_flashdata('berhasil', 'berhasil ditambah');

                redirect('master_data/cabang', 'refresh');
            } else {
                $this->session->set_flashdata('gagal', 'gagal ditambah');

                redirect('master_data/cabang', 'refresh');
            }
        }
    }

    public function post_lokasi()
    {
        $data = [
            'id_lokasi' => $this->input->post('id_lokasi', true),
            'id_cabang' => $this->input->post('id_cabang', true),
            'nama_lokasi' => $this->input->post('nama_lokasi', true),
            'user' => $this->session->userdata('username'),
        ];

        $id = $this->input->post('id_lokasi', true);

        $lokasi = $this->mmasdat->getLokasiById($id);
        if ($lokasi) {
            $this->session->set_flashdata('warning', 'sudah ada');

            redirect('master_data/lokasi', 'refresh');
        } else {
            if ($result = $this->mmasdat->addLokasi($data)) {
                $this->session->set_flashdata('berhasil', 'berhasil ditambah');

                redirect('master_data/lokasi', 'refresh');
            } else {
                $this->session->set_flashdata('gagal', 'gagal ditambah');

                redirect('master_data/lokasi', 'refresh');
            }
        }
    }

    public function post_Gudang()
    {
        $data = [
            'kd_gudang' => $this->input->post('kd_gudang', true),
            'nama_gudang' => $this->input->post('nama_gudang', true),
            'jenis_gudang' => $this->input->post('jenis_gudang', true),
            'alamat' => $this->input->post('alamat', true),
            'created_by' => $this->session->userdata('username'),
        ];

        $id = $this->input->post('kd_gudang', true);

        $lokasi = $this->mmasdat->getGudangById($id);
        if ($lokasi) {
            $this->session->set_flashdata('warning', 'sudah ada');

            redirect('master_data/gudang', 'refresh');
        } else {
            if ($result = $this->mmasdat->addGudang($data)) {
                $this->session->set_flashdata('berhasil', 'berhasil ditambah');

                redirect('master_data/gudang', 'refresh');
            } else {
                $this->session->set_flashdata('gagal', 'gagal ditambah');

                redirect('master_data/gudang', 'refresh');
            }
        }
    }

    public function post_vendor()
    {
        $data = [
            'id_vendor' => $this->input->post('id_vendor', true),
            'nama_vendor' => $this->input->post('nama_vendor', true),
            'user' => $this->session->userdata('username'),
        ];

        $id = $this->input->post('id_vendor', true);

        $vendor = $this->mmasdat->getVendorById($id);
        if ($vendor) {
            $this->session->set_flashdata('warning', 'sudah ada');

            redirect('master_data/vendor', 'refresh');
        } else {
            if ($result = $this->mmasdat->addVendor($data)) {
                $this->session->set_flashdata('berhasil', 'berhasil ditambah');

                redirect('master_data/vendor', 'refresh');
            } else {
                $this->session->set_flashdata('gagal', 'gagal ditambah');

                redirect('master_data/vendor', 'refresh');
            }
        }
    }

    public function post_jenis_audit()
    {
        $data = [
            'idjenis_audit' => $this->input->post('idjenis_audit', true),
            'jenis_audit' => $this->input->post('jenis_audit', true),
            'user' => $this->session->userdata('username'),
        ];

        $id = $this->input->post('idjenis_audit', true);

        $jenisaudit = $this->mmasdat->getJenisAuditById($id);
        if ($jenisaudit['status'] === true) {
            $this->session->set_flashdata('warning', 'sudah ada');
            redirect('jenis_audit/list', 'refresh');
        } else {
            if ($this->mmasdat->addJenisAudit($data)) {
                $this->session->set_flashdata('berhasil', 'berhasil ditambah');

                redirect('master_data/jenis_audit', 'refresh');
            } else {
                $this->session->set_flashdata('gagal', 'gagal ditambah');

                redirect('master_data/jenis_audit', 'refresh');
            }
        }
    }
    //----------------------------------------------------PUT------------------------------------------------------//
    public function put_user()
    {
        $data = [
            'id' => $this->input->post('nik', true),
            'username' => $this->input->post('username'),
            'nama' => $this->input->post('nama'),
            'password' => $this->input->post('password'),
            'id_perusahaan' => $this->input->post('id_perusahaan'),
            'id_cabang' => $this->input->post('id_cabang'),
            'id_lokasi' => $this->input->post('id_lokasi'),
            'id_usergroup' => $this->input->post('id_usergroup'),
            'user' => $this->session->userdata('username'),
            'status' => $this->input->post('status'),
        ];

        $exec = $this->mmasdat->editUser($data);
        if ($exec) {
            $this->session->set_flashdata('berhasil', 'berhasil diubah');
            redirect('master_data/user');
        } else {
            $this->session->set_flashdata('gagal', 'gagal diubah');
            redirect('master_data/user');
        }
    }
    public function put_usergroup()
    {
        $data = [
            'user_group' => $this->input->post('user_group', true),
            'id' => $this->input->post('id_usergroup', true),
            'user' => $this->session->userdata('username'),
        ];

        $exec = $this->mmasdat->UpdateUserGroup($data);
        if ($exec) {
            $this->session->set_flashdata('berhasil', 'berhasil diupdate');
            redirect('master_data/user_group');
        } else {
            $this->session->set_flashdata('gagal', 'gagal diupdate');
            redirect('master_data/user_group');
        }
    }

    public function put_jenisinv()
    {
        $data = [
            'jenis_inventory' => $this->input->post('jenis_inventory', true),
            'id' => $this->input->post('idjenis_inventory', true),
            'user' => $this->session->userdata('username'),
        ];
        // var_dump($data);die;

        $exec = $this->mmasdat->UpdateJenisInv($data);
        if ($exec) {
            $this->session->set_flashdata('berhasil', 'Data Berhasil Diupdate');
            redirect('master_data/jenis_inventory');
        } else {
            $this->session->set_flashdata('gagal', 'Data Gagal Diupdate');
            redirect('master_data/jenis_inventory');
        }
    }

    public function put_subinv()
    {
        $data = [
            'idjenis_inventory' => $this->input->post('jenis_inv', true),
            'sub_inventory' => $this->input->post('sub_inventory', true),
            'id' => $this->input->post('idsub_inventory', true),
            'user' => $this->session->userdata('username'),
        ];
        // var_dump($data);die;

        $exec = $this->mmasdat->UpdateSubInv($data);
        if ($exec) {
            $this->session->set_flashdata('berhasil', 'berhasil diupdate');
            redirect('master_data/sub_inventory');
        } else {
            $this->session->set_flashdata('gagal', 'gagal diupdate');
            redirect('master_data/sub_inventory');
        }
    }

    public function put_statusinv()
    {
        $data = [
            'status_inventory' => $this->input->post('status_inventory', true),
            'id' => $this->input->post('idstatus_inventory', true),
            'user' => $this->session->userdata('username'),
        ];
        //  var_dump($data);die;

        $exec = $this->mmasdat->UpdateStatusInv($data);
        if ($exec) {
            $this->session->set_flashdata('berhasil', 'berhasil diupdate');
            redirect('master_data/status_inventory');
        } else {
            $this->session->set_flashdata('gagal', 'gagal diupdate');
            redirect('master_data/status_inventory');
        }
    }

    public function put_perusahaan()
    {
        $data = [
            'nama_perusahaan' => $this->input->post('nama_perusahaan', true),
            'id' => $this->input->post('id_perusahaan', true),
            'user' => $this->session->userdata('username'),
        ];
        // var_dump($data);die;

        $exec = $this->mmasdat->UpdatePerusahaan($data);
        if ($exec) {
            $this->session->set_flashdata('berhasil', 'berhasil diupdate');
            redirect('master_data/perusahaan');
        } else {
            $this->session->set_flashdata('gagal', 'gagal diupdate');
            redirect('master_data/perusahaan');
        }
    }

    public function put_rakbin()
    {
       
        $data = [
            'id_cabang' => $this->input->post('id_cabang', true),
            'id_lokasi' => $this->input->post('id_lokasi', true),
            'kd_lokasi_rak' => $this->input->post('kd_lokasi_rak', true),
            'kd_rak' => $this->input->post('kd_rak', true),
            'kd_binbox' => $this->input->post('kd_binbox', true),
        ];
        // var_dump($data);die;

        $exec = $this->mmasdat->UpdateRakbin($data);
        if ($exec) {
            $this->session->set_flashdata('berhasil', 'berhasil diupdate');
            redirect('master_data/rakbin');
        } else {
            $this->session->set_flashdata('gagal', 'gagal diupdate');
            redirect('master_data/rakbin');
        }
    }


    public function put_cabang()
    {
        $data = [
            'nama_cabang' => $this->input->post('nama_cabang', true),
            'id' => $this->input->post('id_cabang', true),
            'user' => $this->session->userdata('username'),
        ];
        // var_dump($data);die;

        $exec = $this->mmasdat->UpdateCabang($data);
        if ($exec) {
            $this->session->set_flashdata('berhasil', 'berhasil diupdate');
            redirect('master_data/cabang');
        } else {
            $this->session->set_flashdata('gagal', 'gagal diupdate');
            redirect('master_data/cabang');
        }
    }

    public function put_lokasi()
    {
        $data = [
            'nama_lokasi' => $this->input->post('nama_lokasi', true),
            'id' => $this->input->post('id_lokasi', true),
            'user' => $this->session->userdata('username'),
        ];
        // var_dump($data);die;

        $exec = $this->mmasdat->UpdateLokasi($data);
        if ($exec) {
            $this->session->set_flashdata('berhasil', 'berhasil diupdate');
            redirect('master_data/lokasi');
        } else {
            $this->session->set_flashdata('gagal', 'gagal diupdate');
            redirect('master_data/lokasi');
        }
    }

    public function put_gudang()
    {
        $data = [
            'kd_gudang' => $this->input->post('kd_gudang', true),
            'nama_gudang' => $this->input->post('nama_gudang', true),
            'jenis_gudang' => $this->input->post('jenis_gudang', true),
            'alamat' => $this->input->post('alamat', true),
            'modified_by' => $this->session->userdata('username'),
        ];
        // var_dump($data);die;

        $exec = $this->mmasdat->UpdateGudang($data);
        if ($exec) {
            $this->session->set_flashdata('berhasil', 'berhasil diupdate');
            redirect('master_data/gudang');
        } else {
            $this->session->set_flashdata('gagal', 'gagal diupdate');
            redirect('master_data/gudang');
        }
    }

    public function put_vendor()
    {
        $data = [
            'nama_vendor' => $this->input->post('nama_vendor', true),
            'id' => $this->input->post('id_vendor', true),
            'user' => $this->session->userdata('username'),
        ];
        // var_dump($data);die;

        $exec = $this->mmasdat->UpdateVendor($data);
        if ($exec) {
            $this->session->set_flashdata('berhasil', 'berhasil diupdate');
            redirect('master_data/vendor');
        } else {
            $this->session->set_flashdata('gagal', 'gagal diupdate');
            redirect('master_data/vendor');
        }
    }

    public function put_jenisaudit()
    {
        $data = [
            'jenis_audit' => $this->input->post('jenis_audit', true),
            'id' => $this->input->post('idjenis_audit', true),
            'user' => $this->session->userdata('username'),
        ];
        // var_dump($data);die;

        $exec = $this->mmasdat->UpdateJenisAudit($data);
        if ($exec) {
            $this->session->set_flashdata('berhasil', 'berhasil diupdate');
            redirect('master_data/jenis_audit');
        } else {
            $this->session->set_flashdata('gagal', 'gagal diupdate');
            redirect('master_data/jenis_audit');
        }
    }

    //-----------------------------------------------DELETE-------------------------------------------------------//
    public function delete_user($id = null)
    {
        if ($id === null) {
            $this->session->set_flashdata('warning', 'tidak ada');

            redirect('master_data/user');
        } else {
            $result = $this->mmasdat->delUser($id);
            if ($result) {
                $this->session->set_flashdata('berhasil', 'Dihapus');

                redirect('master_data/user');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal dihapus');

                redirect('master_data/user');
            }
        }
    }

    public function delete_usergroup($id = null)
    {
        if ($id === null) {
            $this->session->set_flashdata('warning', 'tidak ada');

            redirect('master_data/user_group');
        } else {
            $result = $this->mmasdat->delUsergroup($id);
            if ($result) {
                $this->session->set_flashdata('berhasil', 'Berhasil Dihapus');

                redirect('master_data/user_group');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal dihapus');

                redirect('master_data/user_group');
            }
        }
    }

    public function delete_jenisinv($id = null)
    {
        if ($id === null) {
            $this->session->set_flashdata('warning', 'tidak ada');

            redirect('master_data/jenis_inventory');
        } else {
            $result = $this->mmasdat->delJenisInv($id);
            if ($result) {
                $this->session->set_flashdata('berhasil', 'Berhasil Dihapus');

                redirect('master_data/jenis_inventory');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal dihapus');

                redirect('master_data/jenis_inventory');
            }
        }
    }

    public function delete_subinv($id = null)
    {
        if ($id === null) {
            $this->session->set_flashdata('warning', 'tidak ada');

            redirect('master_data/sub_inventory');
        } else {
            $result = $this->mmasdat->delSubInv($id);
            if ($result) {
                $this->session->set_flashdata('berhasil', 'Berhasil Dihapus');

                redirect('master_data/sub_inventory');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal dihapus');

                redirect('master_data/sub_inventory');
            }
        }
    }

    public function delete_statusinv($id = null)
    {
        if ($id === null) {
            $this->session->set_flashdata('warning', 'tidak ada');

            redirect('master_data/status_inventory');
        } else {
            $result = $this->mmasdat->delStatusInv($id);
            if ($result) {
                $this->session->set_flashdata('berhasil', 'Berhasil Dihapus');

                redirect('master_data/status_inventory');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal dihapus');

                redirect('master_data/status_inventory');
            }
        }
    }

    public function delete_perusahaan($id = null)
    {
        if ($id === null) {
            $this->session->set_flashdata('warning', 'tidak ada');

            redirect('master_data/perusahaan');
        } else {
            $result = $this->mmasdat->delPerusahaan($id);
            if ($result) {
                $this->session->set_flashdata('berhasil', 'Berhasil Dihapus');

                redirect('master_data/perusahaan');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal dihapus');

                redirect('master_data/perusahaan');
            }
        }
    }

    public function delete_rakbin($id = null)
    {
        if ($id === null) {
            $this->session->set_flashdata('warning', 'tidak ada');

            redirect('master_data/rakbin');
        } else {
            $result = $this->mmasdat->delRakbin($id);
            if ($result) {
                $this->session->set_flashdata('berhasil', 'Berhasil Dihapus');

                redirect('master_data/rakbin');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal dihapus');

                redirect('master_data/rakbin');
            }
        }
    }

    public function delete_cabang($id = null)
    {
        if ($id === null) {
            $this->session->set_flashdata('warning', 'tidak ada');

            redirect('master_data/cabang');
        } else {
            $result = $this->mmasdat->delCabang($id);
            if ($result) {
                $this->session->set_flashdata('berhasil', 'Berhasil Dihapus');

                redirect('master_data/cabang');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal dihapus');

                redirect('master_data/cabang');
            }
        }
    }

    public function delete_lokasi($id = null)
    {
        if ($id === null) {
            $this->session->set_flashdata('warning', 'tidak ada');

            redirect('master_data/lokasi');
        } else {
            $result = $this->mmasdat->delLokasi($id);
            if ($result) {
                $this->session->set_flashdata('berhasil', 'Berhasil Dihapus');

                redirect('master_data/lokasi');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal dihapus');

                redirect('master_data/lokasi');
            }
        }
    }

    public function delete_gudang($id = null)
    {
        if ($id === null) {
            $this->session->set_flashdata('warning', 'tidak ada');

            redirect('master_data/gudang');
        } else {
            $result = $this->mmasdat->delgudang($id);
            if ($result) {
                $this->session->set_flashdata('berhasil', 'Berhasil Dihapus');

                redirect('master_data/gudang');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal dihapus');

                redirect('master_data/gudang');
            }
        }
    }

    public function delete_vendor($id = null)
    {
        if ($id === null) {
            $this->session->set_flashdata('warning', 'tidak ada');

            redirect('master_data/vendor');
        } else {
            $result = $this->mmasdat->delVendor($id);
            if ($result) {
                $this->session->set_flashdata('berhasil', 'Berhasil Dihapus');

                redirect('master_data/vendor');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal dihapus');

                redirect('master_data/vendor');
            }
        }
    }

    public function delete_jenisaudit($id = null)
    {
        if ($id === null) {
            $this->session->set_flashdata('warning', 'tidak ada');

            redirect('master_data/jenis_audit');
        } else {
            $result = $this->mmasdat->delJenisAudit($id);
            if ($result) {
                $this->session->set_flashdata('berhasil', 'Berhasil Dihapus');

                redirect('master_data/jenis_audit');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal dihapus');

                redirect('master_data/jenis_audit');
            }
        }
    }

    //----------------------------SEARCH DATA--------------------------------//
    public function search_data_user()
    {
        $id = $this->input->post('id');
        $output = '';
        $no = 0;
        $count = $this->mmasdat->countUser($id);
        $config['base_url'] = base_url() . 'laporan_auditor/search_data_user';
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
        $base = base_url();
        if ($id === null) {
            $listUser = null;
        } else {
            $listUser = $this->mmasdat->cariuser($id, $start);
        }

        if ($listUser) {
            foreach ($listUser as $list) {
                if ($list['status'] == 'Aktif') {
                    $hapus = '';
                } else {
                    $hapus =
                        "<a href='" .
                        $base .
                        'master_data/delete_user/' .
                        $list['nik'] .
                        "' class='text-danger' onclick=\"return confirm('Konfirmasi menghapus data " .
                        $list['nik'] .
                        "');\"><i class='fa fa-trash'></i></a>";
                }
                $start++;
                $output .=
                    "
                        <tr>
                            <td>" .
                    $start .
                    "</td>
                            <td>
                            <a href='" .
                    $base .
                    'user/edit/' .
                    $list['nik'] .
                    "' class='text-warning'><i class='fa fa-pencil'></i></a>
                            " .
                    $hapus .
                    "
                            </td>
                            <td>" .
                    $list['nik'] .
                    "</td>
                            <td>" .
                    $list['username'] .
                    "</td>
                            <td>" .
                    $list['nama'] .
                    "</td>
                            <td>" .
                    $list['nama_perusahaan'] .
                    "</td>
                            <td>" .
                    $list['nama_cabang'] .
                    "</td>
                            <td>" .
                    $list['nama_lokasi'] .
                    "</td>
                            <td>" .
                    $list['user_group'] .
                    "</td>
                            <td>" .
                    $list['status'] .
                    "</td>
                        </tr>
                    ";
            }
        } else {
            $output .= '
            <tr >
            <td colspan="10" class="text-center">data not found</td>
            </tr>
            ';
        }
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }

    public function search_data_usergroup()
    {
        $usergroup = $this->input->post('id');
        $output = '';
        $no = 0;
        $base = base_url();
        // var_dump($usergroup);
        if ($usergroup != null) {
            $listUserGroup = $this->mmasdat->cariusergroup($usergroup);
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
        echo json_encode($output, true);
    }

    public function search_data_jenisinv()
    {
        $jenisinv = $this->input->post('id');
        $output = '';
        $no = 0;
        $base = base_url();
        if ($jenisinv != null) {
            $listjenisinv = $this->mmasdat->carijenisinv($jenisinv);
        } else {
            $listjenisinv = null;
        }

        if ($listjenisinv) {
            foreach ($listjenisinv as $list) {
                $no++;
                $output .=
                    '
                <tr>
                <td>' .
                    $no .
                    '</td>
                <td>
                <a onclick="edit(id=\'' .
                    $list['idjenis_inventory'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                <a href="' .
                    $base .
                    'master_data/delete_jenisinv/' .
                    $list['idjenis_inventory'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi Menghapus Data ' .
                    $list['idjenis_inventory'] .
                    '?");\'><i class="fa fa-trash"></i></a>
                </td>
                <td>' .
                    $list['idjenis_inventory'] .
                    '</td>
                <td>' .
                    $list['jenis_inventory'] .
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

    public function search_data_subinventory()
    {
        $id = $this->input->post('id');
        $output = '';
        $no = 0;
        $base = base_url();
        $count = $this->mmasdat->buatkodesubinventory($id);
        $config['base_url'] =
            base_url() . 'master_data/search_data_subinventory';
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
        if ($id == null) {
            $listsubinv = null;
        } else {
            $listsubinv = $this->mmasdat->carisub($id, $start);
        }

        if ($listsubinv) {
            foreach ($listsubinv as $list) {
                $no++;
                $output .=
                    '
            <tr> 
                <td>' .
                    $no .
                    '</td>
                <td>
                <a onclick="edit(id=\'' .
                    $list['idsub_inventory'] .
                    '\',jenis=\'' .
                    $list['idjenis_inventory'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                <a href="' .
                    $base .
                    'master_data/delete_subinv/' .
                    $list['idsub_inventory'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi menghapus data ' .
                    $list['idsub_inventory'] .
                    ' - ' .
                    $list['sub_inventory'] .
                    ' ? ");\'><i class="fa fa-trash"></i></a>
                </td>
                <td >' .
                    $list['idsub_inventory'] .
                    '</td>
                <td>' .
                    $list['sub_inventory'] .
                    '</td>
                <td>' .
                    $list['idjenis_inventory'] .
                    ' - ' .
                    $list['jenis_inventory'] .
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
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }

    public function search_data_statusinv()
    {
        $statusinv = $this->input->post('status_inv');
        // var_dump($statusinv);die;
        $output = '';
        $no = 0;
        $base = base_url();

        if ($statusinv != null) {
            $liststatusinv = $this->mmasdat->caristatusinv($statusinv);
        }
        // var_dump($liststatusinv);die;

        if ($liststatusinv) {
            foreach ($liststatusinv as $list) {
                $no++;
                $output .=
                    '
                <tr> 
                <td>' .
                    $no .
                    '</td>
                <td>
                <a onclick="edit(id=\'' .
                    $list['idstatus_inventory'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                <a href="' .
                    $base .
                    'master_data/delete_statusinv/' .
                    $list['idstatus_inventory'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi menghapus data ' .
                    $list['idstatus_inventory'] .
                    ' - ' .
                    $list['status_inventory'] .
                    ' ? ");\'><i class="fa fa-trash"></i></a>
                </td>
                <td >' .
                    $list['idstatus_inventory'] .
                    '</td>
                <td>' .
                    $list['status_inventory'] .
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
        echo json_encode($output, true);
    }

    public function search_data_perusahaan()
    {
        $id = $this->input->post('id');
        $count = $this->mmasdat->perusahaancount($id);
        $config['base_url'] =
            base_url() . 'master_data/search_data_subinventory';
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
        $output = '';
        $no = 0;
        $base = base_url();
        // var_dump($perusahaan);die;
        if ($id != null) {
            $listperusahaan = $this->mmasdat->cariperusahaan($id, $start);
        } else {
            $listperusahaan = null;
        }
        // var_dump($listjenisinv[0]);die;
        if ($listperusahaan) {
            foreach ($listperusahaan as $list) {
                $no++;
                $output .=
                    '
                <tr>
                <td>' .
                    $no .
                    '</td>
                <td>
                <a onclick="edit(id=\'' .
                    $list['id_perusahaan'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                <a href="' .
                    $base .
                    'master_data/delete_perusahaan/' .
                    $list['id_perusahaan'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi Menghapus Data ' .
                    $list['id_perusahaan'] .
                    '?");\'><i class="fa fa-trash"></i></a>
                </td>
                <td>' .
                    $list['id_perusahaan'] .
                    '</td>
                <td>' .
                    $list['nama_perusahaan'] .
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
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }

    public function search_data_cabang()
    {
        $id = $this->input->post('cabang');
        $output = '';
        $no = 0;
        $base = base_url();
        $count = $this->mmasdat->buatkodecabang($id);
        $config['base_url'] = base_url() . 'master_data/search_data_cabang';
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
        if ($id != null) {
            $listcabang = $this->mmasdat->caricabang($id, $start);
        } else {
            $listcabang = null;
        }
        // var_dump($listjenisinv[0]);die;

        if ($listcabang) {
            foreach ($listcabang as $list) {
                $start++;
                $output .=
                    '
                <tr>
                <td>' .
                    $start .
                    '</td>
                <td>
                <a onclick="edit(id=\'' .
                    $list['id_cabang'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                <a href="' .
                    $base .
                    'master_data/delete_cabang/' .
                    $list['id_cabang'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi Menghapus Data ' .
                    $list['id_cabang'] .
                    '?");\'><i class="fa fa-trash"></i></a>
                </td>
                <td>' .
                    $list['id_cabang'] .
                    '</td>
                <td>' .
                    $list['nama_cabang'] .
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
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }

    public function search_data_lokasi()
    {
        $id = $this->input->post('lokasi');
        $output = '';
        $no = 0;
        $base = base_url();
        $count = $this->mmasdat->countlokasi($id);
        $config['base_url'] = base_url() . 'master_data/search_data_cabang';
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
        if ($id != null) {
            $listlokasi = $this->mmasdat->carilokasi($id, $start);
        } else {
            $listlokasi = null;
        }

        if ($listlokasi) {
            foreach ($listlokasi as $list) {
                $start++;
                $output .=
                    '
                <tr>
                <td>' .
                    $start .
                    '</td>
                <td>
                <a onclick="edit(id=\'' .
                    $list['id_lokasi'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                <a href="' .
                    $base .
                    'master_data/delete_lokasi/' .
                    $list['id_lokasi'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi Menghapus Data ' .
                    $list['id_lokasi'] .
                    '?");\'><i class="fa fa-trash"></i></a>
                </td>
                <td>' .
                    $list['id_lokasi'] .
                    '</td>
                <td>' .
                    $list['id_cabang'] .
                    '</td>
                <td>' .
                    $list['nama_lokasi'] .
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
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];
        echo json_encode($data, true);
    }

    public function search_data_vendor()
    {
        $id = $this->input->post('vendor');
        $output = '';
        $no = 0;
        $base = base_url();
        $count = $this->mmasdat->buatkodevendor($id);
        $config['base_url'] = base_url() . 'master_data/search_data_vendor';
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

        if ($id != null) {
            $listvendor = $this->mmasdat->carivendor($id, $start);
        } else {
            $listvendor = null;
        }

        if ($listvendor) {
            foreach ($listvendor as $list) {
                $no++;
                $output .=
                    '
                <tr>
                <td>' .
                    $no .
                    '</td>
                <td>
                <a onclick="edit(id=\'' .
                    $list['id_vendor'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                <a href="' .
                    $base .
                    'master_data/delete_vendor/' .
                    $list['id_vendor'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi Menghapus Data ' .
                    $list['id_vendor'] .
                    '?");\'><i class="fa fa-trash"></i></a>
                </td>
                <td>' .
                    $list['id_vendor'] .
                    '</td>
                <td>' .
                    $list['nama_vendor'] .
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
        $data = [
            'output' => $output,
            'pagination' => $this->pagination->create_links(),
        ];

        echo json_encode($data, true);
    }

    public function search_data_jenisaudit()
    {
        $jenisaudit = $this->input->post('jenisaudit');
        $output = '';
        $no = 0;
        $base = base_url();
        $listjenisaudit = $this->mmasdat->carijenisaudit($jenisaudit);

        if ($listjenisaudit) {
            foreach ($listjenisaudit as $list) {
                $no++;
                $output .=
                    '
                <tr>
                <td>' .
                    $no .
                    '</td>
                <td>
                <a onclick="edit(id=\'' .
                    $list['idjenis_audit'] .
                    '\')" class="text-warning" ><i class="fa fa-pencil"></i></a>
                <a href="' .
                    $base .
                    'master_data/delete_jenisaudit/' .
                    $list['idjenis_audit'] .
                    '" class="text-danger" onclick=\'return confirm("Konfirmasi Menghapus Data ' .
                    $list['idjenis_audit'] .
                    '?");\'><i class="fa fa-trash"></i></a>
                </td>
                <td>' .
                    $list['idjenis_audit'] .
                    '</td>
                <td>' .
                    $list['jenis_audit'] .
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
        echo json_encode($output, true);
    }
    //----------------------------------GET 2------------------------------//
    public function ajax_get_usergroup2($id = null)
    {
        $output = '';
        $no = 0;
        $listgroup = $this->mmasdat->getUserGroup();
        foreach ($listgroup as $list) {
            $no++;
            if ($list['id_usergroup'] == $id) {
                $output .=
                    '
                    <option value="' .
                    $list['id_usergroup'] .
                    '" selected>' .
                    $list['id_usergroup'] .
                    ' - ' .
                    $list['user_group'] .
                    '</option>
                ';
            } else {
                $output .=
                    '
                    <option value="' .
                    $list['id_usergroup'] .
                    '">' .
                    $list['id_usergroup'] .
                    ' - ' .
                    $list['user_group'] .
                    '</option>
                ';
            }
        }
        echo '<option value="">--- Pilih User Group ---</option>';
        echo $output;
    }

    public function ajax_get_perusahaan2($id = null)
    {
        $output = '';
        $no = 0;
        $listperusahaan = $this->mmasdat->getPerusahaan();
        foreach ($listperusahaan as $list) {
            $no++;
            if ($list['id_perusahaan'] == $id) {
                $output .=
                    '
                    <option value="' .
                    $list['id_perusahaan'] .
                    '" selected>' .
                    $list['id_perusahaan'] .
                    ' - ' .
                    $list['nama_perusahaan'] .
                    '</option>
                ';
            } else {
                $output .=
                    '
                    <option value="' .
                    $list['id_perusahaan'] .
                    '">' .
                    $list['id_perusahaan'] .
                    ' - ' .
                    $list['nama_perusahaan'] .
                    '</option>
                ';
            }
        }
        echo '<option value="">--- Pilih Perusahaan ---</option>';
        echo $output;
    }

    public function ajax_get_cabang2($id = null)
    {
        $output = '';
        $no = 0;
        $listcabang = $this->mmasdat->getCabang();
        foreach ($listcabang as $list) {
            $no++;
            if ($list['id_cabang'] == $id) {
                $output .=
                    '
                    <option value="' .
                    $list['id_cabang'] .
                    '" selected>' .
                    $list['id_cabang'] .
                    ' - ' .
                    $list['nama_cabang'] .
                    '</option>
                ';
            } else {
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
        }
        echo '<option value="">--- Pilih Cabang ---</option>';
        echo $output;
    }

    public function ajax_get_rakbin($id = null)
    {
        $output = '';
        $no = 0;
        $listrak = $this->mmasdat->getLokasirak();
        foreach ($listrak as $list) {
            $no++;
            if ($list['kd_lokasi_rak'] == $id) {
                $output .=
                    '
                    <option value="' .
                    $list['kd_lokasi_rak'] .
                    '" selected>' .
                    $list['kd_lokasi_rak'] .
                    ' - ' .
                    $list['kd_rak'] .
                    '</option>
                ';
            } else {
                $output .=
                    '
                    <option value="' .
                    $list['kd_lokasi_rak'] .
                    '">' .
                    $list['kd_lokasi_rak'] .
                    ' - ' .
                    $list['kd_rak'] .
                    '</option>
                ';
            }
        }
        echo '<option value="">--- Pilih Rak Bin ---</option>';
        echo $output;
    }
    public function ajax_get_rakbinBaru($id = null)
    {
        $output = '';
        $no = 0;
        $listrak = $this->mmasdat->getRakbinBaru();
        foreach ($listrak as $list) {
            $no++;
            if ($list['kd_lokasi_rak_baru'] == $id) {
                $output .=
                    '
                    <option value="' .
                    $list['kd_lokasi_rak_baru'] .
                    '" selected>' .
                    $list['id_lokasi'] .
                    ' - ' .
                    $list['kd_lokasi_rak_baru'] .
                    '</option>
                ';
            } else {
                $output .=
                    '
                    <option value="' .
                    $list['kd_lokasi_rak_baru'] .
                    '" selected>' .
                    $list['id_lokasi'] .
                    ' - ' .
                    $list['kd_lokasi_rak_baru'] .
                    '</option>
                ';
            }
        }
        echo '<option value="">--- Pilih Rak Bin ---</option>';
        echo $output;
    }

    public function ajax_get_lokasi2($id = null)
    {
        $output = '';
        $no = 0;
        $id = $this->input->post('id_cabang');
        $id2 = $this->input->post('id_lokasi');

        $lokasicabang = $this->mmasdat->getLokasiCabang($id);
        $selected = 'selected';
        foreach ($lokasicabang as $lokcab) {
            $no++;
            if ($lokcab['kd_gudang'] == $id2) {
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
                $selected = ' ';
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
        }
        echo '<option value="">--- Pilih Lokasi ---</option>';
        echo '<option value="ADM" ' . $selected . ' >Not Set</option>';
        echo $output;
    }

    public function ajax_get_jenisinv2()
    {
        $output = '';
        $no = 0;
        $listjenisinv = $this->mmasdat->getJenisInv();
        foreach ($listjenisinv as $list) {
            $no++;
            $output .=
                '
				<option value="' .
                $list['idjenis_inventory'] .
                '">' .
                $list['idjenis_inventory'] .
                ' - ' .
                $list['jenis_inventory'] .
                '</option>
			';
        }
        echo '<option value="">--- Pilih Cabang ---</option>';
        echo $output;
    }

    //-------------------------------------BARCODE----------------------------------------//
    public function generate_barcode_qrcode()
    {
        $data = [
            'judul' => 'Buat Barcode dan QR Code',
            'judul1' => 'Master ',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php', $data);
        $this->load->view(
            'general_affairview/barqrcode/v_buat_barqrcode.php',
            $data
        );
        $this->load->view('general_affairview/barqrcode/_partial/footer.php');
    }

    //-------------------------------PAGINATION-----------------------------//
    public function UserPagination()
    {
        // Membuat Style pagination untuk BootStrap v4
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] =
            '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] =
            '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] =
            '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] =
            '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] =
            '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close'] =
            '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] =
            '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close'] = '</span>Next</li>';
        $config['first_tag_open'] =
            '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open'] =
            '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close'] = '</span></li>';
    }
}

/* End of file Controllername.php */
