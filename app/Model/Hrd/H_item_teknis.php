<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_item_teknis extends Model
{
    //

    protected $table="h_item_teknis";

    protected $fillable=['id_kompetensi_teknis','item_kompetensi_t','id_perusahaan','id_karyawan'];

    public function kompetensi_teknis(){
        return $this->belongsTo('App\Model\Hrd\H_kompetensi_teknis','id_kompetensi_teknis');
    }
}
