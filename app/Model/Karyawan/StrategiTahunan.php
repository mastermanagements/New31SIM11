<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class StrategiTahunan extends Model
{
   protected $table="u_strategi_tahunan";
   protected $fillable = ['id_sjp','id_target_tahunan','isi_stahunan','id_perusahaan','id_karyawan'];

	public function getSJP()
   {
		return $this->belongsTo('App\Model\Karyawan\SJP','id_sjp');
   }
   
   public function getStrategiBulanan()
   {
       return $this->hasMany('App\Model\Karyawan\StrategiBulanan','id_stahunan');
   }
}
