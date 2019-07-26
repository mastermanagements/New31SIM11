<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class G_lembur extends Model
{
    //

    protected $table="g_lembur";

    protected $fillable=['id_ky','id_slip','jum_lembur','jum_besaran_lembur','id_perusahaan',
        'id_karyawan'];


}
