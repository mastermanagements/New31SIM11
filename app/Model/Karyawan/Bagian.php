<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    //
    protected $table="u_bagian_p";

    protected $fillable = ['nm_bagian','id_perusahaan','id_karyawan'];

    public function getDevisi(){
        return $this->hasMany('App\Model\Karyawan\Devisi','id_bagian_p');
    }
}
