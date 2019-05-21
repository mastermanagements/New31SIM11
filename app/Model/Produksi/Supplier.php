<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $table="p_supplier";

    protected $fillable=["nama_suplier","cp_suplier","telp_suplier","hp_suplier","wa_suplier","id_perusahaan","id_karyawan"];

}
