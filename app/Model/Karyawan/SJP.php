<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class SJP extends Model
{
   protected $table="u_strategi_jpg";
   protected $fillable = ['periode','isi_sjpg','id_perusahaan','id_karyawan'];
}
