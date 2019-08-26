<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class SubSubAkun extends Model
{
    protected $table="k_subsub_akun";
	
	protected $fillable = ['id_akun','kode_sub_akun','nm_sub_akun','id_perusahaan','id_karyawan'];
}
