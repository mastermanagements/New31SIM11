<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class TaskProyek extends Model
{
    //

    protected $table="p_task_proyek";

    protected $fillable=['nama_tugas','id_perusahaan','id_karyawan'];
}
