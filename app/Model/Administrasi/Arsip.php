<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    //

    protected $table="a_arsip";

    protected $fillable = ['id_jenis_arsip','ket','file_arsip','id_perusahaan','id_perusahaan','id_karyawan'];

    public function getJenisArsip()
    {
        return $this->belongsTo('App\Model\Administrasi\JenisArsip','id_jenis_arsip');
    }
}
