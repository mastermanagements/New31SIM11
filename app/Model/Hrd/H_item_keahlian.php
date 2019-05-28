<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_item_keahlian extends Model
{
    //
    protected $table = "h_item_keahlian";

    protected $fillable = ['id_jabatan_p','item_tes_keahlian','id_perusahaan','id_karyawan'];

    public function jabatan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\U_jabatan_p','id_jabatan_p');
    }
}
