<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_TempPart extends CI_Model {
    public $app_db;
    public function __construct()
    {
        parent::__construct();
    }
    public function getTempPart($id=null, $id_cabang=null, $idjadwal_audit=null)
    {
       
        $this->db->select('temp_part.*,nama_cabang, nama_gudang');
        $this->db->from('temp_part');
        $this->db->join('cabang', 'temp_part.id_cabang = cabang.id_cabang', 'left');
        $this->db->join('gudang', 'temp_part.id_lokasi = gudang.kd_gudang', 'left');
        if($id_cabang != null){
            $this->db->where("temp_part.id_cabang", $id_cabang);
        }
        if($idjadwal_audit != null){
            $this->db->where("temp_part.idjadwal_audit", $idjadwal_audit);
        }
        if($id != null){
            $this->db->where("temp_part.id_part", $id);
        }
            
        $result = $this->db->get()->result();

        return $result;
        
    }

    public function getToPart($cabang =null,$offset=null)
    {
        $this->db->select('a.*,c.nama_cabang, b.nama_lokasi');
        $this->db->from('temp_part a');
        $this->db->join('lokasi b', 'a.id_lokasi = b.id_lokasi', 'left');
        $this->db->join('cabang c', 'a.id_cabang = c.id_cabang', 'left');
            if ($cabang!=null) {
            $this->db->where('a.id_cabang', $cabang);
            }
            if ($offset!=null) {
               $this->db->limit(15);
             $this->db->offset($offset); 
            }
            $result = $this->db->get()->result();
           return $result;
        }
		
	public function syncRakBin($cabang){
		$sql = "SELECT DISTINCT KD_GUDANG, KD_RAKBIN FROM master_Part_ohstock WHERE kd_dealer = '$cabang' AND (KD_RAKBIN != '' OR KD_RAKBIN!=NULL) AND row_status >= 0" ;
		$result = $this->app_db->query($sql)->result_array();
		foreach($result as $res){
			$sqlcek = "select count(1) as ada from lokasi_rak_bin where kd_lokasi_rak = '".$res['KD_RAKBIN']."'";
			$resultcek = $this->db->query($sqlcek)->result_array();
			if($resultcek[0]['ada'] == 0){
				$lokasi = explode("-",$res['KD_RAKBIN']);
				if(count($lokasi) < 2){
					$lokasi[1] = "";
				}
				$data =[
					'id_cabang' => $cabang,
					'id_lokasi' => $cabang.'-'.$res['KD_GUDANG'],
					'kd_lokasi_rak' => $res['KD_RAKBIN'],
					'kd_rak' => $lokasi[0],
					'kd_binbox' => $lokasi[1]
				];
				$this->db->insert('lokasi_rak_bin', $data);
			}
		}
	}

    public function getDataPart($cabang)
    {
        $kd_dealer = $cabang;
        $query ="SELECT * FROM TRANS_PARTSTOCK_VIEW WHERE KD_DEALER='$kd_dealer' AND (KD_RAKBIN != '' OR KD_RAKBIN!=NULL) and ID = 59 ";
        // $this->db2->limit(1);
        $result = $this->app_db->query($query)->result_array();
        return $result;
    }

    public function addTempPart($data)
    {
        $this->db->insert('temp_part', $data);
        return $this->db->affected_rows(); 
    }

}