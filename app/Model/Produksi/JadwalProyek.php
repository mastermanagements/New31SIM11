<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class JadwalProyek extends Model
{
    //

    protected $table="p_jadwal_proyek";

    protected $fillable=['id_task_p','id_rincian_p','durasi','tgl_mulai','tgl_selesai','id_perusahaan','id_karyawan'];

    public function task_p(){
        return $this->belongsTo('App\Model\Produksi\TaskProyek','id_task_p');
    }

    public function rincian_p(){
        return $this->belongsTo('App\Model\produksi\RincianTugas','id_rincian_p');
    }
}
