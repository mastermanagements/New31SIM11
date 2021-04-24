<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class JenisModelBisnis extends Model
{
  protected $table="a_jenis_mb";

  protected $fillable=['nama_mb'];
}
