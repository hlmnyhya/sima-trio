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

    public function searchPart($id = null, $idjadwal_audit = null)
    {
        if ($id === null) {
            $this->db->select('part.*,nama_cabang, nama_gudang');
            $this->db->from('part');
            $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('gudang', 'part.id_lokasi = gudang.kd_gudang', 'left');
            $this->db->where("part.idjadwal_audit", $idjadwal_audit);
             
            $result = $this->db->get()->result();

            return $result;
        }
    }

    public function addPart($data)
    {
        $this->db->insert('part', $data);
        return $this->db->affected_rows();
    }

    public function deletePart($id)
    {
        $this->db->delete('part', ['part_number' => $id]);
        return $this->db->affected_rows();
    }

    public function updatePart($data, $id)
    {
        $this->db->update('part', $data, ['part_number' => $id]);
        return $this->db->affected_rows();
    }

    public function PartEnd($id)
    {
        $this->db->update('part', ['status' => 1], ['part_number' => $id]);
        return $this->db->affected_rows();
    }

    public function getpartendbefore($id)
    {
        $this->db->select('part.*,nama_cabang, nama_gudang');
        $this->db->from('part');
        $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
        $this->db->join('gudang', 'part.id_lokasi = gudang.kd_gudang', 'left');
        $this->db->where('part.id_cabang',$id);
        $this->db->where('part.status', 1);
        $result = $this->db->get()->result();

        return $result;
    }

    public function getlistpartstatus($id)
    {
        $this->db->select('part.*,nama_cabang, nama_gudang');
        $this->db->from('part');
        $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
        $this->db->join('gudang', 'part.id_lokasi = gudang.kd_gudang', 'left');
        $this->db->where('part.id_cabang',$id);
        $this->db->where('part.status', 0);
        $result = $this->db->get()->result();

        return $result;
    }

    public function getsearchpartstatus($id, $offset, $idjadwal_audit)
    {
        $this->db->select('part.*,nama_cabang, nama_gudang');
        $this->db->from('part');
        $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
        $this->db->join('gudang', 'part.id_lokasi = gudang.kd_gudang', 'left');
        $this->db->where('part.id_cabang',$id);
        $this->db->where('part.status', 0);
        $this->db->where("part.idjadwal_audit", $idjadwal_audit);
        $this->db->limit(15);
        $this->db->offset($offset);
        $result = $this->db->get()->result();

        return $result;
    }

    public function cariscanpart($id)
    {
        $this->db->select('part.*,nama_cabang, nama_gudang');
        $this->db->from('part');
        $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
        $this->db->join('gudang', 'part.id_lokasi = gudang.kd_gudang', 'left');
        $this->db->where('part.part_number',$id);
        $result = $this->db->get()->result();

        return $result;
    }
}

/* End of file M_part.php */
