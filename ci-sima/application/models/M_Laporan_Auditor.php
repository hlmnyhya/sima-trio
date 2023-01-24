<?php

use GuzzleHttp\Client;

defined('BASEPATH') or exit('No direct script access allowed');

class M_Laporan_Auditor extends CI_Model
{
    private $_client;
    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => SERVER_BASE . 'api/audit/'
        ]);
    }

    public function getCabang()
    {
        $respon =  $this->_client->request('GET', 'cabang');

        $result = json_decode($respon->getBody()->getContents(), true);

        return $result['data'];
    }
    public function getCabangbyid($id)
    {
        $respon =  $this->_client->request('GET', 'cabang', [
            'query' => [
                'id' => $id
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function cetakUnit($a, $b, $d)
    {
        $respon =  $this->_client->request('GET', 'cetakunit', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
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

    public function cetakPart($a, $b, $d)
    {
        $respon =  $this->_client->request('GET', 'cetakPart', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
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

 public function cetakPartSesuai($a, $b, $d)
    {
        $respon =  $this->_client->request('GET', 'cetakPartSesuai', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'keterangan' => $d
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }


    public function cetakPartKurang($a, $b, $d)
    {
        $respon =  $this->_client->request('GET', 'cetakPartKurang', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'keterangan' => $d
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function cetakPartlebih($a, $b, $d)
    {
        $respon =  $this->_client->request('GET', 'cetakPartlebih', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'keterangan' => $d
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    // public function cetakPart($a, $b, $d)
    // {
    //     $respon =  $this->_client->request('GET', 'cetakPart', [
    //         'query' => [
    //             'id_cabang' => $a,
    //             'idjadwal_audit' => $b,
    //             'status' => $d
    //         ]
    //     ]);

    //     $result = json_decode($respon->getBody()->getContents(), true);

    //     if ($result['status'] == true) {
    //         return $result['data'];
    //     } else {
    //         return false;
    //     }
    // }
    public function cetakPartbelumditemukan($a, $b, $d)
    {
        $respon =  $this->_client->request('GET', 'cetakPartbelumditemukan', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
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

    public function cetakpartqty($a, $b, $d)
    {
        $respon =  $this->_client->request('GET', 'cetakpartqty', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'qty' => $d
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }

    public function cetakUnitNotReady($a, $b, $d)
    {
        $respon =  $this->_client->request('GET', 'cetakunitnotready', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'is_ready' => $d
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function Pdf($a, $b, $c, $d, $e)
    {
        $respon =  $this->_client->request('GET', 'previewunit', [
            'query' => [
                'id_cabang' => $a,
                'tanggal_awal' => $b,
                'tanggal_akhir' => $c,
                'status' => $d,
                'offset' => $e
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function prevAksesorisPdf($a, $b, $e)
    {
        $respon =  $this->_client->request('GET', 'aksesoris', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'offset' => $e
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function sumUnit($a)
    {
        $respon =  $this->_client->request('GET', 'qtyunit', [
            'query' => [
                'id_cabang' => $a
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function prevAksesoris($a, $b, $e)
    {
        $respon =  $this->_client->request('GET', 'aksesoris', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'offset' => $e
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        $output = '';
        if ($result['status'] == true) {
            foreach ($result['data'] as $res) {
                $respon1 =  $this->_client->request('GET', 'countaksesoris', [
                    'query' => [
                        'id_cabang' => $a,
                        'id_lokasi' => $res['id_lokasi']
                    ]
                ]);

                $result1 = json_decode($respon1->getBody()->getContents(), true);
                $jumlah = $result1['data'];
                $e++;
                $aki = $res['aki'];
                $spion = $res['spion'];
                $helm = $res['helm'];
                $tools = $res['tools'];
                $buku = $res['buku_service'];
                if ($aki == $jumlah) {
                    $aki = 0;
                } elseif ($aki > $jumlah) {
                    $aki = $aki - $jumlah;
                    $aki = '+' . $aki;
                } elseif ($aki < $jumlah) {
                    $aki = $jumlah - $aki;
                    $aki = '-' . $aki;
                }
                if ($spion == $jumlah) {
                    $spion = 0;
                } elseif ($spion > $jumlah) {
                    $spion = $spion - $jumlah;
                    $spion = '+' . $spion;
                } elseif ($spion < $jumlah) {
                    $spion = $jumlah - $spion;
                    $spion = '-' . $spion;
                }
                if ($helm == $jumlah) {
                    $helm = 0;
                } elseif ($helm > $jumlah) {
                    $helm = $helm - $jumlah;
                    $helm = '+' . $helm;
                } elseif ($helm < $jumlah) {
                    $helm = $jumlah - $helm;
                    $helm = '-' . $helm;
                }
                if ($tools == $jumlah) {
                    $tools = 0;
                } elseif ($tools > $jumlah) {
                    $tools = $tools - $jumlah;
                    $tools = '+' . $tools;
                } elseif ($tools < $jumlah) {
                    $tools = $jumlah - $tools;
                    $tools = '-' . $tools;
                }
                if ($buku == $jumlah) {
                    $buku = 0;
                } elseif ($buku > $jumlah) {
                    $buku = $buku - $jumlah;
                    $buku = '+' . $buku;
                } elseif ($buku < $jumlah) {
                    $buku = $jumlah - $buku;
                    $buku = '-' . $buku;
                }
                $output .= '
                    <tr>
                    <td>' . $e . '</td>
                    <td>' . $res['nama_gudang'] . '</td>
                    <td>' . $jumlah . '</td>
                    <td>' . $res['aki'] . '</td>
                    <td>' . $res['spion'] . '</td>
                    <td>' . $res['helm'] . '</td>
                    <td>' . $res['tools'] . '</td>
                    <td>' . $res['buku_service'] . '</td>
                    <td>' . $aki . '</td>
                    <td>' . $spion . '</td>
                    <td>' . $helm . '</td>
                    <td>' . $tools . '</td>
                    <td>' . $buku . '</td>
                    </tr>
                ';
            }
        } else {
            $output .= '
                <tr><td colspan="13" class="text-center">Data not found.</td></tr>
            ';
        }
        return $output;
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
        $output = '';
        if ($result['status'] == true) {
            foreach ($result['data'] as $res) {
                $e++;
                $output .= '
                    <tr>
                    <td>' . $e . '</td>
                    <td>' . $res['no_mesin'] . '</td>
                    <td>' . $res['no_rangka'] . '</td>
                    <td>' . $res['kode_item'] . '</td>
                    <td>' . $res['type'] . '</td>
                    <td>' . $res['umur_unit'] . '</td>
                    <td>' . $res['nama_gudang'] . '</td>
                    <td>' . $res['status_unit'] . '</td>
                    </tr>
                ';
            }
        } else {
            $output .= '
                <tr><td colspan="8" class="text-center">Data not found.</td></tr>
            ';
        }
        return $output;
    }

    public function previewUnitNotReady($a, $b, $d, $e)
    {
        $respon =  $this->_client->request('GET', 'previewunitnotready', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'is_ready' => $d,
                'offset' => $e
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        $output = '';
        if ($result['status'] == true) {
            foreach ($result['data'] as $res) {
                $e++;
                $output .= '
                    <tr>
                    <td>' . $e . '</td>
                    <td>' . $res['no_mesin'] . '</td>
                    <td>' . $res['no_rangka'] . '</td>
                    <td>' . $res['kode_item'] . '</td>
                    <td>' . $res['type'] . '</td>
                    <td>' . $res['umur_unit'] . '</td>
                    <td>' . $res['nama_gudang'] . '</td>
                    <td>' . $res['status_unit'] . '</td>
                    <td>' . $res['is_ready'] . '</td>
                    </tr>
                ';

                $output .= '
                
                <tr>
                    <th></th>
                    <th class="bg-warning"><small>Part Number</small></th>
                    <th class="bg-warning"><small>Kondisi</small></th>
                    <th class="bg-warning"><small>Penanggung jawab</small></th>
                    <th class="bg-warning"><small>Keterangan</small></th>
                    </tr>
                ';
                $respon1 =  $this->_client->request('GET', 'notready', [
                    'query' => [
                        'no_mesin' => $res['no_mesin']
                    ]
                ]);

                $result1 = json_decode($respon1->getBody()->getContents(), true);
                if ($result1['status'] == true) {
                    foreach ($result1['data'] as $r) {
                        $output .= '
                        <tr>
                        <td></td>
                        <td><small>' . $r['part_number'] . '</small></td>
                        <td><small>' . $r['kondisi'] . '</small></td>
                        <td><small>' . $r['penanggung_jawab'] . '</small></td>
                        <td><small>' . $r['keterangan'] . '</small></td>
                        </tr>
                    ';
                    }
                } else {
                    $output .= '
                <tr><td colspan="8" class="text-center">Data not found.</td></tr>
            ';
                }
            }
        } else {
            $output .= '
                <tr><td colspan="8" class="text-center">Data not found.</td></tr>
            ';
        }
        return $output;
    }

    public function countunit($a, $b, $d)
    {
        $respon =  $this->_client->request('GET', 'countunit', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'status' => $d
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }
    public function countPartValid($a, $b)
    {
        $respon =  $this->_client->request('GET', 'countpartvalid', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }
    public function aksesoriscount($a, $b)
    {
        $respon =  $this->_client->request('GET', 'aksesoriscount', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }
    public function countbelumditemukan($a, $b, $d)
    {
        $respon =  $this->_client->request('GET', 'countbelumditemukan', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'status ' => $d

            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }
    
    public function countpartlebih($a, $b, $d)
    {
        $respon =  $this->_client->request('GET', 'countpartlebih', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'keterangan' => $d

            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }

    public function countpartsesuai($a, $b, $d)
    {
        $respon =  $this->_client->request('GET', 'countpartsesuai', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'keterangan' => $d

            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }

    public function countpartqty($a, $b, $d)
    {
        $respon =  $this->_client->request('GET', 'countpartqty', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'qty' => $d

            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }

    public function countpartkurang($a, $b, $d)
    {
        $respon =  $this->_client->request('GET', 'countpartkurang', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'keterangan' => $d

            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }


    public function countunitnotready($a, $b, $d)
    {
        $respon =  $this->_client->request('GET', 'countunitnotready', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'is_ready' => $d
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }
    public function countunitvalid($a, $b)
    {
        // var_dump($a,$b,$c);die;
        $respon =  $this->_client->request('GET', 'countunitvalid', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return 0;
        }
    }
    public function auditUnit($a, $b, $d)
    {
        $respon =  $this->_client->request('GET', 'unitvalid', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'offset' => $d
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        $output = '';
        if ($result['status'] == true) {
            foreach ($result['data'] as $res) {
                $d++;
                $output .= '
                    <tr>
                    <td>' . $d . '</td>
                    <td>' . $res['no_mesin'] . '</td>
                    <td>' . $res['no_rangka'] . '</td>
                    <td>' . $res['nama_cabang'] . '</td>
                    <td>' . $res['nama_gudang'] . '</td>
                    <td>' . $res['umur_unit'] . '</td>
                    <td>' . $res['status_unit'] . '</td>
                    <td>' . $res['kode_item'] . '</td>
                    <td>' . $res['type'] . '</td>
                    <td>' . $res['keterangan'] . '</td>
                    <td>' . $res['tanggal_audit'] . '</td>
                    </tr>
                ';
            }
        } else {
            $output .= '
                <tr><td colspan="8" class="text-center">Data not found.</td></tr>
            ';
        }
        return $output;
    }
    public function auditPart($cabang, $idjadwal_audit, $start, $status)
    {
        $respon =  $this->_client->request('GET', 'previewpart2', [
            'query' => [
                'id_cabang' => $cabang,
                'idjadwal_audit' => $idjadwal_audit,
                'status' => $status,
                'offset' => $start
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        $output = '';
        if ($result['status'] == true) {
            foreach ($result['data'] as $res) {
                $start++;
                $output .= '
                    <tr>
                    <td>' . $start . '</td>
                    <td>' . $res['nama_gudang'] . '</td>
                    <td>' . $res['part_number'] . '</td>
                    <td>' . $res['deskripsi'] . '</td>
                    <td>' . $res['kd_lokasi_rak'] . '</td>
                    <td>' . $res['qty'] . '</td>
                    <td>' . $res['qty_fsk'] . '</td>
                    <td>' . $res['selisih'] . '</td>
                    <td>' . $res['harga_jual'] . '</td>
                    <td>' . $res['amount'] . '</td>
                    <td>' . $res['status'] . '</td>
                    <td>' . $res['kondisi'] . '</td>
                    <td>' . $res['keterangan'] . '</td>
                    <td>' . $res['tanggal_audit'] . '</td>
                   
                    </tr>
                ';
            }
        } else {
            $output .= '
                <tr><td colspan="8" class="text-center">Data not found.</td></tr>
            ';
        }
        return $output;
    }
    public function previewket($cabang, $idjadwal_audit, $start, $keterangan)
    {
        $respon =  $this->_client->request('GET', 'previewket', [
            'query' => [
                'id_cabang' => $cabang,
                'idjadwal_audit' => $idjadwal_audit,
                'keterangan'=> $keterangan,
                'offset' => $start
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        $output = '';
        if ($result['status'] == true) {
            foreach ($result['data'] as $res) {
                $start++;
                $output .= '
                    <tr>
                    <td>' . $start . '</td>
                    <td>' . $res['nama_gudang'] . '</td>
                    <td>' . $res['part_number'] . '</td>
                    <td>' . $res['deskripsi'] . '</td>
                    <td>' . $res['kd_lokasi_rak'] . '</td>
                    <td>' . $res['qty'] . '</td>
                    <td>' . $res['qty_fsk'] . '</td>
                    <td>' . $res['selisih'] . '</td>
                    <td>' . $res['harga_jual'] . '</td>
                    <td>' . $res['amount'] . '</td>
                    <td>' . $res['status'] . '</td>
                    <td>' . $res['kondisi'] . '</td>
                    <td>' . $res['keterangan'] . '</td>
                    <td>' . $res['tanggal_audit'] . '</td>
                   
                    </tr>
                ';
            }
        } else {
            $output .= '
                <tr><td colspan="8" class="text-center">Data not found.</td></tr>
            ';
        }
        return $output;
    }
    public function partvalid($a, $b, $d = null)
    {
        $respon =  $this->_client->request('GET', 'partvalid', [
            'query' => [
                'id_cabang' => $a,
                'idjadwal_audit' => $b,
                'offset' => $d
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
    public function auditPdf($a, $b, $d)
    {
        if ($d === null) {
            $respon =  $this->_client->request('GET', 'unitvalid', [
                'query' => [
                    'id_cabang' => $a,
                    'idjadwal_audit' => $b,
                    'offset' => null
                ]
            ]);
        } else {
            $respon =  $this->_client->request('GET', 'unitvalid', [
                'query' => [
                    'id_cabang' => $a,
                    'idjadwal_audit' => $b,
                    'offset' => $d
                ]
            ]);
        }

        $result = json_decode($respon->getBody()->getContents(), true);
        if ($result['status'] == true) {
            return $result['data'];
        } else {
            return false;
        }
    }
}

/* End of file M_Laporan_Auditor.php */
