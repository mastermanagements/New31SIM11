<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_item_kmanajerial extends Model
{
    //
    protected $table="h_item_kmanaherial";

    protected $fillable= ['id_kompetensi_m','item_kompetensi_m','id_perusahaan','id_karyawan'];

    public function kompetensi_m(){
        return $this->belongsTo('App\Model\Hrd\H_kompetensi_manajerial','id_kompetensi_m');
    }
}
