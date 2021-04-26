<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class PesananPembelian extends Model
{
    //
    protected $table = 'p_po';

    protected $fillable = ['id_tawar_beli','tgl_po','no_po','id_supplier','tgl_krm','diskon_tambahan','pajak','dp_po','kurang_bayar','ket','status_po','total','id_perusahaan','id_karyawan'];

    public function linkToSupplier(){
        return $this->belongsTo('App\Model\Produksi\Supplier','id_supplier');
    }

    public function linkToDetailPO(){
        return $this->hasMany('App\Model\Produksi\DetailPO','id_po','id');
    }

    public function linkToBayar(){
        return $this->hasOne('App\Model\Produksi\Bayar','id_po', 'id');
    }
}
