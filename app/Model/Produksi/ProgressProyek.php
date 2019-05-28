<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class ProgressProyek extends Model
{
    //
     protected $table = "p_progress_proyek";

     protected $fillable=['id_jadwal_proyek','tgl_dikerjakan','masalah','solusi','rincian_pekerjaan','id_perusahaan','id_karyawan'];

    public function klien(){
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','id_karyawan');
    }

    public function jadwal_proyek()
    {
        return $this->belongsTo('App\Model\Produksi\JadwalProyek','id_jadwal_proyek');
    }
}
