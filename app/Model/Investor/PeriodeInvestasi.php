<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class PeriodeInvestasi extends Model
{
    //

    protected $table = "i_periode_investasi";

    protected $fillable = ['periode_ke','nm_periode','vesting_periode',
        'nilai_valuasi','id_perusahaan','id_karyawan'];
}
