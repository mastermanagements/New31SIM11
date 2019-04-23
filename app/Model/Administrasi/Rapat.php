<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class Rapat extends Model
{
    //
    protected $table="a_rapat";

    protected $fillable = ['id_ub','tgl_rapat','pilihan_rapat','keterangan','id_perusahaan','id_karyawan'];

    public function getKy(){
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan', 'id_karyawan');
    }
}
