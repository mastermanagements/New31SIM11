<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class RekSupplier extends Model
{
  protected $table="p_rek_supplier";

  protected $fillable = ['id_supplier','nama_bank','no_rek','atas_nama','kcp','id_perusahaan','id_karyawan'];
}
