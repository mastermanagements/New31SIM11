<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class StrategiEks extends Model
{
  protected $table ="u_strategi_eksekutif";
  protected $fillable =['id_teks','nama','isi','id_perusahaan','id_karyawan'];

  public function getTargetEks()
  {
		return $this->belongsTo('App\Model\Karyawan\TargetEksekutif','id_teks');
  }
}
