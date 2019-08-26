<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class G_kelas_proyek extends Model
{
    protected $table="g_kelas_proyek";

    protected $fillable = ['nm_kelas','keterangan','persen_besar_proyek',
        'id_perusahaan','id_karyawan'];

    public function bonus_projeks(){
        return $this->hasOne('App\Model\Penggajian\G_kelas_proyek','id_kelas_proyek');
    }
}
