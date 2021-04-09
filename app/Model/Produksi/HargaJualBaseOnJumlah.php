<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class HargaJualBaseOnJumlah extends Model
{
    //
    protected $table = "p_harga_jual_baseon_jumlah";

    protected $fillable = ['id_barang','jumlah_maks_brg','harga_jual','id_perusahaan','id_karyawan'];

    public function linkToBarang(){
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }
}
