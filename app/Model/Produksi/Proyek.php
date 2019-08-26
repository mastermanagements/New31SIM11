<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    //
    protected $table = "p_proyek";

    protected $fillable = ['jenis_proyek','id_spk','jangka_waktu','rincian_proyek','id_perusahaan','id_karyawan'];

    public function spk()
    {
        return $this->belongsTo('App\Model\Administrasi\SPKKontrak','id_spk');
    }

    public function timProyek(){
        return $this->hasMany('App\Model\Produksi\TimProyek', 'id_proyek');
    }

    public function timOneProye(){
        return $this->hasOne('App\Model\Produksi\TimProyek', 'id_proyek');
    }

    public function taks_proyek(){
        return $this->hasMany('App\Model\Produksi\TaskProyek','id_proyek');
    }
}
