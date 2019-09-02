<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    //

    protected $table = "k_akun_ukm";

    protected $fillable = ['id_m_akun','kode_akun','nm_akun','id_perusahaan','id_karyawan'];
}
