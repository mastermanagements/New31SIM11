<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    //
    protected $table = "a_surat_keluar";

    protected $fillable = ['jenis_surat','no_surat_keluar','hal','ditujukan','isi_surat','status_surat','tgl_dikirim','scan_file','id_perusahaan','id_karyawan'];

    public function getJenisSurat()
    {
        return $this->belongsTo('App\Model\Administrasi\JenisSurat','jenis_surat');
    }
}
