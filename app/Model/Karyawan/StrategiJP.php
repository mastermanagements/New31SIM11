<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class StrategiJP extends Model
{
  protected $table ="u_strategi_jpg";
  protected $fillable =['id_tjpg','isi','id_perusahaan','id_karyawan'];
}
