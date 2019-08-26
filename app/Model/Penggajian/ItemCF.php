<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class ItemCF extends Model
{
    //
    protected $table="g_item_ccf";

    protected $fillable=['id_pccf','item_ccf','id_perusahaan','id_karyawan'];

    public function pccf(){
        return $this->belongsTo('App\Model\Penggajian\PokokCF','id_pccf');
    }
}
