<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class SKJasa extends Model
{
    protected $table="p_sk_jasa";
    protected $fillable =['jenis_sk','sk','id_perusahaan','id_karyawan'];
}
