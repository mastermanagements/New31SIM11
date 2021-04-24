<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class StrategiStaf extends Model
{
  protected $table ="u_strategi_staf";
  protected $fillable =['id_tstaf','nama','isi','id_perusahaan','id_karyawan'];
}
