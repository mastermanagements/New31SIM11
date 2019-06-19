<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_Karyawan_pelatihan extends Model
{
    //
    protected $table="h_karyawan_pelatihan";

    protected $fillable=["id_ky","id_rencana_pel","id_perusahaan","id_karyawan"];

    public function karyawan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','id_ky');
    }

}
