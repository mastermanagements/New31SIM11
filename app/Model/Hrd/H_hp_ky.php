<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_hp_ky extends Model
{
    protected $table = "h_hp_create";
    protected $fillable = ['id_ky','hp','status_hp','id_perusahaan','id_karyawan'];
}
