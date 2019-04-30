<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    //
    protected $table = "p_proyek";

    protected $fillable = ['jenis_proyek','id_spk','jangka_waktu','rincian_proyek','id_perusahaan','id_karyawan'];
}
