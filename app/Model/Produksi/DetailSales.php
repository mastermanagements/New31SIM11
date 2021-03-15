<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class DetailSales extends Model
{
    //
    protected $table = 'p_detail_sales';

    protected $fillable = ['id_sales','id_barang','hpp','jumlah_jual','diskon','jumlah_harga','id_perusahaan','id_karyawan'];
}
