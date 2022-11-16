<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class m_management_inventory extends CI_Model {

    public function getInv($id = null , $offset=null,$cabang = null)
    {
        if ($id===null&& $offset === null) {
            $this->db->select('
                                a.idtransaksi_inv, a.idstatus_inventory, a.idjenis_inventory, a.idsub_inventory,
                                a.nilai_awal, a.ddp, a.nilai_asset , a.nilai_total_keseluruhan, a.tahun_pembuatan,
                                a.id_vendor, a.id_lokasi, a.tanggal_barang_diterima, a.jenis_pembayaran, a.keterangan, a.stok, a.foto, a.ppn, a.merk, a.aksesoris_tambahan, a.no_mesin, a.no_rangka, a.asal_hadiah, a.ket_ppn, a.serial_number, a.uang_muka, a.cicilan_perbulan, a.tenor, a.nilai_total, b.nama_vendor, c.status_inventory, d.jenis_inventory, a.nama_pengguna, e.sub_inventory, f.nama_lokasi
                                ');
            $this->db->from('transaksi_inventory a');
            $this->db->join('vendor b', 'a.id_vendor = b.id_vendor', 'left');
            $this->db->join('status_inventory c', 'a.idstatus_inventory = c.idstatus_inventory', 'left');
            $this->db->join('jenis_inventory d', 'a.idjenis_inventory = d.idjenis_inventory', 'left');
            $this->db->join('sub_inventory e', 'a.idsub_inventory = e.idsub_inventory', 'left');
            $this->db->join('lokasi f', 'a.id_lokasi = f.id_lokasi', 'left');
            
        }elseif($id===null&& $offset !=null){
            $this->db->select('
                        a.idtransaksi_inv, a.idstatus_inventory, a.idjenis_inventory, a.idsub_inventory,
                        a.nilai_awal, a.ddp, a.nilai_asset , a.nilai_total_keseluruhan, a.tahun_pembuatan,
                        a.id_vendor, a.id_lokasi, a.tanggal_barang_diterima, a.jenis_pembayaran, a.keterangan, a.stok, a.foto, a.ppn, a.merk, a.aksesoris_tambahan, a.no_mesin, a.no_rangka, a.asal_hadiah, a.ket_ppn, a.serial_number, a.uang_muka, a.cicilan_perbulan, a.tenor, a.nilai_total, b.nama_vendor, c.status_inventory, d.jenis_inventory, a.nama_pengguna, e.sub_inventory, f.nama_lokasi
                        ');
            $this->db->from('transaksi_inventory a');
            $this->db->join('vendor b', 'a.id_vendor = b.id_vendor', 'left');
            $this->db->join('status_inventory c', 'a.idstatus_inventory = c.idstatus_inventory', 'left');
            $this->db->join('jenis_inventory d', 'a.idjenis_inventory = d.idjenis_inventory', 'left');
            $this->db->join('sub_inventory e', 'a.idsub_inventory = e.idsub_inventory', 'left');
            $this->db->join('lokasi f', 'a.id_lokasi = f.id_lokasi', 'left');
            $this->db->limit(15);
            $this->db->offset($offset);
            
        }else {
            $this->db->select('
                                transaksi_inventory.*,nama_vendor, status_inventory,
                                jenis_inventory, sub_inventory 
                                ');
            $this->db->from('transaksi_inventory');
            $this->db->join('vendor', 'vendor.id_vendor = transaksi_inventory.id_vendor', 'left');
            $this->db->join('status_inventory', 'status_inventory.idstatus_inventory = transaksi_inventory.idstatus_inventory', 'left');
            $this->db->join('jenis_inventory', 'jenis_inventory.idjenis_inventory = transaksi_inventory.idjenis_inventory', 'left');
            $this->db->join('sub_inventory', 'sub_inventory.idsub_inventory = transaksi_inventory.idsub_inventory', 'left');
            $this->db->where('idtransaksi_inv', $id);
            
        }
        if($cabang !=null){
            $this->db->where('a.id_cabang', $cabang);
            
        }
        $this->db->order_by('idtransaksi_inv', 'desc');
        $result = $this->db->get()->result();
        return $result;
        // return true;
    }

    public function addInv($data)
    {
        $this->db->insert('transaksi_inventory', $data);
        return $this->db->affected_rows();  
    }
    public function editInv($id,$data)
    {
        $this->db->where('idtransaksi_inv', $id);
        
        $this->db->update('transaksi_inventory', $data);
        return $this->db->affected_rows();  
    }
    public function delInv($id)
    {
        $this->db->where('idtransaksi_inv', $id);
        $this->db->delete('transaksi_inventory');
        return $this->db->affected_rows();
    }

    public function Cariinventory($id = null,$offset = null,$cabang = null)
    {
        
              $query="SELECT a.*, b.status_inventory, c.sub_inventory, d.jenis_inventory, e.nama_vendor, f.nama_lokasi FROM transaksi_inventory a 
              LEFT JOIN status_inventory b ON a.idstatus_inventory= b.idstatus_inventory
              LEFT JOIN sub_inventory c ON a.idsub_inventory = c.idsub_inventory 
              LEFT JOIN jenis_inventory d ON a.idjenis_inventory=d.idjenis_inventory
              LEFT JOIN vendor e ON a.id_vendor=e.id_vendor 
              LEFT JOIN lokasi f ON a.id_lokasi=f.id_lokasi  
              WHERE (a.idtransaksi_inv LIKE '%$id%' 
              OR a.aksesoris_tambahan LIKE '%$id%' 
              OR a.asal_hadiah LIKE '%$id%' 
              OR a.cicilan_perbulan LIKE '%$id%' 
              OR a.ddp LIKE '%$id%'
              OR a.id_lokasi LIKE '%$id%'
              OR a.id_vendor LIKE '%$id%'
              OR a.idjenis_inventory LIKE '%$id%'
              OR a.idstatus_inventory LIKE '%$id%'
              OR a.idsub_inventory LIKE '%$id%'
              OR a.jenis_pembayaran LIKE '%$id%'
              OR a.ket_ppn LIKE '%$id%'
              OR a.keterangan LIKE '%$id%'
              OR a.merk LIKE '%$id%'
              OR a.nama_pengguna LIKE '%$id%'
              OR a.nilai_asset LIKE '%$id%'
              OR a.nilai_awal LIKE '%$id%'
              OR a.nilai_total LIKE '%$id%'
              OR a.nilai_total_keseluruhan LIKE '%$id%'
              OR a.no_mesin LIKE '%$id%'
              OR a.no_rangka LIKE '%$id%'
              OR a.ppn LIKE '%$id%'
              OR a.serial_number LIKE '%$id%'
              OR a.stok  LIKE '%$id%'
              OR a.tahun_pembuatan LIKE '%$id%'
              OR b.status_inventory LIKE '%$id%'
              OR c.sub_inventory LIKE '%$id%'
              OR d.jenis_inventory LIKE '%$id%'
              OR e.nama_vendor LIKE '%$id%'
              OR f.nama_lokasi LIKE '%$id%')";
                if ($cabang != null) {
                    $query.="
                    AND a.id_lokasi = '$cabang'
                    ";
                }
              if ($offset!=null) {
                $query .="
                ORDER BY a.idtransaksi_inv ASC
                OFFSET $offset ROWS 
                FETCH NEXT 15 ROWS ONLY;
                ";
              }
        $result = $this->db->query($query);
        return $result;              
    }

    

}

/* End of file m_management_inventory.php */
