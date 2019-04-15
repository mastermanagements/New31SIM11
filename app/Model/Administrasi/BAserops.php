<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class BAserops extends Model
{
    //
    protected $table="a_ba_serops";

    protected $fillable = ['id_spk','isi_serops','scan_file','id_perusahaan','id_karyawan'];

    public function getSPK()
    {
        return $this->belongsTo('App\Model\Administrasi\SPKKontrak','id_spk');
    }
}
