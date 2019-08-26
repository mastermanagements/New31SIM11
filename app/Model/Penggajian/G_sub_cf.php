<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class G_sub_cf extends Model
{
    //

    protected $table="g_sub_cf";

    protected $fillable=['id_cf','sub_faktor','definisi','bobot_subcf','id_perusahaan','id_karyawan'];

    public function cf(){
        return $this->belongsTo('App\Model\Penggajian\CompansableFators','id_cf');
    }

    public function pokok_cf(){
        return $this->hasOne('App\Model\Penggajian\PokokCF','id_sub_cf');
    }

    public function skor_pokok_cf(){
        return $this->hasOne('App\Model\Penggajian\SkorPosisiCF','id_sub_cf');
    }
}
