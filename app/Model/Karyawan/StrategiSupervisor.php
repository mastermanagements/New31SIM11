<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class StrategiSupervisor extends Model
{
  protected $table ="u_strategi_supervisor";
  protected $fillable =['id_tsup','nama','isi','id_perusahaan','id_karyawan'];
}
