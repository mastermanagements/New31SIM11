<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class TimProyek extends Model
{
    //

    protected $table="p_tim_proyek";

    protected $fillable = ['id_proyek','id_ky','jabatan_proyek','id_perusahaan','id_karyawan'];

    public function proyek()
    {
        return $this->belongsTo('App\Model\Produksi\Proyek','id_proyek');
    }

    public function karyawan()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','id_ky');
    }

}
