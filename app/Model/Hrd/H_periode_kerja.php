<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_periode_kerja extends Model
{
    //
    protected $table = "h_periode_kerja";

    protected $fillable = ['id_ky','mulai_kerja','selesai_kerja','alasan_selesai','id_perusahaan','id_karyawan'];

    public function karyawan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','id_ky');
    }
}
