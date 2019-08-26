<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class KlasifikasiGaji extends Model
{
    //
    protected $table='g_klasifikasi_gaji';
    protected $fillable=['klasifikas','id_perusahaan','id_karyawan'];

    public function skala_gaji(){
        return $this->hasMany('App\Model\Penggajian\G_skala_gaji','id_klasifikasi');
    }
}
