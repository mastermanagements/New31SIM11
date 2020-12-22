<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class HargaJualSatuan extends Model
{
    //
    protected $table = 'p_harga_jual_satuan';

    protected $fillable = ['id_barang','harga_jual','id_karyawan','id_perusahaan'];

    public function linkToBarang(){
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }
}
