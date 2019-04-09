<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class BApemeriksaan extends Model
{
    //
    protected $table="a_ba_pemeriksaan";

    protected $fillable = ['id_spk','isi_bapem','scan_file','id_perusahaan','id_karyawan'];

    public function getSPK()
    {
        return $this->belongsTo('App\Model\Administrasi\SPKKontrak','id_spk');
    }
}
