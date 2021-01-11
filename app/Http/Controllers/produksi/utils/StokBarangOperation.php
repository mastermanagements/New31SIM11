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

    # Todo: operasi formula stok
    public static function operation($model, $action){
        try{
            $model_barang = barang::findOrFail($model->id_barang);
            if($action=='stok_awal'){
                $x_total = $model_barang->linkToStokAwal->sum('jumlah_brg');
            }else{
                $stok_akhir = $model->stok_akhir;
                if($model->jenis_item == '0'){
                    $x_total = $stok_akhir+$model->jumlah_brg;
                }else{
                    $x_total = $stok_akhir-$model->jumlah_brg;
                }
            }
            $model_barang->stok_akhir = $x_total;
            return $model_barang->save();
        }catch (Throwable $e){
            return false;
        }
    }


}