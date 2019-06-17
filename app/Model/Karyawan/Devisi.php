<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class Devisi extends Model
{

    protected $table="u_devisi_p";
    protected $fillable = ['id_bagian_p','nm_devisi','id_perusahaan','id_karyawan'];
	
	 public function getBagian()
    {
        return $this->belongsTo('App\Model\Karyawan\Bagian','id_bagian_p');
    }

}
