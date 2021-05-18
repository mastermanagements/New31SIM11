<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 02/03/2021
 * Time: 14:08
 */

namespace App\Http\utils;
use Session;
use App\Model\Produksi\Barang;
use App\Model\Produksi\PHistoryStokAkhir;
use App\Model\Produksi\PHistoryStokAwal;
class Stok
{

    # Via  detail Porder
    public static function  updateStokAkhirPorder($model)
    {
         # Ambil sisa stok akhir dari p_barang
        $model_barang = Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->findOrFail($model->id_barang);
        $model_barang->stok_akhir = ($model_barang->stok_akhir + $model->jumlah_beli);
        //ubah stok akhir
        if($model_barang->save()){
            # setelah stok akhir di tbl p_barang diubah selanjutnya akan menambah data barang di stok akhir tabel p_history_saldo_akhir,
            # jika data sudah ada dengan kriteria id_order, id_barang, id_detail_order, id_perusahaan yg sama
            # maka sistem akan mengubah data tsb.

              $model_p_history_stok_akhir = PHistoryStokAkhir::updateOrCreate(
                    [
                        'id_detail_order'=> $model->id,
                        'id_barang' => $model_barang->id,
                        'id_order' => $model->id_order,
                        'id_perusahaan' => Session::get('id_perusahaan_karyawan'),
                    ],
                    [
                        'tgl_transaksi'=> $model->linkToOrder->tgl_order,
                        'jumlah'=>$model->id_order,
                        'harga_satuan' => $model->jumlah_beli,
                        'id_karyawan' =>Session::get('id_karyawan')
                    ]
              );
            if($model_p_history_stok_akhir){
                # setelah stok akhir diubah selanjutnya akan menambah data barang di tabel p_history_saldo_awa;,
                # jika data sudah ada dengan kriteria id_order, id_barang, id_detail_order, id_perusahaan yg sama
                # maka sistem akan mengubah data tsb.
                $model_p_history_stok_awal = PHistoryStokAwal::updateOrCreate(
                    [
                        'id_detail_order'=> $model_p_history_stok_akhir->id,
                        'id_barang' => $model_p_history_stok_akhir->id_barang,
                        'id_order' => $model_p_history_stok_akhir->id_order,
                        'id_perusahaan' => Session::get('id_perusahaan_karyawan'),
                    ],
                    [
                        'tgl_transaksi'=> $model_p_history_stok_akhir->tgl_transaksi,
                        'jumlah'=>$model_p_history_stok_akhir->id_order,
                        'harga_satuan' => $model_p_history_stok_akhir->harga_satuan,
                        'id_karyawan' =>Session::get('id_karyawan')
                    ]
                );
            }
            return true;
        }else{
            return false;
        }
    }

}
