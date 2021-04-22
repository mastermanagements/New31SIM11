<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class JumlahKas extends Model
{
    //

    protected $table = "p_jumlah_kas";
    protected $fillable = ['id_kerja_kasir','id_akun_aktif','jumlah_aktir','id_perusahaan','id_karyawan'];

    
}
