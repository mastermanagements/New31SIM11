<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetailKeluarGudang extends Model
{
    //

    protected $table = 'p_detail_keluar_gudang';

    protected $guarded=[];

    public function linkToKeluarGudang(){
        return $this->belongsTo('App\Model\KeluarGudang','id_keluar_gudang');
    }
}
