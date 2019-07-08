<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class G_sub_cf extends Model
{
    //

    protected $table="g_sub_cf";

    protected $fillable=['id_cf','sub_faktor','definisi','bobot_subcf','id_perusahaan','id_karyawan'];

}
