<?php

use GuzzleHttp\Client;

defined('BASEPATH') or exit('No direct script access allowed');

class M_Transaksi_Auditor extends CI_Model
{

    private $_client;
    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => SERVER_BASE . 'api/audit/'
        ]);
    }


    public function getUnit($cabang, $offset, $idjadwal_audit)
    {
        $respon =  $this->_client->request('GET', 'unitvalid', [
            'query' => [
                'id_cabang' => $cabang,
                'offset' => $offset,
                'idjadwal_audit' => $idjadwal_audit,
            ]
        ]);
        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {

            return $result['data'];
        } else {
            return false;
        }
    }
    public function getPartValid($cabang, $offset, $idjadwal_audit)
    {
        $respon =  $this->_client->request('GET', 'partvalid', [
            'query' => [
                'id_cabang' => $cabang,
                'offset' => $offset,
                'idjadwal_audit' => $idjadwal_audit
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {

            return $result['data'];
        } else {
            return false;
        }
    }

    public function getUnitById($id)
    {
        $respon =  $this->_client->request('GET', 'unit', [
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data']['0'];
        } else {
            return false;
        }
    }

    public function getPart()
    {
        $respon =  $this->_client->request('GET', 'part');

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }


    public function getCabang()
    {
        $respon =  $this->_client->request('GET', 'cabang');

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function getJadwalAudit($id_cabang = null)
    {
        $respon =  $this->_client->request('GET', 'jadwalaudit', [
            'query' => [
                'id' => $id_cabang,
                'jenis' => 'JA002'
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function getJadwalAuditPart($id_cabang = null)
    {
        $respon =  $this->_client->request('GET', 'jadwalaudit', [
            'query' => [
                'id' => $id_cabang,
                'jenis' => 'JA003'
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    // public function countunit()
    //   {
    //       $respon =  $this->_client->request('GET', 'countunit');

    //     $result = json_decode($respon->getBody()->getContents(),true);
    //     // var_dump($result['data'][0]);die;
    //     if ($result['status']==true) {
    //         return $result['data'];
    //     }else{
    //         return false;
    //     }
    //   }

    //   public function previewUnit($a,$b,$c,$d,$e)
    // {
    //     $respon =  $this->_client->request('GET', 'previewUnit',[
    //         'query'=>[
    //             'id_cabang' => $a,
    //             'tanggal_awal'=>$b,
    //             'tanggal_akhir'=>$c,
    //             'status'=> $d,
    //             'offset' => $e
    //         ]
    //     ]);
    //     $result = json_decode($respon->getBody()->getContents(),true);
    //     if ($result['status']==true) {
    //         return $result['data'];              
    //     }else{
    //         return false;
    //     }
    // }

    public function cetakUnit($a, $b, $c, $d)
    {
        $respon =  $this->_client->request('GET', 'cetakunit', [
            'query' => [
                'id_cabang' => $a,
                'tanggal_awal' => $b,
                'tanggal_akhir' => $c,
                'status' => $d
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function previewUnit($a, $b, $d, $e)
    {
        $respon =  $this->_client->request('GET', 'previewunit', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'status' => $d,
                'offset' => $e
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        $base = base_url();

        $output = '';
        $aksi = '';
        if ($result['status'] == true) {
            foreach ($result['data'] as $res) {

                $aksi = '
                    <a href="' . $base . 'transaksi_auditor/edit_audit?id=' . base64_encode($res['id_unit']) . '&a=' . base64_encode($res['id_lokasi']) . '&s=' . base64_encode($res['id_cabang']) . '" class="text-warning"><i class="fa fa-pencil"></i></a>
                    ';
                $e++;
                $output .= '
                    <tr>
                    <td>' . $e . '</td>
                    <td>' . $aksi . '</td>
                    <td>' . $res['no_mesin'] . '</td>
                    <td>' . $res['no_rangka'] . '</td>
                    <td>' . $res['nama_cabang'] . '</td>
                    <td>' . $res['nama_gudang'] . '</td>
                    <td>' . $res['umur_unit'] . '</td>
                    <td>' . $res['status_unit'] . '</td>
                    <!--td class="text-center">' . $res['aki'] . '</td>
                    <td class="text-center">' . $res['spion'] . '</td>
                    <td class="text-center">' . $res['helm'] . '</td>
                    <td class="text-center">' . $res['tools'] . '</td>
                    <td class="text-center">' . $res['buku_service'] . '</td-->
                    <td>' . $res['tahun'] . '</td>
                    <td>' . $res['type'] . '</td>
                    <td>' . $res['kode_item'] . '</td>
                    <!--td>' . $res['foto'] . '</td-->
                    <td>' . $res['keterangan'] . '</td>
                    <td>' . $res['is_ready'] . '</td>
                    <td>' . $res['tanggal_audit'] . '</td>
                ';
            }
        } else {
            $output .= '
                <tr><td colspan="24" class="text-center">Data not found.</td></tr>
            ';
        }
        return $output;
    }

    public function downloadunit($id, $idaudit)
    {
        $respon =  $this->_client->request('GET', 'dataunit', [
            'query' => [
                'id_cabang' => $id,
                'id_audit' => $idaudit
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function downloadpart($id, $idjadwal_audit)
    {
        $respon =  $this->_client->request('GET', 'datapart', [
            'query' => [
                'id_cabang' => $id,
                'idjadwal_audit' => $idjadwal_audit
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function countunit($a, $b, $c)
    {
        $respon =  $this->_client->request('GET', 'countunit', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'status' => $c
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }
    public function countunit1($a = null, $b = null)
    {
        $respon =  $this->_client->request('GET', 'countunit1', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }
    public function countPart1($a = null, $b = null)
    {
        $respon =  $this->_client->request('GET', 'countpart1', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }

    public function getUnitField($no_mesin)
    {
        $respon =  $this->_client->request('GET', 'fieldUnit', [
            'query' => [
                'no_mesin' => $no_mesin
            ]
        ]);


        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {

            return $result['data'];
        } else {
            return false;
        }
    }

    public function cariscanunit($id, $cabang)
    {
        $respon =  $this->_client->request('GET', 'listaud', [
            'query' => [
                'id' => $id,
                'id_cabang' => $cabang
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function caripart($id, $cabang, $idjadwal_audit)
    {
        $respon =  $this->_client->request('GET', 'listaudpart', [
            'query' => [
                'id' => $id,
                'id_cabang' => $cabang,
                'idjadwal_audit' => $idjadwal_audit
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function addScanUnit($data)
    {
        $respon =  $this->_client->request('POST', 'listaud', [
            'form_params' => $data
        ]);
        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function addunitready($data)
    {
        $respon =  $this->_client->request('POST', 'unitready', [
            'form_params' => $data
        ]);
        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function addScanPart($data)
    {
        $respon =  $this->_client->request('POST', 'listaudpart', [
            'form_params' => $data
        ]);
        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function editScanPart($data)
    {
        $respon =  $this->_client->request('PUT', 'listaudpart', [
            'form_params' => $data
        ]);
        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function editUnit($data)
    {
        $respon =  $this->_client->request('PUT', 'listaud', [
            'form_params' => $data
        ]);
        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function cek($a, $b, $c)
    {
        $respon =  $this->_client->request('GET', 'list', [
            'query' => [
                'id' => $a,
                'id_cabang' => $b,
                'idjadwal_audit' => $c
            ]
        ]);
        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function cekPart($a, $b, $c, $d, $e, $f)
    {
        $respon =  $this->_client->request('GET', 'listPart', [
            'query' => [
                'id' => $a,
                'id_cabang' => $b,
                'id_lokasi' => $d,
                'kd_lokasi_rak' => $c,
                'kondisi' => $e,
                'idjadwal_audit' => $f
            ]
        ]);
        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function counttempunit($a = null)
    {
        $respon =  $this->_client->request('GET', 'counttempunit', [
            'query' => [
                'cabang' => $a
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }
    public function counttemppart($a = null)
    {
        $respon =  $this->_client->request('GET', 'counttemppart', [
            'query' => [
                'cabang' => $a
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }

    public function getToUnit($cabang = null, $offset = null)
    {
        $respon =  $this->_client->request('GET', 'tounit', [
            'query' => [
                'id_cabang' => $cabang,
                'offset' => $offset
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {

            return $result['data'];
        } else {
            return false;
        }
    }
    public function getToPart($cabang = null, $offset = null)
    {
        $respon =  $this->_client->request('GET', 'topart', [
            'query' => [
                'id_cabang' => $cabang,
                'offset' => $offset
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {

            return $result['data'];
        } else {
            return false;
        }
    }
    public function closeaudit($id = null, $a = null)
    {

        $respon =  $this->_client->request('GET', 'auditend', [
            'query' => [
                'id_cabang' => $id,
                'idjadwal_audit' => $a
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        $data = [
            'idjadwal_audit' => $a,
            'keterangan' => 'done'
        ];
        $respon1 =  $this->_client->request('PUT', 'auditket', [
            'form_params' => $data
        ]);

        $result1 = json_decode($respon1->getBody()->getContents(), true);
        if ($result1['status'] == true) {
            if ($result['status'] == true) {
                return $result['data'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

/* End of file M_Transaksi_Auditor.php */
