<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_tenaga_kerja extends Model
{
    protected $table = "h_tenaga_ahli";

    protected $fillable = ['id_ky','lembaga_sertifikasi','no_sertifikat','klasifikasi','no_registrasi','ditetapkan','tgl_penetapan','masa_berlaku','asosiosi','no_anggota','posisi_proyek','id_perusahaan','id_karyawan'];

    public function karyawan(){
        return $this->belongsTo('App\Model\Superadmin_ukm\H_karyawan','id_ky');
    }
}
