<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 22/07/2021
 * Time: 09:42
 */

namespace App\Http\Controllers\produksi\utils;

use App\Model\Produksi\StokOpname as model_stok_opname;
use Session;


class StokOpname
{
    public function data($req)
    {
        $container = array();
        $no = 1;
        $model = model_stok_opname::where('id_perusahaan', Session::get('id_perusahaan_karyawan'));

        if (!empty($req->tgl_awal) && !empty($req->tgl_akhir)) {
            $model->whereBetween('tgl_so', [$req->tgl_awal, $req->tgl_akhir]);
        }


        foreach ($model->get() as $data) {
            $column = array();
            $column['no'] = $no++;
            $column['tgl'] = date('d-m-Y', strtotime($data->tgl_so));
            $column['nm_barang'] = $data->linkToBarang->nm_barang;
            $column['spek'] = $data->linkToBarang->spec_barang;
            $column['merk'] = $data->linkToBarang->merk_barang;
            $column['satuan'] = $data->linkToBarang->linkToSatuan->satuan;
            $column['stok_sistem'] = $data->stok_akhir;
            $column['stok_fisik'] = $data->bukti_fisik;
            $column['selisih'] = $data->selisih;
            $column['petugas'] = $data->petugas;
            $container[] = $column;
        }
        return $container;
    }
}