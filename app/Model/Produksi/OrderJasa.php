<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class OrderJasa extends Model
{
    protected $table = 'p_order_jasa';

    protected $fillable = ['tgl_order','id_klien','status_service','status_konfirm','tgl_konfirm','jam_konfirm','status_ambil','id_perusahaan','id_karyawan'];

    public function getKlien(){
        return $this->belongsTo('App\Model\Administrasi\Klien','id_klien');
    }
    public function getKaryawan(){
        return $this->belongsTo('App\Model\Hrd\H_Karyawan','id_karyawan');
    }
    public function getDetailOrderJasa(){
      return $this->hasMany('App\Model\Produksi\DetailOrderJasa', 'id_order_jasa','id');
    }
    

}
