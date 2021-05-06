<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class DetailPO extends Model
{
    protected $table = "p_detail_po";

    protected $fillable = ['id_po','id_barang','harga_beli','jumlah_beli','diskon_item','jumlah_harga','id_perusahaan','id_karyawan'];

    public function linkToBarang()
    {
        # code...
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }

    public function getDetailCekBarang(){
        return $this->hasOne('App\Model\Produksi\Detail_Cek_Barang','id_detail_po','id');
    }
}
