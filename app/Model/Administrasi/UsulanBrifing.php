<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class UsulanBrifing extends Model
{
    //
    protected $table = "a_usulan_brifing";

    protected $fillable = ["tgl_usulan_brif","materi","id_divisi","id_perusahaan","id_karyawan"];

    public function getDevisi()
    {
        return $this->belongsTo('App\Model\Karyawan\Devisi','id_divisi');
    }
}
