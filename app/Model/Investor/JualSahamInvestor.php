<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class JualSahamInvestor extends Model
{
    //
    protected $table = "i_investor_jual_saham";

    protected $fillable=[
        'tgl_jual_s',
        'id_periode_invest',
        'id_investor_penjual',
        'lembar_saham_penjual',
        'jumlah_dijual',
        'id_investor_pembeli',
        'sisa_saham_dijual',
        'id_perusahaan',
        'id_karyawan',
    ];

    public function periode_invest(){
        return $this->belongsTo('App\Model\Investor\PeriodeInvestasi','id_periode_invest');
    }

    public function investor_penjual(){
        return $this->belongsTo('App\Investasi\I_data_investor','id_investor_penjual');
    }
    public function investor_pembeli(){
        return $this->belongsTo('App\Investasi\I_data_investor','id_investor_pembeli');
    }
}
