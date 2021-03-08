<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class DetailBarangTawar extends Model
{
    //

    protected $table = "p_detail_tj";

    protected $fillable = ['id_tawar_jual','id_barang','id_jasa','hpp','jumlah_barang','diskon','total_tj','id_perusahaan'];

    public function linkToBarang(){
        return $this->belongsTo('App\Model\Produksi\Barang', 'id_barang');
    }
}
