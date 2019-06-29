<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_hasil_tes extends Model
{
    //
    protected $table = "h_hasil_tes";

    protected $fillable = ['id_lamaran_p','ket','id_perusahaan','id_karyawan'];

    public function lamaran(){
        return $this->belongsTo('App\Model\Hrd\H_lamaran_pek', 'id_lamaran_p');
    }
}
