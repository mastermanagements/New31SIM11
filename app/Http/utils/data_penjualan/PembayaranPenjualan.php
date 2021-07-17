<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 15/07/2021
 * Time: 09:04
 */

namespace App\Http\utils\data_penjualan;

use App\Model\Produksi\PSales;
use Session;

class PembayaranPenjualan
{
    public function data($req)
    {
        $container = [];
        $no = 1;
        $model = PSales::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('metode_bayar', '1');

        if (!empty($req->tgl_awal) && !empty($req->tgl_akhir)) {
            $model->whereBetween('tgl_sales', [$req->tgl_awal, $req->tgl_akhir]);
        }

        if (!empty($req->id_klien)) {
            $model->where('id_klien', $req->id_klien);
        }

        foreach ($model->get() as $data) {
            $klien = '';
            if (!empty($data->linkToKlien)) {
                $klien = $data->linkToKlien->nm_klien;
            }

            $no_transaksi = '';
            if (!empty($data->linkToSo)) {
                $no_transaksi = $data->linkToSo->no_so;
            } else {
                $no_transaksi = $data->no_sales;
            }
            if (!empty($data->linkToMannyTerimaBayar)) {
                foreach ($data->linkToMannyTerimaBayar as $terima_bayar) {
                    $column = [];
                    $column['no'] = $no++;
                    $column['no_transaksi'] = $no_transaksi;

                    $jenis_bayar = 0;
                    if ($terima_bayar->jenis_bayar == '0') {
                        $jenis_bayar = 'Bayar SO';
                    } else if ($terima_bayar->jenis_bayar == '1') {
                        $jenis_bayar = 'Bayar penjualan';
                    } else if ($terima_bayar->jenis_bayar == '2') {
                        $jenis_bayar = 'Return barang jual';
                    }

                    $column['jenis_pembayaran'] = $jenis_bayar;
                    $column['klien'] = $klien;
                    $column['tgl_bayar'] = date('d-m-Y', strtotime($terima_bayar->tgl_bayar));
                    $column['jumlah_bayar'] = $terima_bayar->jumlah_bayar;
                    $column['bank_asal'] = $terima_bayar->linkToBankAsal->nama_bank;
                    $column['bank_tujuan'] = $terima_bayar->linkToBankTujuan->nama_bank;
                    $metode_bayar = 0;
                    if ($terima_bayar->metode_bayar == '0') {
                        $metode_bayar = 'Transfer Bank';
                    } else if ($terima_bayar->metode_bayar == '1') {
                        $metode_bayar = 'Cek';
                    } else if ($terima_bayar->metode_bayar == '2') {
                        $metode_bayar = 'Langsung/Tunai';
                    } else if ($terima_bayar->metode_bayar == '3') {
                        $metode_bayar = 'Return Barang';
                    }
                    $column['metode_bayar'] = $metode_bayar;
                    $container[] = $column;
                }
            }
        }
        return $container;
    }
}