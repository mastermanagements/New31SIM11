<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 21/07/2021
 * Time: 13:25
 */

namespace App\Http\Controllers\manufaktur\util_brg_inventory;

use Session;
use App\Model\MasukGudang;
use App\Model\KeluarGudang;

class MasukKeluarGudang
{
    public function data($req)
    {
        if (!empty($req->transaksi_gudang)) {
            if ($req->transaksi_gudang == '0') {
                return $this->masuk_gudang($req);
            }

            if ($req->transaksi_gudang == '1') {
                return $this->keluar_gudang($req);
            }
        } else {
            return $this->masuk_gudang($req);
        }
    }

    private function masuk_gudang($req)
    {
        $container = [];
        $no = 1;
        $model = MasukGudang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        if (!empty($req->gudang)) {
            $model->where('id_gudang', $req->gudang);
        }
        foreach ($model->get() as $data) {
            $column = [];
            $column['no'] = $no++;
            $column['tgl_transaksi'] = $data->tgl_transaksi;
            $column['faktur_pembelian'] = $data->linkToOrder->no_order;
            $column['supplier'] = $data->linkToOrder->linkToSuppliers->nama_suplier;
            $column['pengirim'] = $data->nama_pengirim;
            $column['penerima'] = $data->linkToKaryawan->nama_ky;
            $column['jumlah'] = $data->linkToMannyMasukGudang->sum('jumlah');
            $container[] = $column;
        }
        return $container;
    }

    private function keluar_gudang($req)
    {
        $container = [];
        $no = 1;
        $model = KeluarGudang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        if (!empty($req->gudang)) {
            $model->where('id_gudang', $req->gudang);
        }
        foreach ($model->get() as $data) {
            $column = [];
            $column['no'] = $no++;
            $column['tgl_transaksi'] = $data->tgl_transaksi;
            $column['gudang_asal'] = $data->linkToGudangAsal->gudang;
            $column['gudang_tujuan'] = $data->linkToGudangTujuan->gudang;
            $column['pengirim'] = $data->nama_pengirim;
            $column['penerima'] = $data->linkToPenerima->nama_ky;
            $column['jumlah'] = $data->linkToDetailKeluarkanGudang->sum('jumlah');
            $container[] = $column;
        }
        return $container;
    }
}