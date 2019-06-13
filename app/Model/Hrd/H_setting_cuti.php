<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_setting_cuti extends Model
{
    //
    protected $table = "h_setting_cuti";

    protected $fillable = ['nm_cuti','pengurang_cuti','akumulasi_cuti','id_perusahaan','id_karyawan'];
}
