<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class JenisArsip extends Model
{
    //

    protected $table = "a_jenis_arsip";

    protected $fillable = ['jenis_arsip','id_perusahaan','id_karyawan'];

}
