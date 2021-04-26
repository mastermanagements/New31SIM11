<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class StrategiManager extends Model
{
  protected $table ="u_strategi_manager";
  protected $fillable =['id_tman','nama','isi','id_perusahaan','id_karyawan'];

  public function getTargetMan()
  {
		return $this->belongsTo('App\Model\Karyawan\TargetMan','id_tman');
  }
}
