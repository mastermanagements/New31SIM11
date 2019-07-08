<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class PokokCF extends Model
{
    //

    protected $table="g_pokok_cff";

    protected $fillable=['nm_pokok_ccf','id_perusahaan','id_karyawan'];
}
