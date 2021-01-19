<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class DetailPO extends Model
{
    protected $table = "p_detail_po";

    protected $fillable = ['id_po','id_barang','hpp','jumlah_beli','diskon_item','jumlah_harga','id_perusahaan'];
}
