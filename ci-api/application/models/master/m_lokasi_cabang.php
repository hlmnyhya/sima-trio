<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Lokasi_Cabang extends CI_Model
{

    public function getLokasiCabang($id = null)
    {
        if ($id === null) {
            // $this->db->select('lokasi_cabang.*, nama_lokasi');
            // $this->db->join('lokasi', 'lokasi_cabang.id_lokasi = lokasi.id_lokasi', 'left');

            // $result = $this->db->get('lokasi_cabang')->result();
            $result = $this->db->query("select * from gudang")->result();
            return $result;
        } else {
            // $this->db->select('lokasi_cabang.*, nama_lokasi');
            // $this->db->join('lokasi', 'lokasi_cabang.id_lokasi = lokasi.id_lokasi', 'left');
            // $result = $this->db->get_where('lokasi_cabang',['id_cabang' => $id])->result();
            $result = $this->db->query("select * from gudang where left(kd_gudang, 3) = '" . $id . "'")->result();
            return $result;
        }
    }

    public function getLokasiRak($id = null ) 
    {
        if ($id === null ) {
            $result =  $this -> db-> query("select * from lokasi_rak_bin")->result();
            return $result;
        }else {
            $query = " select lokasi_rak_bin.*, gudang.nama_gudang
            from lokasi_rak_bin 
            LEFT JOIN gudang ON lokasi_rak_bin.id_lokasi = gudang.kd_gudang 
            where gudang.kd_gudang = '$id'";

            $result = $this->db->query($query)->result();
            return $result;
        }
    }
        
    
    public function getLokasiAsset($id = null)
    {
        if($id === null){
            $result = $this->db->query("select * from lokasi")->result();
            return $result;
        }else{
        $query = "select lokasi.id_lokasi, nama_lokasi, cabang.id_cabang 
        from lokasi 
        left join cabang 
        on lokasi.id_cabang = cabang.id_cabang 
        where cabang.id_cabang = '$id'";
        // $this->db->where('id_cabang', $id);

        $result = $this->db->query($query)->result();
        return $result;
        }
    }
     public function getrakbinsima($id = null)
    {
        if ($id === null ) {
            $result =  $this -> db-> query("select * from rak_bin")->result();
            return $result;
        }else {
            $query = " select rak_bin.*, gudang.nama_gudang
            from rak_bin 
            LEFT JOIN gudang ON rak_bin.id_lokasi = gudang.kd_gudang 
            where gudang.kd_gudang = '$id'";

            $result = $this->db->query($query)->result();
            return $result;
        }
    }

    public function addrakbin() 
    {
        
       $this->db->insert('rak_bin', $data);
       return $this->db->affected_rows(); 
        
    }
}
