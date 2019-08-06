<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class JualSahamPerusahaan extends Model
{
    //
    protected $table="i_jual_saham_perusahaan";

    protected $fillable= [
        'id_periode_invest',
        'jumlah_persen_saham',
        'id_perusahaan',
        'id_karyawan',
    ];

    public function periode_invest(){
        return $this->belongsTo('App\Model\Investor\PeriodeInvestasi','id_periode_invest');
    }
}
