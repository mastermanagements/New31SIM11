<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class BulanDevidenM extends Model
{
    //
    protected $table = "i_deviden_bulan_m";

    protected $fillable = [
        'id_periode_invest',
        'thn_dividen',
        'bln_dividen',
        'laba_rugi',
        'alokasi_kas',
        'net_kas',
        'nisbah_pelaksana',
        'nisbah_pemodal',
        'id_perusahaan',
        'id_karyawan',
    ];

    public function periode_invest(){
        return $this->belongsTo('App\Model\Investor\PeriodeInvestasi','id_periode_invest');
    }

    public function onePeriodeInvest(){

    }
}
