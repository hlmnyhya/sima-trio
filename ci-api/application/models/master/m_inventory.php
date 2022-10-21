<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Inventory extends CI_Model {
    public function getInv($id = null)
    {
        if ($id === null) {
            $result = $this->db->get('transaksi_inventory')->result();
            return $result;    
        }else{
            $result = $this->db->get_where('transakasi_inventory',['idtransaksi_inv' => $id])->result();
            return $result;              
        }
    }
    public function Cariinventory($id = null)
    {
        if ($id === null) {
            $query="SELECT a.*, b.status_inventory, c.sub_inventory, d.jenis_inventory, e.nama_vendor, f.nama_lokasi FROM transaksi_inventory a 
              LEFT JOIN status_inventory b ON a.idstatus_inventory= b.idstatus_inventory
              LEFT JOIN sub_inventory c ON a.idstatus_inventory = c.idsub_inventory 
              LEFT JOIN jenis_inventory d ON a.idjenis_inventory=d.idjenis_inventory
              LEFT JOIN vendor e ON a.id_vendor=e.id_vendor 
              LEFT JOIN lokasi f ON a.id_lokasi=f.id_lokasi";
            // $result = $this->db->query($query)->result();
          }else{
              $query="SELECT a.*, b.status_inventory, c.sub_inventory, d.jenis_inventory, e.nama_vendor, f.nama_lokasi FROM transaksi_inventory a 
              LEFT JOIN status_inventory b ON a.idstatus_inventory= b.idstatus_inventory
              LEFT JOIN sub_inventory c ON a.idstatus_inventory = c.idsub_inventory 
              LEFT JOIN jenis_inventory d ON a.idjenis_inventory=d.idjenis_inventory
              LEFT JOIN vendor e ON a.id_vendor=e.id_vendor 
              LEFT JOIN lokasi f ON a.id_lokasi=f.id_lokasi  
              WHERE a.idtransaksi_inv LIKE '$id' 
              OR a.aksesoris_tambahan LIKE '$id' 
              OR a.asal_hadiah LIKE '$id' 
              OR a.cicilan_perbulan LIKE '$id' 
              OR a.ddp LIKE '$id'
              OR a.id_lokasi LIKE '$id'
              OR a.id_vendor LIKE '$id'
              OR a.idjenis_inventory LIKE '$id'
              OR a.idstatus_inventory LIKE '$id'
              OR a.idsub_inventory LIKE '$id'
              OR a.jenis_pembayaran LIKE '$id'
              OR a.ket_ppn LIKE '$id'
              OR a.keterangan LIKE '$id'
              OR a.merk LIKE '$id'
              OR a.nama_pengguna LIKE '$id'
              OR a.nilai_asset LIKE '$id'
              OR a.nilai_awal LIKE '$id'
              OR a.nilai_total LIKE '$id'
              OR a.nilai_total_keseluruhan LIKE '$id'
              OR a.no_mesin LIKE '$id'
              OR a.no_rangka LIKE '$id'
              OR a.ppn LIKE '$id'
              OR a.serial_number LIKE '$id'
              OR a.stok  LIKE '$id'
              OR a.tahun_pembuatan LIKE '$id'
              OR b.status_inventory LIKE '$id'
              OR c.sub_inventory LIKE '$id'
              OR d.jenis_inventory LIKE '$id'
              OR e.nama_vendor LIKE '$id'
              OR f.nama_lokasi LIKE '$id'";
        }
        $result = $this->db->query($query)->result();
        return $result;              
    }

    public function addinventory($data)
    {
        $result = $this->db->insert('transaksi_inventory', $data);
        return $result;   
    }

    public function editinventory($data, $id)
    {
        $this->db->where('idtransaksi_inv', $id);
        $this->db->update('transaksi_inventory', $data);
        return $this->db->affected_rows();
    }

    public function delinventory($id)
    {
       $this->db->where('idtransaksi_inv', $id);
       $this->db->delete('transaksi_inventory');
       return $this->db->affected_rows();
    }

    

}

/* End of file M_Inventory.php */


?>