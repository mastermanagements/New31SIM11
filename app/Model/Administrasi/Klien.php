<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
	//public $timestamps = false;

    protected $table = "a_klien";

    protected $fillable = ['nm_klien','alamat','pekerjaan','hp','wa','email','teleg','ig','fb','twiter','nm_perusahaan','alamat_perusahaan','telp_perusahaan','jabatan','id_group','status_diskon','id_perusahaan','id_karyawan'];

    public function linkToMannyGroupKlien(){
        return $this->belongsTo('App\Model\Administrasi\GroupKlien','id_group');
    }
	public function linkToMannyDiskon(){
        return $this->belongsTo('App\Model\Administrasi\GroupKlien','id_group');
    }

	public function linkToSO()
    {
        return $this->hasMany('App\Model\Produksi\PSO','id_klien','id');
    }
}
