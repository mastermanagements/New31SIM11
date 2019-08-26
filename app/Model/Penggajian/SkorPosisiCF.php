<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class SkorPosisiCF extends Model
{
    //
    protected $table="g_skor_posisi_cf";

    protected $fillable=['id_sub_cf','skor_sub_cf','id_jabatan','id_perusahaan','id_karyawan'];

}
