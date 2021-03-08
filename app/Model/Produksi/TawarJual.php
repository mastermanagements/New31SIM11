<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class TawarJual extends Model
{
    //
    protected $table = "p_tawar_jual";

    protected $fillable = ['id_promo','no_tawar','tgl_tawar','tgl_berlaku','tgl_krm','id_klien','ket','id_perusahaan','id_karyawan'];

    public function linkktoKlien(){
        return $this->belongsTo('App\Model\Administrasi\Klien', 'id_klien');
    }

    public function linkToDetailTawarBeli(){
        return $this->hasMany('App\Model\Produksi\DetailBarangTawar','id_tawar_jual','id');
    }

    public function linkToPromo(){
        return $this->belongsTo('App\Model\Marketing\Promo', 'id_promo');
    }
}
