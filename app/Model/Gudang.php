<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    //
    protected $table = 'p_gudang';

    protected $guarded = [];

    public function linkToMasukGudang(){
       return $this->hasMany('App\Model\DetailMasukGudang','id_gudang','id');
    }
}
