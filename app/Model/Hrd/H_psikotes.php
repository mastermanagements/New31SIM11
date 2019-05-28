<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_psikotes extends Model
{
    //
    protected $table="h_psikotes";

    protected $fillable=['id_lamaran_p','tgl_tes','id_jenis_psikotes','nilai_akhir','id_perusahaan','id_karyawan'];

    public function pelamar(){
        return $this->belongsTo('Illuminate\Database\Eloquent\Model\H_lamaran_pek','id_lamaran_p');
    }

}
