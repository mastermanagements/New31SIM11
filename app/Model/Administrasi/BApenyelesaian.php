<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class BApenyelesaian extends Model
{
    //
    protected $table="a_ba_penyelesaian";

    protected $fillable = ['id_spk','isi_bapeny','file_bapeny','scan_file','id_perusahaan','id_karyawan'];

    public function getSPK()
    {
        return $this->belongsTo('App\Model\Administrasi\SPKKontrak','id_spk');
    }
}
