<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_kompetensi_manajerial extends Model
{
    //
    protected $table = "h_kompetensi_majerial";

    protected $fillable=['id_jenis_kompetensi','nm_kompetensi_m','id_perusahaan','id_karyawan'];

    public function jenis_kompetensi(){
        return $this->belongsTo('App\Model\Hrd\H_jenis_kompetensi','id_jenis_kompetensi');
    }
}
