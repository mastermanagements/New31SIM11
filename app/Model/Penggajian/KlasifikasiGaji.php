<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class KlasifikasiGaji extends Model
{
    //
    protected $table='g_klasifikasi_gaji';
    protected $fillable=['klasifikas','id_perusahaan','id_karyawan'];
}
