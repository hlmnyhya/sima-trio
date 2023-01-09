<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Config extends CI_Model {

    public function addUserConfig($data)
    {
        $result = $this->db->insert('config',$data); 
        return $result;
    }
    public function getUserConfig()
    {
        $result = $this->db->get('config')->result();
        return $result;
    }

    public function editUserCOnfig($id,$data)
      {
          $this->db->where('id', $id);
          $this->db->update('config', $data);
          return $this->db->affected_rows();
      }

}

/* End of file M_Config.php */
