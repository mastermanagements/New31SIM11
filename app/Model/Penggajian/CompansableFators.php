<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class CompansableFators extends Model
{
    protected $table="g_cf";

    protected $fillable = ['id_jabatan','faktor','bobot','id_perusahaan','id_karyawan'];
}
