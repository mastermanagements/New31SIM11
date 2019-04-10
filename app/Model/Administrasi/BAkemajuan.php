<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class BAkemajuan extends Model
{
    //
    protected $table = "a_ba_kemajuan";

    protected $fillable=['id_spk','isi_bak','file_bakem','scan_file','id_perusahaan','id_karyawan'];

    public function getSPK()
    {
        return $this->belongsTo('App\Model\Administrasi\SPKKontrak','id_spk');
    }
}
