<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class SJP extends Model
{
   protected $table="u_strategi_jp";
   protected $fillable = ['id_tjp','isi_sjp','id_perusahaan','id_karyawan'];

	public function getTJP()
   {
		return $this->belongsTo('App\Model\Karyawan\TJP','id_tjp');
   }
   /* public function getStrategiTahunan()
   {
       return $this->hasMany('App\Model\Karyawan\StrategiTahunan','id_sjpg');
   } */
   
}
