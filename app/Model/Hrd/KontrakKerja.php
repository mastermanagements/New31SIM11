<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class KontrakKerja extends Model
{
    //
    protected $table="h_kontrak_kerja";

    protected $fillable=["id_ky","id_jenis_kontrak","no_kontrak","tgl_mulai","tgl_selesai","ket","file_kontrak","scan_kontrak","id_perusahaan","id_karyawan"];

    public function karyawan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','id_ky');
    }
}
