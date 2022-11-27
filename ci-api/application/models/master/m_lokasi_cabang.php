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

    public function getLokasiRak($id = null)
    {
        // $id = $this->db->get('gudang')->result();
                
        // if ($id === null) {
        // $data = array(
        //     'id_lokasi' => $id
        // );
        // $this->db->where($data);

        // $result = $this->db->get_where('lokasi_rak_bin', 'id_lokasi', $data)->result();
        // return $result;
        // }
       
        
        $result = $this->db->query("SELECT * FROM lokasi_rak_bin WHERE id_lokasi = '2NG-2NGP'")->result();
        return $result;
        
        
        // $result = $this->db->query("select * from lokasi_rak_bin where id_lokasi = '".$id."'")->result();
        // return $result; 

        
        
        
        
        
        // if ($id === null) {
        //     $result = $this->db->query("select * from lokasi_rak_bin")->result();
        //     return $result;    
        // }else{
        //     $result = $this->db->query("select * from lokasi_rak_bin where id_lokasi = '".$id."'")->result();
        //     return $result;              
        // }
        
        
        // if ($id === null && $offset==null) {
        //     $result = $this->db->get('lokasi_rak_bin')->result();
        //     return $result;    
        // }elseif($id === null && $offset!=null) {
        //     $result = $this->db->get('lokasi_rak_bin',15,$offset)->result();
        //     return $result;    
        // }else{
        //     $result = $this->db->get_where('lokasi_rak_bin',['kd_gudang' => $id])->result();
        //     return $result;              
        // }
    }
    

}

/* End of file M_Lokasi_Cabang.php */

?>