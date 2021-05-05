<?php

namespace App\Model\Manufaktur;

use Illuminate\Database\Eloquent\Model;

class P_tenaga_produksi extends Model
{
    //
    protected $table = "p_tenaga_produksi";

    protected $fillable = ['id_tambah_produksi','tenaga_kerja','pilihan_upah','jumlah_upah','id_perusahaan','id_karyawan'];
}
