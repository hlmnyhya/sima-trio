
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        ini_set('max_execution_time', 0);
        $this->load->model('m_master_data', 'mmasdat');
        $this->load->model('m_menu', 'mmenu');
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Login Dulu!</div>');
            redirect('login/sima_login');
        } else {
            if ($this->session->userdata('usergroup') == 'UG005') {
            } else {
                redirect('error');
            }
        }
    }

    public function rules()
    {
        $data = [
            'judul' => "User Akses",
            'judul1' => 'User Rules',
        ];
        $this->load->view('_partial/header.php', $data);
        $this->load->view('_partial/sidebar.php');
        $this->load->view('backend/v_rules.php', $data);
        $this->load->view('backend/_partial/footer.php');
    }
    public function ajax_get_usergroup2($id = null)
    {
        $output = '';
        $no = 0;
        $listgroup = $this->mmasdat->getUserGroup();
        foreach ($listgroup as $list) {
            $no++;
            if ($list['id_usergroup'] == $id) {
                $output .= '
                    <option value="' . $list['id_usergroup'] . '" selected>' . $list['id_usergroup'] . ' - ' . $list['user_group'] . '</option>
                ';
            } else {
                $output .= '
                    <option value="' . $list['id_usergroup'] . '">' . $list['id_usergroup'] . ' - ' . $list['user_group'] . '</option>
                ';
            }
        }
        echo '<option value="">--- Pilih User Group ---</option>';
        echo $output;
    }
    public function ajax_get_menuakses2($id = null)
    {
        $output = '';
        $no = 0;
        $listmenu = $this->mmenu->getMenu();
        foreach ($listmenu as $list) {
            $no++;
            if ($list['id_menu'] == $id) {
                $output .= '
                    <option value="' . $list['id_menu'] . '" selected>' . $list['id_menu'] . ' - ' . $list['menu'] . '</option>
                ';
            } else {
                $output .= '
                    <option value="' . $list['id_menu'] . '">' . $list['id_menu'] . ' - ' . $list['menu'] . '</option>
                ';
            }
        }
        echo '<option value="">--- Pilih Menu ---</option>';
        echo $output;
    }

    public function ajax_get_rule()
    {
        $id = $this->input->post('id');
        $output = '';
        $no = 0;
        $count = $this->mmenu->countmenuakses($id);
        $config['base_url'] = base_url() . 'laporan_auditor/ajax_get_rule';
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
        $base = base_url();
        if ($id === null) {
            $listUser = null;
        } else {
            $listUser = $this->mmenu->menuakses($id, $start);
        }

        if ($listUser) {
            foreach ($listUser as $list) {

                $start++;
                $output .= "
                    <tr>
                        <td class='text-center'>" . $start . "</td>
                        <td class='text-center'>
                        
                        <a href='" . $base . "menu/delete/" . $list['id_menu_akses'] . "' class='text-danger' onclick=\"return confirm('Konfirmasi menghapus akses " . $list['menu'] . " ? ');\" ><i class='fa fa-trash'></i></a>
                        </td>
                        <td>" . $list['menu'] . "</td>
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
            'pagination' => $this->pagination->create_links()
        ];
        echo json_encode($data, true);
    }

    public function delete($id = null)
    {
        if ($id === null) {
            $this->session->set_flashdata('warning', 'tidak ada');


            redirect('menu/rules');
        } else {
            $result = $this->mmenu->delmenuakses($id);
            if ($result) {
                $this->session->set_flashdata('berhasil', 'Dihapus');


                redirect('menu/rules');
            } else {
                $this->session->set_flashdata('gagal', 'Gagal dihapus');


                redirect('menu/rules');
            }
        }
    }

    public function input_rules()
    {
        $data = [
            'code' => $this->mmenu->countmenuakses()
        ];

        $this->load->view('backend/v_inputRules.php', $data);
        $this->load->view('backend/_partial/footer2.php');
    }

    public function post_menuakses()
    {
        $data = [
            'id_usergroup' => $this->input->post('usergroup', true),
            'id_menu' => $this->input->post('menu', true),

        ];
        $id = $data['id_usergroup'];
        $id2 = $data['id_menu'];

        $cek = $this->mmenu->getmenuByakses($id2, $id);
        // var_dump($cek,$_POST);die;
        if ($cek) {

            $this->session->set_flashdata('warning', 'sudah ada');

            redirect('menu/rules');
        } else {
            $exec = $this->mmenu->addMenuakses($data);
            if ($exec) {

                $this->session->set_flashdata('berhasil', 'berhasil ditambahkan');
                redirect('menu/rules');
            } else {
                $this->session->set_flashdata('gagal', 'gagal ditambahkan');
                redirect('menu/rules');
            }
        }
    }
}

/* End of file Controllername.php */

?>
