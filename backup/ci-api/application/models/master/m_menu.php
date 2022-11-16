<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Menu extends CI_Model {

    public function getMenu($access=null)
    {
        if ($access === null) {
            $result = $this->db->get('menu')->result();

        }else {
            $this->db->select('menu.*, menu_akses.*');
            
            $this->db->from('menu');
            $this->db->join('menu_akses', 'menu_akses.id_menu = menu.id_menu', 'left');
            $this->db->where("menu.in_aktif ='1'");
            
            $this->db->where('menu_akses.id_usergroup', $access);
            $this->db->order_by('menu.id_menu', 'asc');
            
            
            $result =$this->db->get()->result();
            
        }

        return $result;
    }

    public function getSubMenu($id = null)
    {
        $ac=1;
        if ($id === null) {
            $result = $this->db->get('sub_menu')->result();

        }else {
            $result = $this->db->get_where('sub_menu',['id_menu' => $id, 'in_aktif' => $ac])->result();
        }

        return $result;
    }
    public function getMenuAkses($id = null, $ug = null)
    {
        $this->db->select(' a.*, b.user_group, c.menu');
        $this->db->from('menu_akses a');
        $this->db->join('user_group b', 'a.id_usergroup = b.id_usergroup', 'left');
        $this->db->join('menu c', 'a.id_menu = c.id_menu', 'left');
        
        if ($ug!=null) {
            $this->db->where('a.id_usergroup', $ug);
        }

        if ($id!=null) {
            $this->db->where('a.id_menu', $id);
        }
        
        $result = $this->db->get()->result();

        return $result;
    }
    public function cariMenuakses($id=null, $offset=null)
    {
        $query="
            SELECT a.*, b.user_group, c.menu FROM menu_akses a
            LEFT JOIN user_group b ON a.id_usergroup=b.id_usergroup
            LEFT JOIN menu c ON a.id_menu=c.id_menu
            WHERE a.id_usergroup LIKE '%$id%'
            
        ";
        if ($offset!=null) {
            $query .="
            ORDER BY a.id_menu_akses ASC
            OFFSET $offset ROWS 
            FETCH NEXT 15 ROWS ONLY;
            ";
        }
        
            $result = $this->db->query($query);
            return $result;
        
    }
    public function delMenuAkses($id)
    {
       $this->db->where('id_menu_akses', $id);
       $this->db->delete('menu_akses');
       return $this->db->affected_rows();
    }
    public function addMenuAkses($data)
    {
       $this->db->insert('menu_akses',$data );
       return $this->db->affected_rows();
    }
}

/* End of file M_Menu.php */

?>