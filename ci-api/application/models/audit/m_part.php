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

    public function previewpart($a,$b,$c,$d,$e)
    {
        $this->db->select('
                a.id_part, a.part_number, a.deskripsi,
                a.kd_lokasi_rak, a.deskripsi, a.qty, a.kondisi, a.keterangan, a.status, b.nama_cabang, c.nama_gudang
        ');
            $this->db->from('part a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('gudang c', 'a.id_lokasi = c.kd_gudang', 'left');

            $this->db->where("a.id_cabang='$a' AND a.idjadwal_audit = '$b' ");
            // if ($c) {
            //     $this->db->where('a.status', $c);
            // }
            // if($d){
            //     $this->db->where('a.kondisi', $d);
            // }
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
    
    

    // public function updateqty($id, $qty, $rakbin, $cabang, $lokasi)
    // {
    //     $query = "SELECT COUNT(id_part) from part";
    //     $this->db->query($query);

    //     if ($id = null) {
    //         $query1 = "INSERT INTO part (part_number, kd_lokasi_rak, id_cabang, id_lokasi, qty) VALUES ('$id', '$rakbin', '$cabang', '$lokasi', '$qty')";
    //         $this->db->query($query1);
    //     } else {
    //         $query2= "UPDATE part SET qty = '$qty' + 1 WHERE part_number = '$id' AND kd_lokasi_rak = '$rakbin' AND id_cabang = '$cabang' AND id_lokasi = '$lokasi'";
    //         $this->db->query($query2);
    //     }
    //     return $this->db->affected_rows();
    // }

    public function updateqty($part_number, $qty, $idjadwal_audit, $cabang, $lokasi, $rakbin)
    {        
        $query = "SELECT COUNT(id_part) from part_qty";
        $this->db->query($query);

        if ($part_number != null ) {
            $query1 = "SELECT COUNT(id_part) from part_qty WHERE part_number = '$part_number' AND id_cabang = '$cabang' AND id_lokasi = '$lokasi' AND idjadwal_audit = '$idjadwal_audit' AND kd_lokasi_rak = '$rakbin'";
            $this->db->query($query1);
            if ($part_number = null)
            {
                $query2 = "INSERT INTO part_qty (id_part, id_cabang, id_lokasi, part_number, deskripsi, status, kondisi, kd_lokasi_rak, qty,  idjadwal_audit, tanggal_audit) 
                SELECT id_part, id_cabang, id_lokasi, part_number, deskripsi, status, kondisi, kd_lokasi_rak, qty=1, idjadwal_audit,        CONVERT(date,GETDATE()) as tanggal_audit 
                FROM temp_part 
                WHERE part_number = '$part_number' AND id_cabang = '$cabang' AND id_lokasi = '$lokasi' AND idjadwal_audit = '$idjadwal_audit' AND kd_lokasi_rak = '$rakbin'";
                $this->db->query($query2);
            } else {
          $query3="UPDATE part_qty SET qty = qty+1 WHERE  part_number = '$part_number' AND id_cabang = '$cabang' AND id_lokasi = '$lokasi' AND idjadwal_audit = '$idjadwal_audit' AND kd_lokasi_rak = '$rakbin'";
                $this->db->query($query3);
            }
        }
    }
}
/* End of file M_part.php */
