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

    public function linkToKaryawan(){
        return $this->belongsTo('App\Model\Hrd\H_Karyawan', 'id_karyawan');
    }

    public function linkToMannyMasukGudang(){
        return $this->hasMany('App\Model\DetailMasukGudang','id_masuk_gudang','id');
    }
}
