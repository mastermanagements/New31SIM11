<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 21/07/2021
 * Time: 10:28
 */

namespace App\Http\Controllers\manufaktur\util_brg_inventory;

use Session;
use App\Model\Produksi\Barang;

class DaftarBrgDanHarga
{
    public function data($req)
    {
        $container = [];
        $no = 1;
        $model = Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'));

        if (!empty($req->metode_jual)) {
            $model->where('metode_jual', $req->metode_jual);
        } else {
            $model->where('metode_jual', '0');
        }

        foreach ($model->get() as $data) {
            $column = array();
            $column['no'] = $no++;
            $column['nm_barang'] = $data->nm_barang;
            $column['spesifikasi'] = $data->spec_barang;
            $column['merk'] = $data->merk_barang;
            $harga_jual = 0;
            if ($data->metode_jual == '0') {
                if (!empty($data->linkToHargaJual)) {
                    $harga_jual = $data->linkToHargaJual->harga_jual;
                }
            }

            if ($data->metode_jual == '1') {
                if (!empty($data->linkToHargaBaseOnJumlah)) {
                    $linkto_jumlah = $data->linkToHargaBaseOnJumlah->sortByDesc('harga_jual')->first();
                    $harga_jual = $linkto_jumlah->harga_jual;
                }
            }

            $column['satuan'] = $data->linkToSatuan->satuan;
            $column['harga_jual'] = $harga_jual;
            $container[] = $column;
        }
        return $container;
    }
}