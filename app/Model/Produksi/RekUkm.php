<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class RekUkm extends Model
{
  protected $table="p_rek_ukm";

  protected $fillable = ['nama_bank','no_rek','atas_nama','kcp','id_perusahaan','id_karyawan'];

  public function getBayarBeli()
  {
    return $this->hasMany('App\Model\Produksi\Bayar','bank_asal','id');
  }
}
