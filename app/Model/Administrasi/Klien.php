<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
	//public $timestamps = false;
	
    protected $table = "a_klien";
	
    protected $fillable = ['nm_klien','alamat','pekerjaan','hp','wa','email','teleg','ig','fb','twiter','nm_perusahaan','alamat_perusahaan','telp_perusahaan','jabatan','jenis_klien','id_sdk','id_penanda_sdk','tambahan_sdk','id_perusahaan','id_karyawan'];
	
	public function getSDK()
    {
        return $this->belongsTo('App\Model\Marketing\SumberDataKlien','id_sdk');
    }
	public function getPenandaSDK()
    {
        return $this->belongsTo('App\Model\Marketing\PenandaSDK','id_penanda_sdk');
    }
}
