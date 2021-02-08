<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    //
    protected $table = 'p_detail_order';

    protected $fillable = ['id_order','id_barang','hpp','jumlah_beli','diskon_item','jumlah_harga','id_perusahaan'];

    public function linkToBarang()
    {
        # code...
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }

}
