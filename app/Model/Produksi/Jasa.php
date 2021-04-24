<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
  protected $table="p_jasa";

  protected $fillable = ['nm_layanan','peritem','id_satuan','waktu_kerja','satuan_waktu','waktu_selesai','biaya','ket','id_perusahaan','id_karyawan'];

  public function getSatuan(){
      return $this->belongsTo('App\Model\Produksi\Satuan','id_satuan');
  }
  public function getSatuanWaktu(){
      return $this->belongsTo('App\Model\Produksi\Satuan','satuan_waktu');
  }
}
