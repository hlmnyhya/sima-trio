<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class m_laporan_audit extends CI_Model {

    public function cetakUnit($a,$b,$d)
    {
        $this->db->select('
                a.id_unit, a.no_mesin, a.no_rangka, 
                a.type, a.tahun, a.kode_item, a.umur_unit, 
                a.id_cabang, a.id_lokasi, a.spion, a.tools, a.helm,
                a.buku_service, a.aki, a.status_unit, 
                b.nama_cabang, c.nama_gudang, a.tanggal_audit
        
        ');
            $this->db->from('unit a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('gudang c', 'a.id_lokasi = c.kd_gudang', 'left');
            $this->db->where("a.idjadwal_audit", $b);
            $this->db->where('a.id_cabang', $a);
            $this->db->where('a.status_unit', $d);
            
            return $this->db->get()->result();
        
    }
    public function cetakUnitnotReady($a,$b,$d)
    {
        $this->db->select('
                a.id_unit, a.no_mesin, a.no_rangka, 
                a.type, a.tahun, a.kode_item, a.umur_unit, 
                a.id_cabang, a.id_lokasi, a.spion, a.tools, a.helm,
                a.buku_service, a.aki, a.status_unit, 
                b.nama_cabang, c.nama_gudang, a.tanggal_audit, a.is_ready
        
        ');
            $this->db->from('unit a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('gudang c', 'a.id_lokasi = c.kd_gudang', 'left');
            $this->db->where("a.idjadwal_audit", $b);
            
            $this->db->where('a.id_cabang', $a);
            $this->db->where('a.is_ready', $d);
            
            return $this->db->get()->result();
        
    }
    public function cetakLapUnit($a,$b,$c,$d)
    {
        $this->db->select('
                a.id_unit, a.no_mesin, a.no_rangka, 
                a.type, a.tahun, a.kode_item, a.umur_unit, 
                a.id_cabang, a.id_lokasi, a.spion, a.tools, a.helm,
                a.buku_service, a.aki, a.status_unit, 
                b.nama_cabang, c.nama_lokasi, a.tanggal_audit
        
        ');
            $this->db->from('unit a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('lokasi c', 'a.id_lokasi = c.id_lokasi', 'left');
            $this->db->where('a.id_cabang', $a);
            $this->db->where('a.status_unit', $d);
            $this->db->where("a.tanggal_audit BETWEEN '$b' AND '$c' OR a.tanggal_edit BETWEEN '$b' AND '$c'");
            
            
            return $this->db->get()->result();
        
    }

}

/* End of file m_laporan_audit.php */
