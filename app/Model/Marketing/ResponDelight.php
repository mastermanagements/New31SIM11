<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class ResponDelight extends Model
{
     protected $table="m_respon_delight";

    protected $fillable = ['id_delight','respon_klien','id_bagian','id_divisi'];
	
	public function getBagian()
    {
        return $this->belongsTo('App\Model\Karyawan\Bagian','id_bagian');
    }
	public function getDivisi()
    {
        return $this->belongsTo('App\Model\Karyawan\Devisi','id_divisi');
    }
	
}
