<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class SahamReal extends Model
{
    //
    protected $table="i_saham_real";

    protected $fillable =[
        'id_periode_saham',
        'jum_saham',
        'satuan',
        'status',
        'id_perusahaan',
        'id_karyawan',
    ];

    public function periode_invest(){
        return $this->belongsTo('App\Model\Investor\PeriodeInvestasi','id_periode_saham');
    }
}
