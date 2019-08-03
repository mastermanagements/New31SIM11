<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class PeriodeInvestasi extends Model
{
    //

    protected $table = "i_periode_investasi";

    protected $fillable = ['periode_ke','nm_periode','vesting_periode',
        'nilai_valuasi','id_perusahaan','id_karyawan'];

    public function saham_perdana(){
        return $this->hasOne('App\Model\Investor\SahamPerdana','id_periode_invest');
    }

    public function saham_real(){
        return $this->hasOne('App\Model\Investor\SahamReal','id_periode_saham');
    }


    public function dataInvetasi(){
        return $this->hasMany('App\Model\Investor\DaftarInvestasi','id_periode_invest');
    }
}
