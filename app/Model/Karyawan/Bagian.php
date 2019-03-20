<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    //
    protected $table="u_bagian_p";

    protected $fillable = ['nm_bagian','id_perusahaan','id_karyawan'];
}
