<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_Jabatan_ky extends Model
{
    protected $table = "h_jabatan_ky";

    protected $fillable = ['id_ky','id_jabatan_p','mulai_menjabat','selesai_menjabat','status_jabatan','id_perusahaan','id_karyawan'];


    public function getJabatan()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\U_jabatan_p','id_jabatan_p');
    }
}
