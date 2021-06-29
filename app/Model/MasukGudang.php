<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasukGudang extends Model
{
    //
    protected $table = 'p_masuk_gudang';

    protected $guarded=[];

    public function linkToOrder(){
        return $this->belongsTo('App\Model\Produksi\POrder','id_order');
    }
}
