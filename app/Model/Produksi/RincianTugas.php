<?php

namespace App\Model\produksi;

use Illuminate\Database\Eloquent\Model;
use App\Model\Produksi\TaskProyek as taskProyeks;
use Session;

class RincianTugas extends Model
{
    protected $table="p_rincian_tugas";

    protected $fillable = ['id_task_p','rincian_tugas','id_perusahaan','id_karyawan'];

    public function tugasProyek(){
        return $this->belongsTo('App\Model\Produksi\TaskProyek', 'id_task_p');
    }
}
