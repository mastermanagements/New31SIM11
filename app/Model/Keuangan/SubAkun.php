<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class SubAkun extends Model
{
    //

    protected $table="k_sub_akun_ukm";

    protected $fillable = [
      'id_akun_ukm',
      'id_m_sub_akun',
      'kode_sub_akun',
      'nm_sub_akun',
      'off_on',
	  'posisi_saldo',
      'id_perusahaan',
      'id_karyawan'
	 
    ];


    public function linktoakunUkm(){
        return $this->belongsTo('App\Model\Keuangan\Akun','id_akun_ukm');
    }

    public function subsub_ukm(){
        return $this->hasMany('App\Model\Keuangan\SubSubAkun','id_sub_akun_ukm','id');
    }

    public function id_sub_akun_aktif(){
        return $this->hasMany('App\Model\Keuangan\AkunAktifUkm','id_sub_akun','id');
    }

    public function getOneJurnal(){
        return $this->hasOne('App\Model\Keuangan\AkunAktifUkm','id_sub_akun','id');
    }


}
