<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class DevidePerbulan extends Model
{
    //
    protected $table="i_bulan_dividen_s";

    protected $fillable=['thn_dividen','bln_dividen','laba_rugi',
        'alokasi_kas','net_kas','id_perusahaan','id_karyawan'];
}
