<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class TugasJobdesc extends Model
{
    //
    protected $table = "u_tugas_jobdesc";

    protected $fillable = ['id_jobdesc','item_tugas','id_perusahaan','id_karyawan'];

   public function getJobdesc()
    {
        return $this->belongsTo('App\Model\Karyawan\Jobdesc', 'id_jobdesc');
    }
}
