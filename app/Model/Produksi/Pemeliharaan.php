<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class Pemeliharaan extends Model
{
    //
    protected $table = "p_pemeliharaan";

    protected $fillable = ["id_proyek","id_jasa","id_jenis_pem","nm_pemeliharaan","jangka_waktu","biaya_pem","ket","id_perusahaan","id_karyawan"];

    public function jasa(){
        return $this->belongsTo('App\Model\Produksi\Jasa','id_jasa');
    }
	
	public function proyek(){
        return $this->belongsTo('App\Model\Produksi\Proyek','id_proyek');
    }

    public function jenis_pem(){
        return $this->belongsTo('App\Model\Produksi\JenisPemeliharaan','id_jenis_pem');
    }
}
