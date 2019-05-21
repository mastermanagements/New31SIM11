<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_jenis_psikotes extends Model
{
    //
    protected $table="h_jenis_psikotes";

    protected $fillable = ['jenis_psikotes','id_perusahaan','id_karyawan'];

}
