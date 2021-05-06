<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class ItemIO extends Model
{
    //
    protected $table = "p_item_masuk_keluar";

    protected $fillable = ['jenis_item','tgl','id_barang','ket','jumlah_brg','id_perusahaan','id_karyawan'];

    public function linkToBarang(){
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }

}
