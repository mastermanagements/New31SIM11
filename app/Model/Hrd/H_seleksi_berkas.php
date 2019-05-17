<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_seleksi_berkas extends Model
{
    //
    protected $table = "h_seleksi_berkas";

    protected $fillable = ['id_lamaran_p','ket','hasil','id_perusahaan','id_karyawan'];

    public function pelamar(){
        return $this->belongsTo('App\Model\Hrd\H_lamaran_pek','id_lamaran_p');
    }

}
