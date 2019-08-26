<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_log_diary extends Model
{
    protected $table = "h_log_diary";

    protected $fillable=['tgl_log_diary','key_moment','id_perusahaan','id_karyawan'];
}
