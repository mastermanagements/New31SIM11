<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class Pelaksana extends Model
{
    //

    protected $table="i_pelaksana";

    protected $fillable = ['id_ky','id_periode_invest','id_bentuk_invest','persen_saham','id_perusahaan','id_karyawan'];

    public function karyawan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','id_ky');
    }

    public function periode_invest(){
        return $this->belongsTo('App\Model\Investor\PeriodeInvestasi','id_periode_invest');
    }

    public function bentuk_invest(){
        return $this->belongsTo('App\Model\Investor\BentukInvestor','id_bentuk_invest');
    }



}
