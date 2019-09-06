<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class SubSubAkun extends Model
{
    protected $table="k_subsub_akun_ukm";
	
	protected $fillable = ['id_sub_akun_ukm','id_sub_sub_master_akun','kode_subsub_akun','nm_subsub_akun','off_on','id_perusahaan','id_karyawan'];
}
