<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class ModelBisnis extends Model
{
    //
    protected $table="a_model_bisnis";

    protected $fillable=['nm_mb','sasaran','id_perusahaan','id_karyawan'];
}
