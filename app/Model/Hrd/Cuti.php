<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    //
    protected $table ="h_cuti";

    protected $fillable=['id_ky','periode','id_setting_cuti','max_suci','id_perusahaan','id_karyawan'];

    public function karyawan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','id_ky');
    }

    public function pengaturan_cuti(){
        return $this->belongsTo('App\Model\Hrd\H_setting_cuti','id_setting_cuti');
    }
}
