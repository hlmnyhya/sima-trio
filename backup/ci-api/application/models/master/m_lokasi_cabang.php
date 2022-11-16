<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Lokasi_Cabang extends CI_Model {

    public function getLokasiCabang($id = null)
    {
        if ($id === null) {
            // $this->db->select('lokasi_cabang.*, nama_lokasi');
            // $this->db->join('lokasi', 'lokasi_cabang.id_lokasi = lokasi.id_lokasi', 'left');
            
            // $result = $this->db->get('lokasi_cabang')->result();
            $result = $this->db->query("select * from gudang")->result();
            return $result;    
        }else{
            // $this->db->select('lokasi_cabang.*, nama_lokasi');
            // $this->db->join('lokasi', 'lokasi_cabang.id_lokasi = lokasi.id_lokasi', 'left');
            // $result = $this->db->get_where('lokasi_cabang',['id_cabang' => $id])->result();
            $result = $this->db->query("select * from gudang where left(kd_gudang, 3) = '".$id."'")->result();
            return $result;              
        }
    }

}

/* End of file M_Lokasi_Cabang.php */

?>