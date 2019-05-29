<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_jenis_kontrak extends Model
{
    //
    protected $table = "h_jenis_kontrak";

    protected $fillable = ['jenis_kontrak','id_perusahaan','id_karyawan'];


}
