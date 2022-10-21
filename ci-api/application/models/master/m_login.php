<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

    function getUserByid($username){
        $this->db->select('user.*, user_group,nama_perusahaan, nama_cabang, nama_lokasi');
        $this->db->from('user');
        $this->db->join('user_group', 'user_group.id_usergroup = user.id_usergroup', 'left');
        $this->db->join('perusahaan', 'perusahaan.id_perusahaan = user.id_perusahaan', 'left');
        $this->db->join('cabang', 'cabang.id_cabang = user.id_cabang', 'left');
        $this->db->join('lokasi', 'lokasi.id_lokasi = user.id_lokasi', 'left');
        $this->db->where('username', $username);
        $this->db->where("status='Aktif'");
        
        
        return $this->db->get()->result();
        
    }

    public function history($data)
    {
        $this->db->insert('history_login', $data);
        return $this->db->affected_rows();
    }

}

/* End of file M_login.php */
