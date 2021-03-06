<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_rencana_pelatihan extends Model
{
    //
    protected $table = "h_rencana_pelatihan";

    protected $fillable=["thn_anggaran","tema","tgl_pelatihan","biaya","id_perusahaan","id_karyawan"];

    public function karyawan_pelatihan()
    {
        return $this->hasMany('App\Model\Hrd\H_Karyawan_pelatihan','id_rencana_pel');
    }

}
