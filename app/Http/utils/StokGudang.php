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

class StokGudang
{
    public function query_gudang($id_gudang = null)
    {
        $plug_query = "";

        if($id_gudang != null){
            $plug_query = "and p_masuk_gudang.id_gudang =".$id_gudang;
        }

        $q_gudang = DB::select('SELECT p_gudang.id, p_barang.id as id_barang,p_gudang.gudang, p_barang.nm_barang, SUM(p_detail_masuk_gudang.jumlah) as jumlah
             from p_masuk_gudang JOIN p_gudang on p_gudang.id = p_masuk_gudang.id_gudang 
             join p_detail_masuk_gudang on p_detail_masuk_gudang.id_masuk_gudang = p_masuk_gudang.id 
             join p_barang on p_detail_masuk_gudang.id_barang = p_barang.id 
             where p_detail_masuk_gudang.id_perusahaan = '.Session::get('id_perusahaan_karyawan').' '.$plug_query.' GROUP by p_detail_masuk_gudang.id_barang');
        return $q_gudang;
    }
}