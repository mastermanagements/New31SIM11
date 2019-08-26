<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_jenis_kompetensi extends Model
{
    //
    protected $table="h_jenis_kompetensi";

    protected $fillable=["nm_kompetensi",'id_perusahaan','id_karyawan'];
}
