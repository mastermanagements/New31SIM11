<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class G_kelas_proyek extends Model
{
    protected $table="g_kelas_proyek";

    protected $fillable = ['nm_kelas','keterangan','persen_besar_proyek',
        'id_perusahaan','id_karyawan'];

}
