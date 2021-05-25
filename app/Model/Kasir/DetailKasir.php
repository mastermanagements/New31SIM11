<?php

namespace App\Model\Kasir;

use Illuminate\Database\Eloquent\Model;

class DetailKasir extends Model
{
    //
    protected $table = 'p_detail_nota_kasir';

    protected $guarded=[];

    public function linkToBarang(){
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }
}
