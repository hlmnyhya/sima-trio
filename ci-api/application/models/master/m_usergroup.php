<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_usergroup extends CI_Model{
    
        public function getUserGroup($id = null,$offset=null)
      {
        if ($id === null&& $offset===null) {
          $result=$this->db->get('user_group')->result();
          return $result;
        }elseif ($id === null&& $offset!==null) {
          $this->db->limit(15);
          $this->db->offset($offset);
          $result=$this->db->get('user_group')->result();
          return $result;
        }else{
          $result=$this->db->get_where('user_group',['id_usergroup'=>$id])->result();
        return $result;
        }
      }
        public function cariUserGroup($id = null)
      {
        if ($id === null) {
          return false;
        }else{
          $this->db->like('user_group',$id);
            $result=$this->db->get('user_group')->result();
          return $result;
        }
      }

      public function addUserGroup($data)
      {
          $this->db->insert('user_group',$data); 
          return $this->db->affected_rows();
      }
  
      public function editUsergroup($data,$id)
      {
          $this->db->where('id_usergroup', $id);
          $this->db->update('user_group', $data);
          return $this->db->affected_rows();
          

      }
  
      public function delUsergroup($id_usergroup)
      {
          $this->db->where('id_usergroup', $id_usergroup);
          $this->db->delete('user_group');
          return $this->db->affected_rows();
                  
      }

      public function buatkodeUserGroup()
      {
        $this->db->get('user_group');
        return $this->db->affected_rows();
      }

    }
    
    /* End of file Controllername.php */
    
?>