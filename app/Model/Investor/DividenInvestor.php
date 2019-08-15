<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class DividenInvestor extends Model
{
    //
    protected $table = "i_dividen_investor";

    protected $fillable = [
        'id_daftar_investor',
        'id_bulan_dividen',
        'besar_dividen',
        'id_perusahaan',
        'id_karyawan',
    ];

    public function investor(){
        return $this->belongsTo('App\Investasi\I_data_investor','id_daftar_investor');
    }
    public function bulan_dividen(){
        return $this->belongsTo('App\Model\Investor\DevidePerbulan','id_bulan_dividen');
    }
}
