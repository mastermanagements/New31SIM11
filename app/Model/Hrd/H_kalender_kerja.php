<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_kalender_kerja extends Model
{
    //
    protected $table = "h_kalender_kerja";

    protected $fillable = ['event','tgl_mulai','tgl_akhir','id_perusahaan','id_karyawan'];
}
