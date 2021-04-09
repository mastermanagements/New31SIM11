<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class DetailTB extends Model
{
    //

    protected $table = 'p_detail_tb';
    protected $fillable = ['id_tawar','id_barang','hpp_baru','jumlah_beli','id_perusahaan','id_karyawan'];

    public function linkToBarang(){
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }
}
