<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class ProgressPemeliharaan extends Model
{
    //

    protected $table = "p_progres_pemeliharaan";

    protected $fillable = ['tgl_dikerjakan','id_pemeliharaan','masalah','solusi','rincian_pekerjaan','ket','id_perusahaan','id_karyawan'];

    public function pemeliharaan(){
        return $this->belongsTo('App\Model\Produksi\Pemeliharaan','id_pemeliharaan');
    }

    public function klien(){
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','id_karyawan');
    }
}
