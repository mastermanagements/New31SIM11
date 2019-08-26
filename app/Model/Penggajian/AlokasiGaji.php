<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class AlokasiGaji extends Model
{
    //
    protected $table="g_alokasi_gaji";

    protected $fillable=['thn','persen','jumlah','id_perusahaan', 'id_karyawan'];
}
