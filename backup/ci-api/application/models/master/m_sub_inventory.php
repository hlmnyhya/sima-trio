<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class M_Sub_Inventory extends CI_Model {

    public function getSubInv($id = null,$offset=null)
    {
        if ($id===null) {
            $this->db->select('sub_inventory.*, jenis_inventory');
            $this->db->from('sub_inventory');
            $this->db->join('jenis_inventory', 'sub_inventory.idjenis_inventory = jenis_inventory.idjenis_inventory', 'left');
        }else {
            $this->db->select('sub_inventory.*, jenis_inventory');
            $this->db->from('sub_inventory');
            $this->db->join('jenis_inventory', 'sub_inventory.idjenis_inventory = jenis_inventory.idjenis_inventory', 'left');
            $this->db->where('idsub_inventory', $id);
            
            
        }
        if ($offset!=null) {
            $this->db->limit(15);
            $this->db->offset($offset);
        }
        $result = $this->db->get()->result();
        return $result;
    }
    public function CariSubInv2($id=null,$offset=null)
    {
        $query ="
        SELECT a.idsub_inventory,a.idjenis_inventory,a.idsub_inventory, b.jenis_inventory,a.sub_inventory
        FROM sub_inventory a
        LEFT JOIN jenis_inventory b ON a.idjenis_inventory=b.idjenis_inventory
        WHERE a.idsub_inventory LIKE '%$id%'
        OR b.jenis_inventory LIKE '%$id%'
        OR a.sub_inventory LIKE '%$id%'
        ";
        if ($offset!=null) {
            $query .="
            ORDER BY a.idsub_inventory ASC
            OFFSET $offset ROWS 
            FETCH NEXT 15 ROWS ONLY;
            ";

        }
        $result = $this->db->query($query);
        return $result;
    }
    public function getSubJenisInv($id = null)
    {
            $this->db->select('sub_inventory.*, jenis_inventory');
            $this->db->from('sub_inventory');
            $this->db->join('jenis_inventory', 'sub_inventory.idjenis_inventory = jenis_inventory.idjenis_inventory', 'left');
            $this->db->where('sub_inventory.idjenis_inventory', $id);
            
            $result = $this->db->get()->result();
            return $result;
    }

    public function cariSubinv($subinv=null, $jenisinv=null)
    {
        if ($subinv!=null && $jenisinv !=null) {
            $this->db->select('sub_inventory.*, jenis_inventory');
            $this->db->from('sub_inventory');
            $this->db->join('jenis_inventory', 'sub_inventory.idjenis_inventory = jenis_inventory.idjenis_inventory', 'left');
            $this->db->like('sub_inventory', $subinv);
            $this->db->like('jenis_inventory.idjenis_inventory', $jenisinv);
            $result = $this->db->get()->result();
            return $result;
        }elseif ($subinv!=null && $jenisinv==null) {
            $this->db->select('sub_inventory.*, jenis_inventory');
            $this->db->from('sub_inventory');
            $this->db->join('jenis_inventory', 'sub_inventory.idjenis_inventory = jenis_inventory.idjenis_inventory', 'left');
            $this->db->like('sub_inventory', $subinv);
            
            $result = $this->db->get()->result();
            return $result;
            
        }elseif ($subinv==null && $jenisinv!=null) {
            $this->db->select('sub_inventory.*, jenis_inventory');
            $this->db->from('sub_inventory');
            $this->db->join('jenis_inventory', 'sub_inventory.idjenis_inventory = jenis_inventory.idjenis_inventory', 'left');
            $this->db->like('jenis_inventory.idjenis_inventory', $jenisinv);
            $result = $this->db->get()->result();
            return $result;
            
        }
        
    }

    public function getSubInvByJenis($id)
    {
        $this->db->where('idjenis_inventory', $id);
        
        $result = $this->db->get('sub_inventory')->result();
        return $result;
    }

    public function getJenisInv()
    {
        $result = $this->db->get('jenis_inventory')->result();
        return $result;     
    }

    public function addSubInv($data)
    {
        $result=$this->db->insert('sub_inventory', $data);  
        return $result;  
    }

    public function editSubInv($data,$id)
    {
            $this->db->where('idsub_inventory', $id);
            $this->db->update('sub_inventory', $data);
            return $this->db->affected_rows();
    }

    public function delSubInv($id)
    {
        $this->db->where('idsub_inventory', $id);
        $this->db->delete('sub_inventory');    
        return $this->db->affected_rows();
    }

    public function buatkodeSubInventory()
      {
        $this->db->get('sub_inventory');
        return $this->db->affected_rows();
      }

}

/* End of file Sub_Inventory.php */

?>