<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class StrategiBulanan extends Model
{
   protected $table="u_strategi_bulanan";
   protected $fillable = ['id_stahunan','id_target_bulanan','isi_sbulanan','id_perusahaan','id_karyawan'];

}
