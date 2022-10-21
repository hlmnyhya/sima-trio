<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Jenis_Audit extends CI_Model {

    public function getJenisAudit($id=null)
    {
        if ($id===null) {
            $result = $this->db->get('jenis_audit')->result();
            return $result;   
        }else {
            $result = $this->db->get_where('jenis_audit',['idjenis_audit'=> $id])->result();
            return $result;              
        }
    }

    public function cariJenisAudit($id = null)
      {
        if ($id === null) {
            return false;
          }else{
            $this->db->like('jenis_audit',$id);
            $result=$this->db->get('jenis_audit')->result();
            return $result;
          }
      }

    public function addJenisAudit($data)
    {
        $result = $this->db->insert('jenis_audit', $data);
        return $result;   
    }

    public function editJenisAudit($data, $id)
    {
        $this->db->where('idjenis_audit', $id);
        $this->db->update('jenis_audit', $data);
        return $this->db->affected_rows();
    }

    public function delJenisAudit($id)
    {
       $this->db->where('idjenis_audit', $id);
       $this->db->delete('jenis_audit');  
       return $this->db->affected_rows();
    }

}

/* End of file Jenis_audit.php */
?>