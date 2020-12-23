<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class HargaJualBaseOnJumlah extends Model
{
    //
    protected $table = "p_harga_jual_baseon_jumlah";

    protected $fillable = ['id_barang','jumlah_maks_brg','no_urut','harga_jual','id_karyawan','id_perusahaan'];

    public function linkToBarang(){
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }
}
