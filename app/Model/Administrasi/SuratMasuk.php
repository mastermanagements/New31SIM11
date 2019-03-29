<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    //
    protected $table = "a_surat_masuk";

    protected $fillable = ['tgl_surat_masuk','hal','dari','ditujukan','file_surat','id_perusahaan','id_karyawan'];

    public function getJabatan()
    {
        return $this->belongsTo('App\Model\Superadmin_ukm\U_jabatan_p','ditujukan');
    }

}
