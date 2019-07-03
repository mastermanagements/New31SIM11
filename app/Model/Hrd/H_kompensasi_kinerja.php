<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_kompensasi_kinerja extends Model
{
    //

    protected $table="h_kompensasi_kinerja";

    protected $fillable=['nilai_total_kinerja','kenaikan_gaji','id_perusahaan','id_karyawan'];
}
