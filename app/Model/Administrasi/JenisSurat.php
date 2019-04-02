<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    //
    protected $table="a_jenis_surat";

    protected $fillable=['jenis_surat_keluar','id_perusahaan','id_karyawan'];
}
