<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 06/01/2021
 * Time: 9:23
 */

namespace App\Http\Controllers\produksi\utils;

use App\Model\Produksi\Barang as barang;
use Session;


class StokBarangOperation
{

    public static $jenis_barang = null;
    public static $list_jenis_barang = [
        'Barang Jadi',
        'Barang Mentah',
        'Barang Dalam Proses',
    ];

    # Todo: operasi formula stok
    public static function operation($model, $action)
    {
        try {
            $model_barang = barang::findOrFail($model->id_barang);
            if ($action == 'stok_awal') {
                $x_total = $model_barang->linkToStokAwal->sum('jumlah_brg');
            } else {
                $stok_akhir = $model_barang->stok_akhir;
                if ($model->jenis_item == '0') {
                    $x_total = $stok_akhir + $model->jumlah_brg;
                } else {
                    $x_total = $stok_akhir - $model->jumlah_brg;
                }
            }
            $model_barang->stok_akhir = $x_total;
            return $model_barang->save();
        } catch (Throwable $e) {
            return false;
        }
    }

    public static function getDataStok()
    {
        if (self::$jenis_barang != null) {
            $barang = barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->where('jenis_barang', '' . self::$jenis_barang);
        } else {
            $barang = barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        }
        $container = [];
        $no = 1;
        foreach ($barang->get() as $data_barang) {
            $column = [];
			$satuan="";
			if(!empty($data_barang->linkToSatuan->satuan)){
				$satuan = $data_barang->linkToSatuan->satuan;
			}
            $column[] = $no++;
            $column[] = $data_barang->nm_barang;
            $column[] = $satuan;
            $column[] = $data_barang->spec_barang;
            $column[] = $data_barang->merk_barang;
            $column[] = $data_barang->stok_akhir;
            $container[] = $column;
        }
        return $container;
    }
}