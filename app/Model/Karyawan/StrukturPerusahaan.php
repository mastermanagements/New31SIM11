<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class StrukturPerusahaan extends Model
{
    //
    protected $table='struktur_perusahaan';

    protected $fillable = ['parentId','id_karyawan','id_jabatan','id_perusahaan'];

    public function getKaryawan()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','id_karyawan');
    }

    public function getJabatan()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\U_jabatan_p','id_jabatan');
    }
}
