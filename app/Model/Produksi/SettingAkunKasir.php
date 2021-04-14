<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class SettingAkunKasir extends Model
{
    //
    protected $table = "p_kas_kasir";
    protected $fillable = ['id_shift_kasir','id_akun_aktif','id_perusahaan','id_karyawan'];
}
