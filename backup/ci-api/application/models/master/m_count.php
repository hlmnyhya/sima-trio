<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Count extends CI_Model {
    public function CountUser()
    {
        $count = $this->db->get('user');
        
        if ($count->num_rows()>0) {
            return $count->num_rows();
        }else {
            return 0;
        }
    }
    public function Countmenuakses()
    {
        $count = $this->db->get('menu_akses');
        
        if ($count->num_rows()>0) {
            return $count->num_rows();
        }else {
            return 0;
        }
    }

    public function CountUsergroup()
    {
        $count = $this->db->get('user_group');
        
        if ($count->num_rows()>0) {
            return $count->num_rows();
        }else {
            return 0;
        }
    }

    public function CountSubInventory()
    {
        $count =$this->db->get('sub_inventory');

        if ($count->num_rows()>0) {
            return $count->num_rows();
        } else {
            return 0;
        }  
    }

    public function CountStatusInventory()
    {
        $count =$this->db->get('status_inventory');

        if ($count->num_rows()>0) {
            return $count->num_rows();
        } else {
            return 0;
        }
    }

    public function CountVendor()
    {
        $count =$this->db->get('vendor');

        if ($count->num_rows()>0) {
            return $count->num_rows();
        } else {
            return 0;
        }
    }
    public function CountCabang()
    {
        $count =$this->db->get('cabang');

        if ($count->num_rows()>0) {
            return $count->num_rows();
        } else {
            return 0;
        }
    }

    public function CountJenisAudit()
    {
        $count =$this->db->get('jenis_audit');

        if ($count->num_rows()>0) {
            return $count->num_rows();
        } else {
            return 0;
        }
    }

    public function CountJadwalAudit()
    {
		//update!!!
		$this->db->select("max(RIGHT(idjadwal_audit,5)) as max_id");
        $count =$this->db->get('jadwal_audit');

        if ($count->num_rows()>0) {
            return $count->result()[0]->max_id;
        } else {
            return 0;
        }
    }

    public function CountDataUnit($status=null,$cabang=null)
    {
        if ($status===null) {
            $count =$this->db->get_where('unit',['id_cabang' => $cabang]);

            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return 0;
            }
        }else{
            $this->db->where('status_unit', $status);
            $this->db->where('id_cabang', $cabang);
            
            $count =$this->db->get('unit');
    
            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return 0;
            }
        }
    }
    public function CountTempUnit($cabang=null)
    {
        if ($cabang ===null) {
            $count =$this->db->get('temp_unit');
        }else{
            $count =$this->db->get_where('temp_unit',['id_cabang' => $cabang]);
        }


            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return 0;
            }
        
    }
    public function CountTempPart($cabang=null)
    {
        if ($cabang ===null) {
            $count =$this->db->get('temp_part');
        }else{
            $count =$this->db->get_where('temp_part',['id_cabang' => $cabang]);
        }


            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return 0;
            }
        
    }
    public function CountLokasi()
    {
            $count =$this->db->get('lokasi');

            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return 0;
            }
        
    }

    public function CountGudang()
    {
            $count =$this->db->get('gudang');

            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return 0;
            }
        
    }


    public function CountTemptUnit()
    {
            $count =$this->db->get('temp_unit');

            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return 0;
            }
        
    }

    public function CountUnit($a,$b,$c)
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
            $this->db->where('a.id_cabang', $a);
            if($c != ""){
                $this->db->where('a.status_unit', $c);
            }
            $this->db->where("(a.idjadwal_audit = '$b')");

            $count =$this->db->get();

            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return false;
            }
        
    }
    public function CountUnitnotready($a,$b,$d)
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
            $this->db->where('a.id_cabang', $a);
            $this->db->where('a.is_ready', $d);
            $this->db->where("a.idjadwal_audit",$b);

            $count =$this->db->get();

            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return false;
            }
        
    }
    public function CountUnit1($a = null, $b = null)
    {
        $val='0';
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
            if ($a !=null) {
                $this->db->where('a.id_cabang', $a);
            }
            if ($b !=null) {
                $this->db->where('a.idjadwal_audit', $b);
            }
            // $this->db->where('a.is_audit', $val);
            
            $count =$this->db->get();

            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return false;
            }
        }
        
    public function CountPart1($a=null, $b=null)
    {
        if ($a!=null) {
            $this->db->where('a.id_cabang', $a);
            $this->db->where('a.idjadwal_audit', $b);
        }
        $count =$this->db->get('part a');

        if ($count->num_rows()>0) {
            return $count->num_rows();
        } else {
            return false;
        }
        
    }
    public function CountPerusahaan()
    {
            $count =$this->db->get('perusahaan');

            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return false;
            }
        
    }
    public function CountPartValid($a,$b)
    {
        $this->db->select('
                a.*, b.nama_cabang, c.nama_gudang
        
        ');
            $this->db->from('part a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('gudang c', 'a.id_lokasi = c.kd_gudang', 'left');
            $this->db->where('a.id_cabang', $a);
            $this->db->where('a.idjadwal_audit', $b);

            $count =$this->db->get();

            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return false;
            }
        
    }
    public function CountUnitValid($a,$b)
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
            $this->db->where('a.id_cabang', $a);
            $this->db->where('a.idjadwal_audit', $b);

            $count =$this->db->get();

            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return false;
            }
        
    }

    public function CountOffice($id = null, $cabang = null)
    {
        if($cabang !=null){
            $this->db->where('id_cabang', $cabang);
            
        }
        $count =$this->db->get('transaksi_inventory');
        if ($count->num_rows()>0) {
            return $count->num_rows();
        } else {
            return 0;
        }
    }
    public function CountAksesoris($a,$b)
    {

        $this->db->where('id_cabang', $a);
        $this->db->where('id_lokasi', $b);
        
        $count =$this->db->get('unit');

        if ($count->num_rows()>0) {
            return $count->num_rows();
        } else {
            return 0;
        }
    }
    public function Aksesoriscount($id,$b)
    {
        $this->db->select('aksesoris.*, nama_cabang, nama_lokasi ');
            $this->db->from('aksesoris');
            $this->db->join('lokasi', 'aksesoris.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->join('cabang', 'aksesoris.id_cabang = cabang.id_cabang', 'left');
            $this->db->where('aksesoris.id_cabang', $id);
            $this->db->where("aksesoris.idjadwal_audit",$b);
            $count = $this->db->get();
            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return 0;
            }
    }
    public function countjenisinv()
    {
        $count= $this->db->get('jenis_inventory');
        if ($count->num_rows()>0) {
            return $count->num_rows();
        } else {
            return 0;
        }
    }



}