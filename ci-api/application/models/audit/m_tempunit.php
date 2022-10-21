<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_TempUnit extends CI_Model {
    public $app_db;
    public $db2;
    public function __construct()
    {
        parent::__construct();
    }
    public function getDataUnit($cabang)
    {
        $kd_dealer = $cabang;
        // $query = "
                    // SELECT a.no_mesin, a.no_rangka, a.kd_item, a.sub_kategori, a.kd_dealer, a.kd_gudang, b.THN_PERAKITAN, c.NAMA_GUDANG , C.ALAMAT as ALAMAT_GUDANG, d.ksu
                    // FROM TRANS_STOCKMOTOR a
                    // LEFT JOIN TRANS_SJMASUK b ON b.NO_MESIN = a.NO_MESIN
                    // LEFT JOIN MASTER_GUDANG c ON c.KD_GUDANG = a.KD_GUDANG
                    // LEFT JOIN trans_terimasjmotor d on d.no_mesin = a.no_mesin
                    // WHERE a.STOCK_AKHIR=1 AND a.KD_DEALER ='$kd_dealer'
        // ";
        // $query ="
        //         SELECT a.no_mesin, a.no_rangka, a.kd_item, a.sub_kategori, a.kd_dealer, a.kd_gudang, b.THN_PERAKITAN, c.NAMA_GUDANG , C.ALAMAT as ALAMAT_GUDANG, d.ksu
        //         FROM TRANS_STOCKMOTOR a
        //         LEFT JOIN TRANS_SJMASUK b ON b.NO_MESIN = a.NO_MESIN
        //         LEFT JOIN (SELECT KD_DEALER, KD_GUDANG, NAMA_GUDANG, ALAMAT FROM MASTER_GUDANG WHERE JENIS_GUDANG LIKE '%Unit%' 
        //         AND ROW_STATUS >=0 AND KD_DEALER='$kd_dealer' AND defaults=1) c ON c.KD_GUDANG= a.KD_GUDANG
        //         LEFT JOIN trans_terimasjmotor d on d.no_mesin = a.no_mesin and d.ROW_STATUS >=0 
        //         WHERE a.STOCK_AKHIR >=1 and a.KD_DEALER = '$kd_dealer' and a.ROW_STATUS >=0 
        //         ORDER BY a.THN_PERAKITAN

        // ";
        $query ="
                SELECT a.no_mesin, a.no_rangka, a.kd_item, a.sub_kategori, a.kd_dealer, concat(a.kd_dealer,'-',a.kd_gudang) as kd_gudang, b.THN_PERAKITAN, d.ksu
                FROM TRANS_STOCKMOTOR a
                LEFT JOIN TRANS_SJMASUK b ON b.NO_MESIN = a.NO_MESIN
                LEFT JOIN trans_terimasjmotor d on d.no_mesin = a.no_mesin and d.ROW_STATUS >=0 
                WHERE a.STOCK_AKHIR >=1 and a.KD_DEALER = '$kd_dealer' and a.ROW_STATUS >=0 
                ORDER BY a.no_mesin

        ";
        // $this->db2->limit(1);
        $result = $this->app_db->query($query)->result_array();
        return $result;
    }

    public function addTempUnit($data)
    {
        $this->db->insert('temp_unit', $data);
        return $this->db->affected_rows(); 
    }
    
    public function SyncGudang1($cabang){
        $sql = "SELECT concat(kd_dealer,'-',KD_GUDANG) as KD_GUDANG, NAMA_GUDANG, ALAMAT, JENIS_GUDANG FROM MASTER_GUDANG WHERE KD_DEALER = '".$cabang."' AND ROW_STATUS >= 0" ;
		$result = $this->app_db->query($sql)->result_array();
		foreach($result as $res){
			$sqlcek = "select count(1) as ada from gudang where kd_gudang = '".$res['KD_GUDANG']."'";
			$resultcek = $this->db->query($sqlcek)->result_array();
			if($resultcek[0]['ada'] == 0){
				$data =[
					'kd_gudang' => $res['KD_GUDANG'],
					'nama_gudang' => $res['NAMA_GUDANG'],
					'alamat' => $res['ALAMAT'],
					'jenis_gudang' => $res['JENIS_GUDANG']
				];
				$this->db->insert('gudang', $data);
			}
		}
    }

    public function SyncGudang2($cabang){
        $sql = "SELECT distinct CONCAT(a.KD_DEALER,'-',a.KD_GUDANG) as KD_GUDANG, '-' as NAMA_GUDANG, '-' AS ALAMAT, '-' AS JENIS_GUDANG from TRANS_STOCKMOTOR a LEFT JOIN TRANS_SJMASUK b ON b.NO_MESIN = a.NO_MESIN LEFT JOIN trans_terimasjmotor d on d.no_mesin = a.no_mesin and d.ROW_STATUS >=0 WHERE a.STOCK_AKHIR >=1 and a.KD_DEALER = '".$cabang."' and a.ROW_STATUS >=0 AND a.KD_GUDANG <> ''" ;
		$result = $this->app_db->query($sql)->result_array();
		foreach($result as $res){
			$sqlcek = "select count(1) as ada from gudang where kd_gudang = '".$res['KD_GUDANG']."'";
			$resultcek = $this->db->query($sqlcek)->result_array();
			if($resultcek[0]['ada'] == 0){
				$data =[
					'kd_gudang' => $res['KD_GUDANG'],
					'nama_gudang' => $res['NAMA_GUDANG'],
					'alamat' => $res['ALAMAT'],
					'jenis_gudang' => $res['JENIS_GUDANG']
				];
				$this->db->insert('gudang', $data);
			}
		}
    }

    public function getTempUnit($id=null, $cabang=null, $offset=null)
    {
        
        $this->db->select('a.id_unit, a.no_mesin, a.no_rangka, a.type, a.tahun, a.kode_item, a.id_cabang, a.id_lokasi, b.nama_cabang, c.nama_gudang');
        $this->db->from('temp_unit a');
        $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
        $this->db->join('gudang c', 'a.id_lokasi = c.kd_gudang', 'left');
        
        if ($cabang!= null) {
            $this->db->where('a.id_cabang', $cabang);
        }
        if ($id!=null) {
            $this->db->where(" a.no_mesin = '$id' OR a.no_rangka = '$id' AND a.id_cabang ='$cabang'");
        }
        if ($offset!=null) {
            $this->db->limit(15);
            $this->db->offset($offset);
        }
        $result = $this->db->get()->result();

        return $result;
        
    }
    public function getToUnit($cabang =null,$offset=null)
    {
        if ($cabang === null) {
            $this->db->select('a.id_unit,a.no_mesin, a.no_rangka, a.tahun, a.type, a.kode_item, a.id_cabang, a.id_lokasi , b.nama_gudang, c.nama_cabang');
            $this->db->from('temp_unit a');
            $this->db->join('gudang b', 'a.id_lokasi = b.kd_gudang', 'left');
            $this->db->join('cabang c', 'a.id_cabang = c.id_cabang', 'left');
             $this->db->limit(15);
             $this->db->offset($offset);
            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('a.id_unit,a.no_mesin, a.no_rangka, a.tahun, a.type, a.kode_item, a.id_cabang, a.id_lokasi , b.nama_gudang, c.nama_cabang');
            $this->db->from('temp_unit a');
            $this->db->join('gudang b', 'a.id_lokasi = b.kd_gudang', 'left');
            $this->db->join('cabang c', 'a.id_cabang = c.id_cabang', 'left');
            $this->db->where('a.id_cabang', $cabang);
            $this->db->limit(15);
             $this->db->offset($offset);
            $result = $this->db->get()->result();

            return $result;
        }
    }
    public function getCariUnit($id =null, $cabang = null)
    {
        if ($id === null) {
            $this->db->select('a.id_unit,a.no_mesin, a.no_rangka, a.tahun, a.type, a.kode_item, a.id_cabang, a.id_lokasi , b.nama_gudang, c.nama_cabang');
            $this->db->from('temp_unit a');
            $this->db->join('gudang b', 'a.id_lokasi = b.kd_gudang', 'left');
            $this->db->join('cabang c', 'a.id_cabang = c.id_cabang', 'left');
             
            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('a.id_unit,a.no_mesin, a.no_rangka, a.tahun, a.type, a.kode_item, a.id_cabang, a.id_lokasi , b.nama_gudang, c.nama_cabang');
            $this->db->from('temp_unit a');
            $this->db->join('gudang b', 'a.id_lokasi = b.kd_gudang', 'left');
            $this->db->join('cabang c', 'a.id_cabang = c.id_cabang', 'left');
            $this->db->where("b.nama_gudang LIKE '%$id%' OR c.nama_cabang LIKE '%$id%' OR a.no_mesin LIKE '%$id%' OR a.no_rangka LIKE '%$id%' AND a.id_cabang='$cabang'");
            
            $result = $this->db->get()->result();

            return $result;
        }
    }
}