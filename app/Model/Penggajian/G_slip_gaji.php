<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class G_slip_gaji extends Model
{
    protected $table="g_slip_gaji";

    protected $fillable=['id_ky','periode','id_perusahaan','id_karyawan'];

    public function karyawan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','id_ky');
    }
}
