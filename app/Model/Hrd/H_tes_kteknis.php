<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_tes_kteknis extends Model
{
    //
    protected $table="h_tes_kteknis";

    protected $fillable=['thn_tes_kt','id_ky','id_kompetensi_t','id_item_kt',
        'nilai_kt','id_perusahaan','id_karyawan'];

    public function kompetensi_teknis(){
        return $this->belongsTo('App\Model\Hrd\H_kompetensi_teknis','id_kompetensi_t');
    }

    public function item_t(){
        return $this->belongsTo('App\Model\Hrd\H_item_teknis','id_kompetensi_t');
    }
}
