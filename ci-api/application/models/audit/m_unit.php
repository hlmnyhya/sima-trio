<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_Unit extends CI_Model {

    public function getUnit($id=null, $offset=null)
    {
        if ($id === null) {
            $this->db->select('unit.*,nama_cabang, nama_gudang');
            $this->db->from('unit');
            $this->db->join('cabang', 'unit.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('gudang', 'unit.id_lokasi = gudang.kd_gudang', 'left');
            $this->db->limit(15);
            $this->db->offset($offset);

            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('unit.*,nama_cabang, nama_gudang');
            $this->db->from('unit');
            $this->db->join('cabang', 'unit.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('gudang', 'unit.id_lokasi = gudang.kd_gudang', 'left');
            $this->db->where('unit.id_unit',$id);



            $result = $this->db->get()->result();

            return $result;
        }

    }
    public function getUnitValid($id=null, $offset=null,$tgl_awal=null, $tgl_akhir=null, $idjadwal_audit = null)
    {
        $this->db->select("unit.*,nama_cabang, nama_gudang");
        $this->db->from('unit');
        $this->db->join('cabang', 'unit.id_cabang = cabang.id_cabang', 'left');
        $this->db->join('gudang', 'unit.id_lokasi = gudang.kd_gudang', 'left');
        if ($id!=null) {
            $this->db->where('unit.id_cabang',$id);
        }
        if ($tgl_awal!=null) {
            $this->db->where("unit.tanggal_audit BETWEEN '$tgl_awal' AND '$tgl_akhir'");
        }
        if ($offset!=null) {
            $this->db->limit(15);
            $this->db->offset($offset);
        }
        if($idjadwal_audit != null){
            $this->db->where('unit.idjadwal_audit',$idjadwal_audit);
        }
        $result = $this->db->get()->result();

        return $result;
        // $this->db->where("is_audit = '0'");
        // if ($id === null) {
        //     $this->db->select('unit.*,nama_cabang, nama_lokasi');
        //     $this->db->from('unit');
        //     $this->db->join('cabang', 'unit.id_cabang = cabang.id_cabang', 'left');
        //     $this->db->join('lokasi', 'unit.id_lokasi = lokasi.id_lokasi', 'left');
        //     // $this->db->where("is_audit = '0'");

        //     $this->db->limit(15);
        //     $this->db->offset($offset);

        //     $result = $this->db->get()->result();

        //     return $result;
        // }elseif($id!=null && $tgl_awal==null) {
        //     $this->db->select('unit.*,nama_cabang, nama_lokasi');
        //     $this->db->from('unit');
        //     $this->db->join('cabang', 'unit.id_cabang = cabang.id_cabang', 'left');
        //     $this->db->join('lokasi', 'unit.id_lokasi = lokasi.id_lokasi', 'left');
        //     $this->db->limit(15);
        //     $this->db->offset($offset);
        //     // $this->db->where("is_audit = '0'");
        //     $this->db->where('unit.id_cabang',$id);

        //     $result = $this->db->get()->result();

        //     return $result;
        // }elseif($id!=null && $tgl_awal!=null&&$offset==null){
        //     $this->db->select('unit.*,nama_cabang, nama_lokasi');
        //     $this->db->from('unit');
        //     $this->db->join('cabang', 'unit.id_cabang = cabang.id_cabang', 'left');
        //     $this->db->join('lokasi', 'unit.id_lokasi = lokasi.id_lokasi', 'left');
        //     // $this->db->where("is_audit = '0'");
        //     $this->db->where('unit.id_cabang',$id);
        //     $this->db->where("unit.tanggal_audit BETWEEN '$tgl_awal' AND '$tgl_akhir'");

        //     $result = $this->db->get()->result();

        //     return $result;
        // }elseif($id!=null && $tgl_awal!=null) {
        //     $this->db->select('unit.*,nama_cabang, nama_lokasi');
        //     $this->db->from('unit');
        //     $this->db->join('cabang', 'unit.id_cabang = cabang.id_cabang', 'left');
        //     $this->db->join('lokasi', 'unit.id_lokasi = lokasi.id_lokasi', 'left');
        //     $this->db->limit(15);
        //     $this->db->offset($offset);
        //     // $this->db->where("is_audit = '0'");
        //     $this->db->where('unit.id_cabang',$id);
        //     $this->db->where("unit.tanggal_audit BETWEEN '$tgl_awal' AND '$tgl_akhir'");

        //     $result = $this->db->get()->result();

        //     return $result;
        // }

    }
    public function getUnitReady($id = null, $cabang= null)
    {
        if ($id===null) {
            $this->db->select('a.no_mesin, a.no_rangka, a.part_number, a.kondisi, a.keterangan, a.penanggung_jawab');
            $this->db->from('unit_ready a');

            $this->db->where('a.id_cabang', $cabang);
            $result = $this->db->get()->result();
            return $result;
        }else{
            $this->db->select('a.no_mesin, a.no_rangka, a.part_number, a.kondisi, a.keterangan, a.penanggung_jawab');
            $this->db->from('unit_ready a');
            $this->db->where('a.id_cabang', $cabang);
            $this->db->where("a.no_mesin LIKE '%$id%' OR a.no_rangka LIKE '%$id%' OR a.part_number LIKE '%$id%'");
            $result = $this->db->get()->result();
            return $result;
        }
    }

    public function addUnitReady($data)
    {
        $this->db->insert('unit_ready', $data);
        return $this->db->affected_rows();
    }

    public function getCariUnitNrfs($id =null, $cabang = null)
    {
        if ($id === null) {
            $this->db->select('a.no_mesin, a.no_rangka, a.part_number, a.kondisi, a.penanggung_jawab, a.keterangan, a.id_cabang, a.id_lokasi ');
            $this->db->from('unit_ready a');
            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('a.no_mesin, a.no_rangka, a.part_number, a.kondisi, a.penanggung_jawab, a.keterangan, a.id_cabang, a.id_lokasi ');
            $this->db->from('unit_ready a');
            $this->db->where("a.no_mesin LIKE '%$id%' OR a.no_rangka LIKE '%$id%' OR a.part_number LIKE '%$id%' AND a.id_cabang='$cabang'");

            $result = $this->db->get()->result();

            return $result;
        }
    }

    public function previewUnit($a,$b,$d,$e)
    {
        $this->db->select('
                a.id_unit, a.no_mesin, a.no_rangka,
                a.type, a.tahun, a.kode_item, a.umur_unit,
                a.id_cabang, a.id_lokasi, a.spion, a.tools, a.helm,
                a.buku_service, a.aki, a.status_unit,
                b.nama_cabang, c.nama_gudang, a.tanggal_audit, a.foto,
                a.keterangan, a.is_ready

        ');
            $this->db->from('unit a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('gudang c', 'a.id_lokasi = c.kd_gudang', 'left');

            $this->db->where("a.id_cabang='$a' AND a.idjadwal_audit = '$b' ");
            if($d != ""){
                $this->db->where('a.status_unit', $d);
            }
            $this->db->limit(15);
            $this->db->offset($e);

            return $this->db->get()->result();

    }
    public function previewUnitNotReady($a,$b,$d,$e)
    {
        $this->db->select('
                a.id_unit, a.no_mesin, a.no_rangka,
                a.type, a.tahun, a.kode_item, a.umur_unit,
                a.id_cabang, a.id_lokasi, a.spion, a.tools, a.helm,
                a.buku_service, a.aki, a.status_unit,
                b.nama_cabang, c.nama_gudang, a.tanggal_audit, a.foto,
                a.keterangan, a.is_ready

        ');
            $this->db->from('unit a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('gudang c', 'a.id_lokasi = c.kd_gudang', 'left');
            $this->db->where("a.id_cabang='$a'AND a.is_ready='$d' AND a.idjadwal_audit= '$b'");
            $this->db->limit(15);
            $this->db->offset($e);

            return $this->db->get()->result();

    }

    public function notready($a)
    {
        $this->db->where('no_mesin', $a);

        return $this->db->get('unit_ready') ->result();

    }

}

/* End of file M_Unit.php */
