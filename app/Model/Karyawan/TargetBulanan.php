<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class TargetBulanan extends Model
{
    protected $table = "u_target_bulanan";
	protected $fillable = ['id_target_tahunan','bulan','target_bulanan','id_perusahaan','id_karyawan'];
	
	public function getTargetTahunan(){
		return $this->belongsTo('App\Model\Karyawan\TargetTahunan', 'id_target_tahunan');
	}
	public function getStrategiBulanan(){
		return $this->hasOne('App\Model\Karyawan\StrategiBulanan', 'id_target_bulanan');
	}
}

