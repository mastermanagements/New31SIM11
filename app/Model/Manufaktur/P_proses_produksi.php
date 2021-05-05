<?php

namespace App\Model\Manufaktur;

use Illuminate\Database\Eloquent\Model;

class P_proses_produksi extends Model
{
    //
    protected $table = 'p_proses_produksi';
    protected $fillable = ['id_tambah_produksi','id_proses_bisnis','tgl_mulai','jam_mulai','ket','tgl_selesai','jam_selesai',
        'id_perusahaan','id_karyawan'];

    public function linkToProsesBisnis(){
        return $this->belongsTo('App\Model\Manufaktur\P_Proses_Bisnis','id_proses_bisnis');
    }

    public function linkToBisnisSop(){
        return $this->belongsTo('App\Model\Manufaktur\P_Proses_Bisnis','id_proses_bisnis');
    }
}
