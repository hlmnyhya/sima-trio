<?php

use GuzzleHttp\Client;

defined('BASEPATH') or exit('No direct script access allowed');

class M_Barcode extends CI_Model
{
    private $_client;
    public function __construct()
    {
        parent::__construct();
        $this->_client = new Client([
            'base_uri' => SERVER_BASE . 'api/audit/'
        ]);
    }

    public function getUnit($id)
    {
        $respon =  $this->_client->request('GET', 'unit', [
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
    public function getPart($id)
    {
        $respon =  $this->_client->request('GET', 'part', [
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
    public function auditPart($a, $b, $c, $d)
    {
        $respon =  $this->_client->request('GET', 'partvalid', [
            'query' => [
                'id_cabang' => $a,
                'tgl_awal' => $b,
                'tgl_akhir' => $c,
                'offset' => $d
            ]
        ]);

        $result = json_decode($respon->getBody()->getContents(), true);

        $output = '';
        if ($result['status'] == true) {
            foreach ($result['data'] as $res) {
                $aksi = '
                    <a href="' . base_url() . "gudang/cetakpart?id=" . $res['part_number'] . '" class="text-blue"> <h4><i class="fa fa-print"></i></h4></a>
                    ';
                $d++;
                $output .= '
                    <tr>
                    <td>' . $d . '</td>
                    <td class="text-center">' . $aksi . '</td>
                    <td>' . $res['nama_lokasi'] . '</td>
                    <td>' . $res['part_number'] . '</td>
                    <td>' . $res['deskripsi'] . '</td>
                    <td>' . $res['kd_lokasi_rak'] . '</td>
                    <td>' . $res['qty'] . '</td>
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
                    <a href="' . $base . "gudang/cetak?id=" . $res['id_unit'] . '" class="text-blue"> <h4><i class="fa fa-print"></i></h4></a>
                    ';
                $e++;
                $output .= '
                    <tr>
                    <td>' . $e . '</td>
                    <td class="text-center">' . $aksi . '</td>
                    <td>' . $res['no_mesin'] . '</td>
                    <td>' . $res['no_rangka'] . '</td>
                    <td>' . $res['nama_cabang'] . '</td>
                    <td>' . $res['nama_gudang'] . '</td>
                    <td>' . $res['umur_unit'] . '</td>
                    <td>' . $res['status_unit'] . '</td>
                    <td class="text-center">' . $res['aki'] . '</td>
                    <td class="text-center">' . $res['spion'] . '</td>
                    <td class="text-center">' . $res['helm'] . '</td>
                    <td class="text-center">' . $res['tools'] . '</td>
                    <td class="text-center">' . $res['buku_service'] . '</td>
                    <td>' . $res['tahun'] . '</td>
                    <td>' . $res['type'] . '</td>
                    <td>' . $res['kode_item'] . '</td>
                    <td>' . $res['foto'] . '</td>
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
}

/* End of file M_Barcode.php */
