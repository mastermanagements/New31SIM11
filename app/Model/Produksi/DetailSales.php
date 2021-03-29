<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class DetailSales extends Model
{
    //
    protected $table = 'p_detail_sales';

    protected $fillable = ['id_sales','id_barang','hpp','jumlah_jual','diskon','jumlah_harga','id_perusahaan','id_karyawan'];

    public function linkToSales(){
        return $this->belongsTo('App\Model\Produksi\PSO','id_sales');
    }

    public function linkToComplainBarangJual(){
        return $this->hasOne('App\Model\Produksi\ComplainBarangJual','id_detail_sales','id');
    }
}
