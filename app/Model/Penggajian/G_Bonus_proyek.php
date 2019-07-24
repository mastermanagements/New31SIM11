<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class G_Bonus_proyek extends Model
{
    protected $table = 'g_bonus_proyek';

    protected $fillable = ['id_tim_proyek','nilai_apt','id_kelas_proyek',
        'besar_tunjangan','id_perusahaan','id_karyawan'];

    public function kelas(){
        return $this->belongsTo('App\Model\Penggajian\G_kelas_proyek','id_tim_proyek');
    }
}
