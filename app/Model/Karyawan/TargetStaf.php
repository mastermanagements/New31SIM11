<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class TargetStaf extends Model
{
  protected $table="u_target_supervisor";
  protected $fillable = ['id_target_superv','bulan','nm_karyawan','target_staf','jumlah_target','satuan_target','id_perusahaan','id_karyawan'];
}
