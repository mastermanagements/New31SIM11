<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class GradeGaji extends Model
{
    //
    protected $table="g_grade";

    protected $fillable = ['grade','id_perusahaan','id_karyawan'];


}
