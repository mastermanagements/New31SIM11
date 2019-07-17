<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class DaftarGaji extends Model
{
    protected $table="g_daftar_gaji";

    protected $fillable = ['priode','id_ky','besar_gaji','ket','status_aktif','id_perusahaan','id_karyawan'];
}
