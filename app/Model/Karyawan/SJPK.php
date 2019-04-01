<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;
use Zend\Diactoros\Request;

class SJPK extends Model
{
    //

    protected $table="u_strategi_jpd";

    protected $fillable=["id_sjpg","id_bagian_p","id_divisi_p","periode","isi_spjd","id_perusahaan","id_karyawan"];

    public function getBagian(){
        return $this->belongsTo('App\Model\Karyawan\Bagian','id_bagian_p');
    }

    public function getDivisi()
    {
        return $this->belongsTo('App\Model\Karyawan\Devisi','id_divisi_p');
    }
}
