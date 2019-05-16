<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_seleksi_berkas extends Model
{
    //
    protected $table = "h_seleksi_berkas";

    protected $fillable = ['id_lamaran_p','ket','hasil','id_perusahaan','id_karyawan'];
}
