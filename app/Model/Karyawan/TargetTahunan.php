<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class TargetTahunan extends Model
{
    //
	protected $table = "u_target_tahunan";
	protected $fillable = ['id_tjp','tahun','id_bagian_p','id_divisi_p','id_jabatan_p','target_tahunan','id_perusahaan','id_karyawan'];
	
	public function getTJP(){
		return $this->belongsTo('App\Model\Karyawan\TJP', 'id_tjp');
	}
	public function getBagian(){
		return $this->belongsTo('App\Model\Karyawan\Bagian', 'id_bagian_p');
	}
	public function getDivisi(){
		return $this->belongsTo('App\Model\Karyawan\Devisi', 'id_divisi_p');
	}
	public function getJabatan(){
		return $this->belongsTo('App\Model\Superadmin_ukm\U_jabatan_p', 'id_jabatan_p');
	}
	public function getStrategiTahunan(){
		return $this->hasOne('App\Model\Karyawan\StrategiTahunan', 'id_target_tahunan');
	}
	public function getTargetBulanan(){
		return $this->hasMany('App\Model\Karyawan\TargetBulanan', 'id_target_tahunan');
	}
	
}


