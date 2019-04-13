<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class BAsertim extends Model
{
    //
    protected $table = "a_ba_sertim";

    protected $fillable =['id_spk','isi_basertim','file_basertim','scan_file','id_perusahaan','id_karyawan'];

    public function getSPK()
    {
        return $this->belongsTo('App\Model\Administrasi\SPKKontrak','id_spk');
    }
}
