<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Cabang extends CI_Model {

    public function getCabang($id = null,$offset=null)
    {
        if ($id === null&& $offset===null) {

            $result = $this->db->get('cabang')->result();
            return $result;    
        }elseif ($id===null&& $offset!=null){
            $result = $this->db->get('cabang',15,$offset)->result();
            return $result;    
        }else{

            $result = $this->db->get_where('cabang',['id_Cabang' => $id])->result();
            return $result;              
        }
    }

    public function getJadwalAudit($id = null,$offset=null, $jenis = null)
    {
        if($jenis != null){
            $this->db->where('idjenis_audit',$jenis);
        }
        if ($id === null&& $offset===null) {
            $this->db->order_by('idjadwal_audit', 'DESC');
            //$this->db->where('keterangan','done');
            $result = $this->db->get('jadwal_audit')->result();
            return $result;    
        }elseif ($id===null&& $offset!=null){
            $this->db->order_by('idjadwal_audit', 'DESC');
            //$this->db->where('keterangan','done');
            $result = $this->db->get('jadwal_audit',15,$offset)->result();
            return $result;    
        }else{
            $this->db->order_by('idjadwal_audit', 'DESC');
            //$this->db->where('keterangan','done');
            $result = $this->db->get_where('jadwal_audit',['id_cabang' => $id])->result();
            return $result;              
        }
    }

    public function CariCabang($id = null, $offset=null)
    {
        $query ="
        SELECT a.* FROM cabang a
        WHERE a.id_cabang LIKE '%$id%'
        OR a.nama_cabang LIKE '%$id%'
        ";
        if ($offset!=null) {
            $query .="
            ORDER BY a.id_cabang ASC
            OFFSET $offset ROWS 
            FETCH NEXT 15 ROWS ONLY;
            ";

        }
        $result = $this->db->query($query);
        return $result;            
    }

    public function addCabang($data)
    {
        $result = $this->db->insert('cabang', $data);
        return $result;   
    }

    public function editCabang($data, $id)
    {
        $this->db->where('id_cabang', $id);
        $this->db->update('cabang', $data);
        return $this->db->affected_rows();
    }

    public function delCabang($id)
    {
       $this->db->where('id_cabang', $id);
       $this->db->delete('cabang');
       return $this->db->affected_rows();
    }


}

/* End of file Jenis_Inventory.php */
?>