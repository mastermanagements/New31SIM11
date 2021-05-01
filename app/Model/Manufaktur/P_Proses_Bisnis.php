<?php

namespace App\Model\Manufaktur;

use Illuminate\Database\Eloquent\Model;

class P_Proses_Bisnis extends Model
{
    //
    protected $table = 'p_proses_bisnis_manuf';
    protected $fillable = ['id_sop_pro','proses_bisnis','ket','id_perusahaan','id_karyawan'];
}
