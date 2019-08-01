<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class SahamPerdana extends Model
{
    //
    protected $table = "i_saham_perdana";
    protected $fillable = [
      'id_periode_invest',
      'lembar_saham_perdana',
      'nilai_saham',
      'id_perusahaan',
      'id_karyawan',
    ];

    public function periode_invest(){
        return $this->belongsTo('App\Model\Investor\PeriodeInvestasi','id_periode_invest');
    }
}
