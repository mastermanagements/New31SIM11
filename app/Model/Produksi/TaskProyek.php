<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class TaskProyek extends Model
{
    //

    protected $table="p_task_proyek";

    protected $fillable=['id_proyek','nama_tugas','id_perusahaan','id_karyawan'];

    public function rincian_tugas(){
        return $this->hasMany('App\Model\Produksi\RincianTugas','id_task_p');
    }

    public function proyek(){
        return $this->belongsTo('App\Model\Produksi\Proyek','id_proyek');
    }
    public function jadwal_proyek(){
        return $this->hasMany('App\Model\Produksi\JadwalProyek', 'id_task_p');
    }

}
