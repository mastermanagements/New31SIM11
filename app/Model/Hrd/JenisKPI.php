<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class JenisKPI extends Model
{
    protected $table="h_jenis_kpi";

    protected $fillable=['jenis_kpi','id_perusahaan','id_karyawan'];
}
