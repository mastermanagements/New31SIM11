<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class G_content_cf extends Model
{
    //
    protected $table="g_content_cf";

    protected $fillable=['id_sub_cf','id_pokok','kolom_content','content_cf','bobot_content_cf','id_perusahaan','id_karyawan'];
}
