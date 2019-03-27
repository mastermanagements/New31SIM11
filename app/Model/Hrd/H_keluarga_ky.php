<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_keluarga_ky extends Model
{
    //

    protected $table="h_keluarga_ky";

    protected $fillable = ['id_ky','nm_ayah','status_a','nm_ibu','status_i','jum_saudara','anak_ke','cp_darurat','telp_darurat','file_kk','id_perusahaan','id_karyawan'];

}
