<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_tes_manajerial extends Model
{
    //
    protected $table = "h_tes_manajerial";

    protected $fillable =['id_ky','thn_tes_km','id_kompetensi_m','id_item_km','nilai_km','id_perusahaan','id_karyawan'];

    public function kompentensi_m(){
        return $this->belongsTo('App\Model\Hrd\H_kompetensi_manajerial','id_kompetensi_m');
    }

    public function item_km(){
        return $this->belongsTo('App\Model\Hrd\H_item_kmanajerial','id_item_km');
    }
}
