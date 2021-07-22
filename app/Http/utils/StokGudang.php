<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 22/06/2021
 * Time: 14:18
 */

namespace App\Http\utils;

use App\Model\Gudang;
use Session;
use Illuminate\Support\Facades\DB;
use App\Model\StokGudang as stok_data_gudang;

class StokGudang
{
    public function data_gudang(){
        $data = Gudang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get();
        return $data;
    }

    public function query_gudang($id_gudang = null, $id_barang=null)
    {
        $plug_query = "";

        if($id_gudang != null){
            $plug_query .= " and p_masuk_gudang.id_gudang =".$id_gudang;
        }

        if($id_barang != null){
            $plug_query .= " and p_detail_masuk_gudang.id_barang =".$id_barang;
        }

        $q_gudang = DB::select('SELECT p_gudang.id, p_barang.id as id_barang, p_barang.merk_barang,p_barang.spec_barang,p_satuan.satuan,p_gudang.gudang, p_barang.nm_barang, SUM(p_detail_masuk_gudang.jumlah) as jumlah
             from p_masuk_gudang JOIN p_gudang on p_gudang.id = p_masuk_gudang.id_gudang 
             join p_detail_masuk_gudang on p_detail_masuk_gudang.id_masuk_gudang = p_masuk_gudang.id 
             join p_barang on p_detail_masuk_gudang.id_barang = p_barang.id 
             join p_satuan on p_satuan.id = p_barang.id_satuan
             where p_detail_masuk_gudang.id_perusahaan = '.Session::get('id_perusahaan_karyawan').' '.$plug_query.' GROUP by p_detail_masuk_gudang.id_barang');
        return $q_gudang;
    }

    public function IOStok($model, $operation){
        $model_stok_gudang= stok_data_gudang::where('id_gudang', $model['id_gudang'])->where('id_barang', $model['id_barang'])->first();
        //kalau data stok tidak ada
        if(!empty($model_stok_gudang)){
            //update jumlah
           if($operation == 'masuk'){
                $model_stok_gudang->stok_gudang +=$model['jumlah'];
            }else{
                $model_stok_gudang->stok_gudang -=$model['jumlah'];
            }
            $model_stok_gudang->save();
        }else{
            //tambah jumlah
            $data = new stok_data_gudang([
                'id_gudang'=> $model['id_gudang'],
                'id_barang'=> $model['id_barang'],
                'stok_gudang'=> $model['jumlah'],
                'id_perusahaan'=> Session::get('id_perusahaan_karyawan'),
                'id_karyawan'=> Session::get('id_karyawan'),
            ]);
            $data->save();
        }
    }
}