<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class TargetSupervisor extends Model
{
  protected $table="u_target_supervisor";
  protected $fillable = ['id_target_man','tahun','id_divisi_p','id_jabatan_p','target_supervisor','jumlah_target','satuan_target','id_perusahaan','id_karyawan'];

  public function getTargetStaf()
  {
    return $this->hasMany('App\Model\Karyawan\TargetStaf', 'id_target_superv');
  }

  public function getJabatan()
  {
    return $this->belongsTo('App\Model\Superadmin_ukm\U_jabatan_p', 'id_jabatan_p');
  }
  public function getStrategiSup()
  {
		return $this->hasOne('App\Model\Karyawan\StrategiSupervisor', 'id_tsup');
  }

}
