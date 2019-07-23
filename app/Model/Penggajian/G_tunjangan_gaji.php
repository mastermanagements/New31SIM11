<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class G_tunjangan_gaji extends Model
{
    //
    protected $table="g_tunjangan_gaji";

    protected $fillable = ['periode','id_ky','id_skala_tunjangan', 'status_aktif','id_perusahaan','id_karyawan'];

    public function skalaTunjangan(){
        return $this->belongsTo('App\Model\Penggajian\SkalaTunjangan','id_skala_tunjangan');
    }
}
