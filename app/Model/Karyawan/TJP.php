<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class TJP extends Model
{
   protected $table="u_target_jp";
   protected $fillable = ['nm_tjp','periode','thn_mulai','thn_selesai','isi_tjp','id_perusahaan','id_karyawan'];

	 public function getSJP(){
        return $this->hasOne('App\Model\Karyawan\SJP','id_tjp');
    }
	public function getTargetTahunan(){
		return $this->hasMany('App\Model\Karyawan\TargetTahunan','id_tjp');
	} 
}
