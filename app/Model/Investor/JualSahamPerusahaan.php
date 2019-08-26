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
        'jumlah_saham_terbit',
        'id_karyawan',
        'id_perusahaan',
    ];

    public function periode_invest(){
        return $this->belongsTo('App\Model\Investor\PeriodeInvestasi','id_periode_invest');
    }
}
