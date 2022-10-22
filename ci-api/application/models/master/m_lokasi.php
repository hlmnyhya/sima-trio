<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Lokasi extends CI_Model {

    public function getLokasi($id = null,$offset=null)
    {
        if ($id === null && $offset==null) {
            $result = $this->db->get('lokasi')->result();
            return $result;    
        }elseif($id === null && $offset!=null) {
            $result = $this->db->get('lokasi',15,$offset)->result();
            return $result;    
        }else{
            $result = $this->db->get_where('lokasi',['id_lokasi' => $id])->result();
            return $result;              
        }
    }

    public function getGudang($id = null,$offset=null)
    {
        if ($id === null && $offset==null) {
            $result = $this->db->get('gudang')->result();
            return $result;    
        }elseif($id === null && $offset!=null) {
            $result = $this->db->get('gudang',15,$offset)->result();
            return $result;    
        }else{
            $result = $this->db->get_where('gudang',['kd_gudang' => $id])->result();
            return $result;              
        }
    }
    public function CariLokasi($id = null,$offset=null)
    {
        $query ="
        SELECT a.* FROM lokasi a
        WHERE a.id_lokasi LIKE '%$id%'
        OR a.nama_lokasi LIKE '%$id%'
        ";
        if ($offset!=null) {
            $query .="
            ORDER BY a.id_lokasi ASC
            OFFSET $offset ROWS 
            FETCH NEXT 15 ROWS ONLY;
            ";

        }
        $result = $this->db->query($query);
        return $result; 
    }

    public function CariGudang($id = null,$offset=null)
    {
        $query ="
        SELECT ccount(1) FROM gudang
        WHERE kd_gudang LIKE '%$id%'
        OR nama_gudang LIKE '%$id%'
        ";
        if ($offset!=null) {
            $query .="
            ORDER BY kd_gudang ASC
            OFFSET $offset ROWS 
            FETCH NEXT 15 ROWS ONLY;
            ";

        }
        $result = $this->db->query($query);
        return $result; 
    }

    public function addLokasi($data)
    {
        $result = $this->db->insert('lokasi', $data);
        return $result;   
    }

    public function addGudang($data)
    {
        $result = $this->db->insert('gudang', $data);
        return $result;   
    }

    public function editLokasi($data, $id)
    {
        $this->db->where('id_lokasi', $id);
        $this->db->update('lokasi', $data);
        return $this->db->affected_rows();
    }

    public function editGudang($data, $id)
    {
        $this->db->where('kd_gudang', $id);
        $this->db->update('gudang', $data);
        return $this->db->affected_rows();
    }

    public function delLokasi($id)
    {
       $this->db->where('id_Lokasi', $id);
       $this->db->delete('lokasi');
       return $this->db->affected_rows();
    }

    public function delGudang($id)
    {
       $this->db->where('kd_gudang', $id);
       $this->db->delete('gudang');
       return $this->db->affected_rows();
    }


}

/* End of file Jenis_Inventory.php */
?>