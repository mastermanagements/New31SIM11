<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class Cek_Barang extends Model
{
    //
    protected $table = 'p_cek_barang';

    protected $fillable = ['id_order','tgl_tiba','tgl_konfirm_cek','tgl_status_return','id_perusahaan'];

    public function linkToOrder()
    {
        return $this->belongsTo('App\Model\Produksi\POrder','id_order');
    }

    public function linkToReturnPembelian()
    {
        # code...
        return $this->hasOne('App\Model\Produksi\ReturnPembelian','id_cek_barang','id');
    }

}