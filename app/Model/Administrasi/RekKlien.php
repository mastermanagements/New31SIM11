<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class RekKlien extends Model
{
  protected $table="a_rek_klien";

  protected $fillable = ['id_klien','nama_bank','no_rek','atas_nama','kcp','id_perusahaan','id_karyawan'];

  public function getBayarJual()
  {
    return $this->hasMany('App\Model\Produksi\PTerimaBayar','bank_asal','id');
  }
  public function linkToKlien()
  {
    return $this->belongsTo('App\Model\Administrasi\Klien','id_klien');
  }
}
