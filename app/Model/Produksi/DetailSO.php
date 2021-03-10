<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class DetailSO extends Model
{
    //
    protected $table = "p_detail_so";

    protected $fillable = ['id_so','id_barang','hpp','jumlah_jual','diskon','jumlah_harga','id_perusahaan','id_karyawan'];


}
