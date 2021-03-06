<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class Cek_Barang extends Model
{
    //
    protected $table = 'p_cek_barang';

    protected $fillable = ['id_order','tgl_tiba','tgl_konfirm_cek','tgl_respon_supplier','id_perusahaan','id_karyawan'];

    public function linkToOrder()
    {
        return $this->belongsTo('App\Model\Produksi\POrder','id_order');
    }

    public function linkToCekDetailBarang(){
        return $this->hasMany('App\Model\Produksi\Detail_Cek_Barang','id_cek_barang','id');
    }

    public function linkToReturnPembelian()
    {
        return $this->hasOne('App\Model\Produksi\ReturnPembelian','id_cek_barang','id');
    }
    public function linkToKaryawan()
    {
        return $this->belongsTo('App\Model\Hrd\H_Karyawan','id_karyawan');
    }

}
