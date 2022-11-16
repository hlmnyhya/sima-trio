<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Jenis_Inventory extends CI_Model {

    public function getJenisInv($id= null,$offset = null)
    {
        if ($id===null&&$offset===null) {
            $result = $this->db->get('jenis_inventory')->result();
            return $result;              
        }elseif ($id===null&&$offset!=null){
        $result = $this->db->get('jenis_inventory',15,$offset)->result();
            return $result; 
        }else {
            $result = $this->db->get_where('jenis_inventory',['idjenis_inventory' => $id])->result();
            return $result;               
        }
    }

    public function cariJenisInv($id = null)
      {
        if ($id === null) {
            return false;
          }else{
          $this->db->like('jenis_inventory',$id);
          $result=$this->db->get('jenis_inventory')->result();
          return $result;
          }
      }
      
    public function addJenisInv($data)
    {
        $this->db->insert('jenis_inventory',$data); 
          return $this->db->affected_rows();   
    }

    public function editJenisInv($data,$id)
    {

        $this->db->where('idjenis_inventory', $id);
        $this->db->update('jenis_inventory', $data);
        return $this->db->affected_rows();
    }

    public function delJenisInv($id)
    {
       $this->db->where('idjenis_inventory', $id);
       $this->db->delete('jenis_inventory');  
       return $this->db->affected_rows();
    }

    


}

/* End of file Jenis_Inventory.php */
?>