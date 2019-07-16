<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class G_skala_gaji extends Model
{
    //
    protected $table="g_skala_gaji";

    protected $fillable = ['id_jabatan','id_klasifikasi','besaran_gaji','id_perusahaan','id_karyawan'];

}
