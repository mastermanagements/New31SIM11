<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_absensi extends Model
{
    protected $table = "h_absensi";

    protected $fillable=['id_ky','periode','normal_hari','hadir','terlambat_masuk','tidak_absen_m','tidak_absen_p','jum_izin','id_perusahaan','id_karyawan'];

    public function karyawan(){
        return $this->belongsTo('App\Model\superadmin_ukm\H_karyawan','id_ky');
    }
}
