<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_predikat_penilaian extends Model
{
    //
    protected $table='h_predikat_penilaian';

    protected $fillable = ['skor_awal','skor_akhir','predikat','kenaikan','fasilitas_lain','id_perusahaan','id_karyawan'];
}
