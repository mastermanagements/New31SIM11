<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class JenisPemeliharaan extends Model
{
    //
    protected $table = "p_jenis_pem";

    protected $fillable = ['jenis_pem','id_perusahaan','id_karyawan'];
}
