<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class StatusClosing extends Model
{
    protected $table="m_status_closing";

    protected $fillable = ['id_closing','tool_closing','content_closing','respon_klien','hasil_akhir','id_bagian','id_divisi','status_closing','ket'];
	
	public function getBagian()
    {
        return $this->belongsTo('App\Model\Karyawan\Bagian','id_bagian');
    }
	public function getDivisi()
    {
        return $this->belongsTo('App\Model\Karyawan\Devisi','id_divisi');
    }
	
	
}
