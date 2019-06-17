<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class AgendaHarian extends Model
{
    protected $table = "a_agenda_harian";

    protected $fillable = ['tgl_agenda','id_jobdesc','id_target_bulanan','agenda','id_perusahaan','id_karyawan'];

    public function getJobDesc()
    {
        return $this->belongsTo('App\Model\Karyawan\JobDesc','id_jobdesc');
    }
	
	public function getTargetBulanan()
    {
        return $this->belongsTo('App\Model\Karyawan\TargetBulanan','id_target_bulanan');
    }
}
