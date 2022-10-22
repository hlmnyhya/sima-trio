<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class M_Part extends CI_Model {

    public function getPart($id=null)
    {
        if ($id === null) {
            $this->db->select('part.*,nama_cabang, nama_gudang');
            $this->db->from('part');
            $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('gudang', 'part.id_lokasi = gudang.kd_gudang', 'left');
             
            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('part.*,nama_cabang, nama_gudang');
            $this->db->from('part');
            $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('gudang', 'part.id_lokasi = gudang.kd_gudang', 'left');
            $this->db->where('part_number', $id);
            
            
            
            $result = $this->db->get()->result();

            return $result;
        }
        
    }

    public function getpartValid($id=null, $offset=null, $idjadwal_audit = null)
    {
        if ($id === null) {
            $this->db->select('part.*,nama_cabang, nama_gudang');
            $this->db->from('part');
            $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('gudang', 'part.id_lokasi = gudang.kd_gudang', 'left');
            $this->db->limit(15);
            $this->db->offset($offset);
             
            $result = $this->db->get()->result();

            return $result;
        } else {
            $this->db->select('part.*,nama_cabang, nama_gudang');
            $this->db->from('part');
            $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('gudang', 'part.id_lokasi = gudang.kd_gudang', 'left');
            if($offset != null){
                $this->db->limit(15);
                $this->db->offset($offset);
            }
            $this->db->where('part.id_cabang',$id);
            if($idjadwal_audit != null){
                $this->db->where("part.idjadwal_audit", $idjadwal_audit);
            }
            
            $result = $this->db->get()->result();

            return $result;
        }
        
    }

}

/* End of file M_part.php */
