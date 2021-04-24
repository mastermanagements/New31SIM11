<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class StokAwal extends Model
{
    //
    protected $table='p_stok_awal';

    protected $fillable = ['id_barang','jumlah_brg','expired_date','id_perusahaan','id_karyawan'];

    public function linkToBarang(){
        return $this->belongsTo('App\Model\Produksi\Barang', 'id_barang');
    }
}
