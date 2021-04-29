<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class DetailSales extends Model
{
    //
    protected $table = 'p_detail_sales';

    protected $fillable = ['id_sales','id_barang','hpp','jumlah_jual','diskon','jumlah_harga','id_perusahaan','id_karyawan'];

  //  public function linkToSales(){ #link to pso
        //return $this->belongsTo('App\Model\Produksi\PSO','id_sales');
  //  }

    public function _linkToSales(){
        return $this->belongsTo('App\Model\Produksi\PSales','id_sales');
    }

    public function linkToBarang(){
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }

    public function linkToComplainBarangJual(){
        return $this->hasOne('App\Model\Produksi\ComplainBarangJual','id_detail_sales','id');
    }
}
