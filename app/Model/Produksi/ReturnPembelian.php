<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class ReturnPembelian extends Model
{
    //
    protected $table = "p_return_pembelian";

    protected $fillable = ['id_order','tgl_return','jenis_return','ongkir_return','konfirm','status_return','id_perusahaan','id_karyawan'];

    public function linkToKaryawan()
    {
        return $this->belongsTo('App\Model\Hrd\H_Karyawan','id_karyawan');
    }
}
