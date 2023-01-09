<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Vendor extends CI_Model {

    public function getVendorPagination($id = null,$start=null)
    {
        if ($id === null) {
            $result = $this->db->get('vendor',15,$start)->result();
            return $result;  
        }else{
            $result = $this->db->get_where('vendor',['id_vendor' =>$id])->result();
            return $result;
        }
    }

    public function getVendor($id = null)
    {
        if ($id === null) {
            $result = $this->db->get('vendor')->result();
            return $result;  
        }else{
            $result = $this->db->get_where('vendor',['id_vendor' =>$id])->result();
            return $result;
        }
    }

    public function addVendor($data)
    {
        $result = $this->db->insert('vendor', $data);
        return $result;   
    }

    public function cariVendor($id = null,$offset=null)
      {
        $query ="
        SELECT a.* FROM vendor a
        WHERE a.id_vendor LIKE '%$id%'
        OR a.nama_vendor LIKE '%$id%'
        ";
        if ($offset!=null) {
            $query .="
            ORDER BY a.id_vendor ASC
            OFFSET $offset ROWS 
            FETCH NEXT 15 ROWS ONLY;
            ";

        }
        $result = $this->db->query($query);
        return $result; 
      }

    public function editVendor($data, $id)
    {
        $this->db->where('id_vendor', $id);
        $this->db->update('vendor', $data);
        return $this->db->affected_rows();

    }

    public function delVendor($idvendor)
    {
       $this->db->where('id_vendor', $idvendor);
       $this->db->delete('vendor');  
       return $this->db->affected_rows(); 
    }

}

/* End of file Jenis_Inventory.php */
?>