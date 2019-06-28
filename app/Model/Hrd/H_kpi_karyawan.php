<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_kpi_karyawan extends Model
{
    //
    protected $table = "h_kpi_karyawan";

    protected $fillable = ['year','id_ky','id_aku','id_kpi','realisasi_kpi','skor_kpi','skor_akhir','id_perusahaan','id_karyawan'];

    public function karyawan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','id_ky');
    }

    public function aku(){
        return $this->belongsTo('App\Model\Hrd\H_aku','id_aku');
    }

    public function kpi(){
        return $this->belongsTo('App\Model\Hrd\H_Kpi','id_kpi');
    }
}
