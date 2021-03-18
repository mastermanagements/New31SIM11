<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class PSales extends Model
{
    //
    protected $table = "p_sales";

    protected $fillable = [
        'id_so',
        'tgl_sales',
        'no_sales',
        'id_klien',
        'tgl_kirim',
        'diskon_tambahan',
        'pajak',
        'dp_so',
        'bayar',
        'kurang_bayar',
        'tgl_jatuh_tempo',
        'biaya_tambahan',
        'ongkir',
        'total',
        'keterangan',
        'status_bayar',
        'id_komisi_sales',
        'id_perusahaan',
    ];

    public function linkToKlien(){
        return $this->belongsTo('App\Model\Administrasi\Klien','id_klien');
    }

    public function linkToDetailSales(){
        return $this->hasMany('App\Model\Produksi\DetailSales','id_sales','id');
    }
}
