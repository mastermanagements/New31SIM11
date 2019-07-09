<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class PokokCF extends Model
{
    //

    protected $table="g_pokok_cff";

    protected $fillable=['id_sub_cf','nm_pokok_ccf','id_perusahaan','id_karyawan'];

    public function sub_cf(){
        return $this->belongsTo('App\Model\Penggajian\G_sub_cf','id_sub_cf');
    }

    public function item_ccf(){
        return $this->hasMany('App\Model\Penggajian\ItemCF','id_pccf');
    }

    public function content_ccf(){
        return $this->hasMany('App\Model\Penggajian\G_content_cf','id_pokok');
    }
}
