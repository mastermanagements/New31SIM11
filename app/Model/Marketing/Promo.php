<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    //

    protected $table="m_promo";

    protected $fillable = ['jenis_promo','nama_promo','syarat','fasilitas_promo','tgl_dibuat','tgl_berlaku','id_perusahaan'];

    public function linkToDetailBarang(){
        return $this->hasMany('App\Model\Marketing\DetailPromo','id_promo','id');
    }
    public function linkToDetailJasa(){
        return $this->hasMany('App\Model\Marketing\DetailPromo','id_promo','id');
    }
}
