<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class G_tunjangan_gaji extends Model
{
    //
    protected $table="g_tunjangan_gaji";

    protected $fillable = ['periode','id_ky','nm_tunjangan','besar_tunjangan','status_tunjangan',
        'status_aktif','id_perusahaan','id_karyawan'];
}
