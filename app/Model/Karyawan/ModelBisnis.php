<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class ModelBisnis extends Model
{
    //
    protected $table="a_model_bisnis";

    protected $fillable=['id_jenis_mb','id_sub_mb','isi','id_perusahaan','id_karyawan'];

    public function getSubModelBisnis()
    {
      return $this->belongsTo('App\Model\Karyawan\SubModelBisnis', 'id_sub_mb');
    }
}
