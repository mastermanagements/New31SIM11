<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KeluarGudang extends Model
{
    //
    protected $table = "p_keluar_gudang";

    protected $guarded = [];

    public function linkToPengirim(){
        return $this->belongsTo('App\Model\Hrd\H_Karyawan','nama_pengirim');
    }

    public function linkToPenerima(){
        return $this->belongsTo('App\Model\Hrd\H_Karyawan','nama_penerima');
    }

    public function linkToGudangAsal(){
        return $this->belongsTo('App\Model\Gudang','gudang_asal');
    }

    public function linkToGudangTujuan(){
        return $this->belongsTo('App\Model\Gudang','gudang_tujuan');
    }

    public function linkToDetailKeluarkanGudang(){
        return $this->hasMany('App\Model\DetailKeluarGudang','id_keluar_gudang','id');
    }
}
