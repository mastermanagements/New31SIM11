<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class TJBJobdesc extends Model
{
  //
  protected $table = "u_tjb_jobdesc";

  protected $fillable = ['id_jobdesc','item_tjb','id_perusahaan','id_karyawan'];

 public function getJobdesc()
  {
      return $this->belongsTo('App\Model\Karyawan\Jobdesc', 'id_jobdesc');
  }
}
