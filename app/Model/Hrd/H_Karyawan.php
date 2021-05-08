<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_Karyawan extends Model
{
    //
    protected $table = "h_karyawan";

    protected $fillable = ['nik','nama_ky','password','tmp_lahir','tgl_lahir','jenis_kel','agama',
        'status_kerja','no_ktp','file_ktp','pas_foto','cu_vitae','nm_bank','no_rek','gol_darah','pend_akhir','program_studi','pt','id_perusahaan','tgl_masuk','id_user_ukm'];

    public function getDataKeluarga(){
     return $this->hasOne('app\Model\Hrd\H_keluarga_ky','id_ky');
    }
}
