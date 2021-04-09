<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class PSO extends Model
{
    //
    protected $table = "p_so";

    protected $fillable = ['id_tawar_beli','tgl_so','no_so','id_po','id_klien','tgl_dikirim','diskon_tambahan','pajak','dp_so','kurang_bayar','ket','status','id_perusahaan','id_karyawan'];

    public function linkToKlien(){
        return $this->belongsTo('App\Model\Administrasi\Klien', 'id_klien');
    }

    public function linkToDetailPSO(){
        return $this->hasMany('App\Model\Produksi\DetailSO','id_so','id');
    }

    public function linkToPO(){
        return $this->belongsTo('App\Model\Produksi\TawarJual','id_po');
    }
}