<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class PDiskon extends Model
{
    //
    protected $table = "p_diskon";

    protected $fillable = ['id_group','jenis_diskon','jumlah_maks_beli','diskon_persen','diskon_nominal','id_perusahaan','id_karyawan'];

    public function linkToDiskon(){
        return $this->belongsTo('App\Model\Administrasi\GroupKlien','id_group');
    }
}
