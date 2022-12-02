<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class M_Part extends CI_Model {

    public function GetPart($id=null)
    {
        if ($id === null) {
            $this->db->select('part.*,nama_cabang, nama_gudang');
            $this->db->from('part');
            $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('gudang', 'part.id_lokasi = gudang.kd_gudang', 'left');
            $this->db->where('part_number', $id);
             
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

    public function PartEnd($cabang, $idjadwal_audit)
    { 
        $query = "
        INSERT INTO part (part_number, kd_lokasi_rak, id_cabang, id_lokasi, deskripsi, qty, kondisi, status, tanggal_audit, idjadwal_audit)
        SELECT part_number, kd_lokasi_rak, id_cabang, id_lokasi, deskripsi, qty, kondisi, status, CONVERT(date,GETDATE()) as tanggal_audit, idjadwal_audit
        FROM temp_part a 
        WHERE a.part_number NOT IN (
        SELECT part_number FROM part WHERE idjadwal_audit = '$idjadwal_audit')
        AND a.id_cabang='$cabang' AND idjadwal_audit = '$idjadwal_audit'        
        ";
        $this->db->query($query);
        $query2 = "
            UPDATE part
            SET kondisi = 'Rusak'
            WHERE kondisi is null AND id_cabang = '$cabang' and idjadwal_audit = '$idjadwal_audit'
        ";
        $this->db->query($query2);
        // $query3 = "
        //     UPDATE part
        //     SET status = 'Belum Ditemukan'
        //     WHERE status is null AND id_cabang = '$cabang' and idjadwal_audit = '$idjadwal_audit'";
        // $this->db->query($query3);
        $query4 = "
            DELETE FROM temp_part WHERE id_cabang = '$cabang' and idjadwal_audit = '$idjadwal_audit'
        ";
        $this->db->query($query4);
        return  $this->db->affected_rows();
    }

    public function getpartendbefore($id)
    {
        $this->db->select('part.*,nama_cabang, nama_gudang');
        $this->db->from('part');
        $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
        $this->db->join('gudang', 'part.id_lokasi = gudang.kd_gudang', 'left');
        $this->db->where('part.id_cabang',$id);
        $this->db->where('part.kondisi', 1);
        $result = $this->db->get()->result();

        return $result;
    }

    public function getlistpartkondisi($id)
    {
        $this->db->select('part.*,nama_cabang, nama_gudang');
        $this->db->from('part');
        $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
        $this->db->join('gudang', 'part.id_lokasi = gudang.kd_gudang', 'left');
        $this->db->where('part.id_cabang',$id);
        $this->db->where('part.kondisi', 0);
        $result = $this->db->get()->result();

        return $result;
    }

    public function getsearchpartkondisi($id, $offset, $idjadwal_audit)
    {
        $this->db->select('part.*,nama_cabang, nama_gudang');
        $this->db->from('part');
        $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
        $this->db->join('gudang', 'part.id_lokasi = gudang.kd_gudang', 'left');
        $this->db->where('part.id_cabang',$id);
        $this->db->where('part.kondisi', 0);
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

    public function previewpart($a,$b,$d,$e)
    {
        $this->db->select('
                a.id_part, a.part_number, a.deskripsi,
                a.kd_lokasi_rak, a.deskripsi, a.qty, a.kondisi, a.keterangan, a.status, b.nama_cabang, c.nama_gudang
        ');
            $this->db->from('part a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('gudang c', 'a.id_lokasi = c.kd_gudang', 'left');

            $this->db->where("a.id_cabang='$a' AND a.idjadwal_audit = '$b' ");
            if($d != ""){
                $this->db->where('a.kondisi', $d);
            }
            $this->db->limit(15);
            $this->db->offset($e);

            return $this->db->get()->result();

    }
    
    public function EditPartKet($data,$id)
    {
        $this->db->where('idjadwal_audit', $id);
        $this->db->update('jadwal_audit', $data);
        return $this->db->affected_rows(); 
    }

    public function getaudlistpart($id=null, $offset=null)
    {
        if ($id === null) {
            $this->db->select('part_number, kd_lokasi_rak, qty, id_lokasi, deskripsi');
            $this->db->from('temp_part');
            $this->db->limit(15);
            $this->db->offset($offset);

            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('part_number, kd_lokasi_rak, qty, id_lokasi, deskripsi');
            $this->db->from('temp_part');
            $this->db->where('part_number.id_part',$id);

            $result = $this->db->get()->result();

            return $result;
        }

    }

    public function getcekpart($id = null,$cabang= null, $lokasi = null, $rakbin = null, $idjadwal_audit = null, $part_number = null, $qty = null)
    {
        if ($id === null) {
            $this->db->select('part_number, kd_lokasi_rak, qty, id_lokasi, idjadwal_audit, id_cabang ');
            $this->db->from('part');

            $result = $this->db->get()->result();

            return $result;
        }else{
            $this->db->select('part_number, kd_lokasi_rak, qty, id_lokasi, idjadwal_audit, id_cabang ');
            $this->db->from('part');

            if ($lokasi !=null) {
                $this->db->where("a.id_lokasi",$lokasi);
                
            }
            if ($rakbin !=null) {
                $this->db->where("a.kd_lokasi_rak",$rakbin);
                
            }
            if ($idjadwal_audit !=null) {
                $this->db->where("a.idjadwal_audit", $idjadwal_audit );
                
            }
            if ($part_number !=null) {
                $this->db->where("a.part_number", $part_number );
            }

            $result = $this->db->get()->result();
            return $result;
        }
    }

    public function addlistpart($data)
    {
        $this->db->insert('part', $data);
        return $this->db->affected_rows();
    }
    
}
/* End of file M_part.php */
