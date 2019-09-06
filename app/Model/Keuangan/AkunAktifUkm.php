<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class AkunAktifUkm extends Model
{
    //
    protected $table = "k_akun_aktif_ukm";

    protected $fillable = [
        'id_sub_akun',
        'id_subsub_akun',
        'kode_akun_aktif',
        'nm_akun_aktif',
        'id_perusahaan',
        'id_karyawan',
    ];
}
