<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class G_Bonus_Gaji extends Model
{
    //

    protected $table="g_bonus_gaji";

    protected $fillable= ['id_ky','id_slip','id_proyek','id_kelas',
        'nama_bonus','besaran_bonus','id_perusahaan','id_karyawan'];

    public function proyek(){
        return $this->belongsTo('App\Model\Produksi\Proyek','id_proyek');
    }
}
