<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_aksesoris extends CI_Model{
        public function getAksesoris($id=null,$b = null,$d=null)
        {
            if ($d === null) {
                $this->db->select('aksesoris.*, nama_cabang, nama_lokasi ');
                $this->db->from('aksesoris');
                $this->db->join('lokasi', 'aksesoris.id_lokasi = lokasi.id_lokasi', 'left');
                $this->db->join('cabang', 'aksesoris.id_cabang = cabang.id_cabang', 'left');
                $this->db->where('aksesoris.id_cabang', $id);
                $this->db->where("aksesoris.idjadwal_audit",$b);
                $result = $this->db->get()->result();
    
                return $result;
            }else {
                $this->db->select('aksesoris.*, nama_cabang, nama_lokasi ');
                $this->db->from('aksesoris');
                $this->db->join('lokasi', 'aksesoris.id_lokasi = lokasi.id_lokasi', 'left');
                $this->db->join('cabang', 'aksesoris.id_cabang = cabang.id_cabang', 'left');
                $this->db->where('aksesoris.id_cabang', $id);
                $this->db->where("aksesoris.idjadwal_audit",$b);
                $this->db->limit(15);
                $this->db->offset($d);
                $result = $this->db->get()->result();
    
                return $result;
            }
            
        }
        
        public function addAksesoris($data)
        {
            $result = $this->db->insert('aksesoris',$data); 
            return $this->db->affected_rows();
        }

        public function editAksesoris($data,$id)
        {
            $this->db->where('id_aksesoris', $id);
            $this->db->update('aksesoris', $data);  
            return $this->db->affected_rows();
        }

        public function delAksesoris($id_aksesoris)
        {
            $this->db->where('id_aksesoris', $id_aksesoris);
            $this->db->delete('aksesoris');
            return $this->db->affected_rows();
            
    }

    public function sumUnit($id)
    {
        return $this->db->query("SELECT SUM(aki) as jum_aki,SUM(tools) as jum_tools,SUM(spion) as jum_spion,SUM(helm) as jum_helm,SUM(buku_service) as jum_buku FROM aksesoris WHERE id_cabang='$id'")->result();
    }

    }

    
    /* End of file Controllername.php */
    
?>