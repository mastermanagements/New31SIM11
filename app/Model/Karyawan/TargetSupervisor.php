<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class TargetSupervisor extends Model
{
  protected $table="u_target_supervisor";
  protected $fillable = ['id_target_man','tahun','id_divisi_p','id_jabatan_p','target_supervisor','jumlah_target','satuan_target','id_perusahaan','id_karyawan'];
}
