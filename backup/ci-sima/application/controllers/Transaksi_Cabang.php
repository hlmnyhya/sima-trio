<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_Cabang extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_transaksi_GA', 'mtransga');
        if (!$this->session->userdata('username')) {

            redirect('login/sima_login');
        } else {
            if ($this->session->userdata('usergroup') == 'UG004') {
            } else {
                require_once('Login.php');
            }
        }
    }

    public function inputOffice()
    {
        $data = [
            'judul' => "Input Data Inventory",
            'judul1' => 'Transaksi Admin',
            'max' => $this->mtransga->getcountInv()
        ];
        // var_dump($data);die;
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('cabang/input_office/v_management_inv.php', $data);
        $this->load->view('cabang/input_office/_partial/footer.php', $data);
    }
    public function MonitOffice()
    {
        $data = [
            'judul' => "Monitoring Inventory",
            'judul1' => 'Transaksi GA'
        ];
        // var_dump($data);die;
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('cabang/monit_office/v_monitoring_inv.php', $data);
        $this->load->view('cabang/monit_office/_partial/footer.php', $data);
    }
    public function mutasiOffice()
    {
        $data = [
            'judul' => "Input Mutasi Inventory",
            'judul1' => 'Transaksi Admin',
            'max' => $this->mtransga->getcountInv()
        ];
        // var_dump($data);die;
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('cabang/mutasi_office/v_management_inv.php', $data);
        $this->load->view('cabang/mutasi_office/_partial/footer.php', $data);
    }
    public function ajax_get_Inventory()
    {
        $output = '';
        $cabang = $this->session->userdata('id_cabang');
        $no = 0;
        $count = $this->mtransga->getCountInv(null, $cabang);
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'transaksi_cabang/ajax_get_Inventory';
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
        $listinv = $this->mtransga->getInv($start, $cabang);
        //    var_dump($listinv);die;
        if ($listinv) {
            foreach ($listinv as $list) {
                $tgl = strtotime($list['tanggal_barang_diterima']);
                if ($tgl != 0) {
                    $tgl = date('d M Y', $tgl);
                }
                $start++;
                $output .= '
                <tr>
                    <td>' . $start . '</td>
                    <td class="tooltip-demo">
                    <a href="' . base_url() . 'transaksi/editoffice?id=' . $list['idtransaksi_inv'] . '" class="text-warning"><i class="fa fa-fw fa-pencil"></i></a>
                    <a href="' . base_url() . 'transaksi_cabang/deloffice?id=' . base64_encode($list['idtransaksi_inv']) . '" onclick=\'return confirm("Konfirmasi menghapus data ' . $list['idtransaksi_inv'] . ' ? ");\' class="text-danger"><i class="fa fa-fw fa-trash"></i></a>
                    <a href="' . base_url() . 'transaksi/detail?id=' . $list['idtransaksi_inv'] . '" class="text-blue" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-fw fa-eye"></i></a>
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
        <tr><td colspan="13" class="text-center">data not found.</td></tr>
           ';
        }
        $data = array(
            'output' => $output,
            'pagination' => $this->pagination->create_links()
        );
        echo json_encode($data, true);
    }
    public function delOffice()
    {
        $id = base64_decode($this->input->get('id'));
        if ($id == null) {
            $this->session->set_flashdata('warning', 'need id');

            redirect('transaksi/monit_office');
        } else {
            $exec = $this->mtransga->delInv($id);
            var_dump($exec);
            die;
            if ($exec) {
                $this->session->set_flashdata('berhasil', 'Berhasil dihapus');

                redirect('transaksi/monit_office');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal dihapus');

                redirect('transaksi/monit_office');
            }
        }
    }
    public function ajax_get_statusinv2($id = null)
    {
        $output = '';
        $no = 0;
        $liststatusinv = $this->mtransga->getStatusInv();
        foreach ($liststatusinv as $list) {
            $no++;
            if ($list['idstatus_inventory'] == $id) {
                $output .= '
				<option value="' . $list['idstatus_inventory'] . '" selected>' . $list['idstatus_inventory'] . ' - ' . $list['status_inventory'] . '</option>
			';
            } else {
                $output .= '
                    <option value="' . $list['idstatus_inventory'] . '">' . $list['idstatus_inventory'] . ' - ' . $list['status_inventory'] . '</option>
                ';
            }
        }
        echo '<option value="">--- Pilih Status Inventory ---</option>';
        echo $output;
    }

    public function ajax_get_subinv2()
    {
        $output = '';
        $no = 0;
        $id = $this->input->post('idjenis_inventory');
        $sub = $this->input->post('id');

        $jenissubinv = $this->mtransga->getSubInvById($id);
        // var_dump($jenissubinv);
        foreach ($jenissubinv as $list) {
            $no++;
            if ($list['idsub_inventory'] == $sub) {
                $output .= '
                    <option value="' . $list['idsub_inventory'] . '" selected>' . $list['idsub_inventory'] . ' - ' . $list['sub_inventory'] . '</option>
                ';
            } else {
                $output .= '
                    <option value="' . $list['idsub_inventory'] . '">' . $list['idsub_inventory'] . ' - ' . $list['sub_inventory'] . '</option>
                ';
            }
        }
        echo '<option value="">--- Pilih Sub Inventory ---</option>';
        echo $output;
    }


    public function ajax_get_jenisinv2($id = null)
    {
        $output = '';
        $no = 0;
        $listjenisinv = $this->mtransga->getJenisInv();
        foreach ($listjenisinv as $list) {
            $no++;
            if ($list['idjenis_inventory'] == $id) {
                $output .= '
                    <option value="' . $list['idjenis_inventory'] . '" selected>' . $list['idjenis_inventory'] . ' - ' . $list['jenis_inventory'] . '</option>
                ';
            } else {
                $output .= '
                    <option value="' . $list['idjenis_inventory'] . '" >' . $list['idjenis_inventory'] . ' - ' . $list['jenis_inventory'] . '</option>
                ';
            }
        }
        echo '<option value="">--- Pilih Jenis Inventory ---</option>';
        echo $output;
    }

    public function ajax_get_vendor2($id = null)
    {
        $output = '';
        $no = 0;
        $listvendor = $this->mtransga->getVendor();
        foreach ($listvendor as $list) {
            $no++;
            if ($list['id_vendor'] == $id) {
                $output .= '
                    <option value="' . $list['id_vendor'] . '" selected>' . $list['id_vendor'] . ' - ' . $list['nama_vendor'] . '</option>
                ';
            } else {
                $output .= '
                    <option value="' . $list['id_vendor'] . '">' . $list['id_vendor'] . ' - ' . $list['nama_vendor'] . '</option>
                ';
            }
        }
        echo '<option value="">--- Pilih Vendor ---</option>';
        echo $output;
    }

    public function ajax_get_cabang2()
    {
        $output = '';
        $no = 0;
        $listcabang = $this->mtransga->getCabang();
        foreach ($listcabang as $list) {
            $no++;
            $output .= '
				<option value="' . $list['id_cabang'] . '">' . $list['id_cabang'] . ' - ' . $list['nama_cabang'] . '</option>
			';
        }
        echo '<option value="">--- Pilih Cabang ---</option>';
        echo $output;
    }

    public function ajax_get_lokasi2()
    {
        $output = '';
        $no = 0;
        $id = $this->input->post('id_cabang');
        $id2 = $this->input->post('key');
        $lokasicabang = $this->mtransga->getLokasiCabang($id);
        foreach ($lokasicabang as $lokcab) {
            $idlokasi = $lokcab['id_lokasi'];
            $listlokasi = $this->mtransga->getLokasiByid($idlokasi);
            foreach ($listlokasi as $list) {
                $no++;
                if ($list['id_lokasi'] == $id2) {
                    $output .= '
                        <option value="' . $list['id_lokasi'] . '" selected>' . $list['id_lokasi'] . ' - ' . $list['nama_lokasi'] . '</option>
                    ';
                } else {
                    $output .= '
                        <option value="' . $list['id_lokasi'] . '">' . $list['id_lokasi'] . ' - ' . $list['nama_lokasi'] . '</option>
                    ';
                }
            }
        }
        echo '<option value="">--- Pilih Lokasi ---</option>';
        echo $output;
    }
    public function post_inventory()
    {
        $tgl =  $this->input->post('tanggal_barang_terima', true);
        $tgl = strtotime($tgl);
        $tgl = date('Y-m-d', $tgl);
        $nama = str_replace('/', '-', $this->input->post('id_inventory', true));
        $config['upload_path'] = './assets/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = true;
        $config['file_name'] = $nama . ".jpg";
        $config['max_size']  = '100';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';

        $this->load->library('upload', $config);

        $this->upload->do_upload('foto');
        // var_dump($this->upload->data('file_name'));die;

        $data = [
            'idtransaksi_inv' => $this->input->post('id_inventory', true),
            'idstatus_inventory' => $this->input->post('idstatus_inventory', true),
            'idjenis_inventory' => $this->input->post('idjenis_inventory', true),
            'idsub_inventory' => $this->input->post('idsub_inventory', true),
            'nilai_awal' => $this->input->post('nilai_awal', true),
            'ddp' => $this->input->post('ddp', true),
            'nilai_asset' => $this->input->post('nilai_asset', true),
            'nilai_total_keseluruhan' => $this->input->post('nilai_total_keseluruhan', true),
            'tanggal_barang_diterima' => $tgl,
            'id_vendor' => $this->input->post('id_vendor', true),
            'jenis_pembayaran' => $this->input->post('jenis_pembayaran', true),
            'id_cabang' => $this->input->post('id_cabang', true),
            'id_lokasi' => $this->input->post('id_lokasi', true),
            'nama_pengguna' => $this->input->post('nama_pengguna', true),
            'keterangan' => $this->input->post('keterangan', true),
            'stok' => $this->input->post('stok', true),
            'foto' => $this->upload->data('file_name'),
            'asal_hadiah' => $this->input->post('asal_hadiah', true),
            'ppn' => $this->input->post('ppn', true),
            'ket_ppn' => $this->input->post('ket_ppn', true),
            'merk' => $this->input->post('merk', true),
            'aksesoris_tambahan' => $this->input->post('aksesoris_tambahan', true),
            'serial_number' => $this->input->post('serial_number', true),
            'uang_muka' => $this->input->post('uang_muka', true),
            'cicilan_perbulan' => $this->input->post('cicilan_perbulan', true),
            'tenor' => $this->input->post('tenor', true),
            'nilai_total' => $this->input->post('nilai_total', true),
            'no_mesin' => $this->input->post('no_mesin', true),
            'no_rangka' => $this->input->post('no_rangka', true),
            'user'  => $this->session->userdata('username')

        ];
        $id = $this->input->post('id_inventory', true);
        // var_dump($_POST);
        // die;
        $inventory = $this->mtransga->getInventoryById($id);
        if ($inventory) {
            $this->session->set_flashdata('warning', 'sudah ada');

            redirect('transaksi/input_office');
        } else {
            if ($this->mtransga->addInv($data)) {
                $this->session->set_flashdata('berhasil', 'berhasil ditambah');

                redirect('transaksi/input_office');
            } else {
                $this->session->set_flashdata('gagal', 'gagal ditambah');

                redirect('transaksi/input_office');
            }
        }
    }
}

/* End of file Transaksi_Cabang.php */
