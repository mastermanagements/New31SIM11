<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_lamaran_pek extends Model
{
    //
    protected $table = "h_lamaran_pek";

    protected $fillable = ['id_loker','nm_pel','posisi','jenis_lamaran','tgl_masuk','berkas_lamaran','id_perusahaan','id_karyawan'];

    public function loker(){
       return $this->belongsTo('App\Model\Hrd\H_loker','id_loker');
    }

    public function seleksi_berkas(){
        return $this->hasOne('App\Model\Hrd\H_seleksi_berkas','id_lamaran_p');
    }
}
