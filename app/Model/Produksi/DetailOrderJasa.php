<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class DetailOrderJasa extends Model
{
  protected $table = 'p_detail_order_jasa';

  protected $fillable = ['id_order_jasa','id_jasa','id_barang','qty','biaya','diskon','total_biaya','ket','id_perusahaan','id_karyawan'];

  public function getJasa(){
    return $this->belongsTo('App\Model\Produksi\Jasa', 'id_jasa');
  }
  public function getBarang(){
    return $this->belongsTo('App\Model\Produksi\Barang', 'id_barang');
  }
}
