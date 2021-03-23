<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class SubModelBisnis extends Model
{
  protected $table="a_sub_mb";

  protected $fillable=['id_jenis_mb','sub_mb'];

}
