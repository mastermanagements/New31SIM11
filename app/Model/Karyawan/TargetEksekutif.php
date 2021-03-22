<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class TargetEksekutif extends Model
{
  protected $table="u_target_eksekutif";
  protected $fillable = ['tahun','id_bagian_p','id_jabatan_p','target_eksekutif','jumlah_target','satuan_target','id_perusahaan','id_karyawan'];


  public function getBagian()
  {
		return $this->belongsTo('App\Model\Karyawan\Bagian','id_bagian_p');
  }

  public function getJabatan()
  {
		return $this->belongsTo('App\Model\Superadmin_ukm\U_jabatan_p', 'id_jabatan_p');
  }
  public function getStrategiEks()
  {
		return $this->hasOne('App\Model\Karyawan\StrategiEks', 'id_teks');
  }

}
