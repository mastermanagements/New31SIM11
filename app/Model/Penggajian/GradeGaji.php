<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class GradeGaji extends Model
{
    //
    protected $table="g_grade";

    protected $fillable = ['grade','poin_min','poin_max','id_perusahaan','id_karyawan'];


}
