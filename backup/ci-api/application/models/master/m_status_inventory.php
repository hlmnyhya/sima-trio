<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Status_Inventory extends CI_Model {

    public function getStatusInv($id= null)
    {
        if ($id===null) {
            $result = $this->db->get('status_inventory')->result();
            return $result;              
        }else {
            $result = $this->db->get_where('status_inventory',['idstatus_inventory' => $id])->result();
            return $result;               
        }
    }

    public function cariStatusInv($id = null)
      {
        if ($id === null) {
            return false;
          }else{
        $this->db->like('status_inventory',$id);
          $result=$this->db->get('status_inventory')->result();
        return $result;
          }
      }
      
    public function addStatusInv($data)
    {
        $this->db->insert('status_inventory',$data); 
          return $this->db->affected_rows();   
    }

    public function editStatusInv($data,$id)
    {

        $this->db->where('idstatus_inventory', $id);
        $this->db->update('status_inventory', $data);
        return $this->db->affected_rows();
    }

    public function delStatusInv($id)
    {
       $this->db->where('idstatus_inventory', $id);
       $this->db->delete('status_inventory');  
       return $this->db->affected_rows();
    }

}

/* End of file status_inventory.php */
?>