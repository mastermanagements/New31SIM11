<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class SubSubAkun extends Model
{
    protected $table="k_subsub_akun_ukm";
	
	protected $fillable = ['id_sub_akun_ukm','id_sub_sub_master_akun','kode_subsub_akun','nm_subsub_akun','off_on','status_alur_kas','id_perusahaan','id_karyawan'];

    public function getSubAkun(){
        return $this->belongsTo('App\Model\Keuangan\SubAkun','id_sub_akun_ukm');
    }

}
