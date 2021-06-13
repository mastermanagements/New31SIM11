<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class AkunAktifUkm extends Model
{
    //
    protected $table = "k_akun_aktif_ukm";
    
    protected $fillable = [
        'id_sub_akun',
        'id_subsub_akun',
        'kode_akun_aktif',
        'nm_akun_aktif',
		'status_alur_kas',
		'off_on',
		'posisi_saldo',
        'id_perusahaan',     
        'id_karyawan',
    ];

    public function getMannyJurnal(){
        return $this->hasMany('App\Model\Keuangan\Jurnal','id_akun_aktif','id');
    }

    public function sub_akun(){
        return $this->belongsTo('App\Model\Keuangan\SubAkun','id_sub_akun');
    }

    public function sub_sub_akun(){
        return $this->belongsTo('App\Model\Keuangan\SubSubAkun','id_subsub_akun');
    }

}
