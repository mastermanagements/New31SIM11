<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table ="a_pengumuman";
	protected $fillable =['tgl_dibuat','isi_p','id_perusahaan','id_karyawan'];
	
	public function getKaryawan()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','id_karyawan');
    }
}
