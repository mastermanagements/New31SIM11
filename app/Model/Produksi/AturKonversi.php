<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class AturKonversi extends Model
{
    //
    protected $table = "p_konversi_barang";

    protected $fillable = ['id_barang_asal','id_barang_tujuan','jumlah_konversi_satuan','id_perusahaan','id_karyawan'];

    public function linkToBarangAsal(){
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang_asal');
    }
    public function linkToBarangTujuan(){
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang_tujuan');
    }
}
