<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class DaftarInvestasi extends Model
{
    //
    protected $table = "i_daftar_investasi";

    protected $fillable =[
        'tgl_invest',
        'id_periode_invest',
        'id_investor',
        'id_bentuk_invest',
        'jumlah_saham',
        'jumlah_investasi',
        'ket',
        'persentase',
        'id_perusahaan',
        'id_karyawan',
    ];

    public function periode_invest(){
        return $this->belongsTo('App\Model\Investor\PeriodeInvestasi','id_periode_invest');
    }

    public function investor(){
        return $this->belongsTo('App\Investasi\I_data_investor','id_investor');
    }

    public function bentuk_investasi(){
        return $this->belongsTo('App\Model\Investor\BentukInvestor','id_bentuk_invest');
    }
}
