<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class JobDecs extends Model
{
    //

    protected $table = "u_job_desc";

    protected $fillable = ['id_jabatan_p','job_desc','id_perusahaan','id_karyawan'];
	
	 public function getJabatan()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\U_jabatan_p', 'id_jabatan_p');
    }
}
