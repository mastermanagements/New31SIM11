<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class ProsesBisnis extends Model
{
    protected $table ="p_proses_bisnis";
    protected $fillable = ['id_barang','proses_bisnis','ket','id_perusahaan','id_karyawan'];
}
