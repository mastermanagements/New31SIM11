<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class SettingKasir extends Model
{
    //
    protected $table = "p_shift_kasir";

    protected $fillable = ['kasir','shift','id_perusahaan','id_karyawan'];

    public function linkToKaryawan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','kasir');
    }
}
