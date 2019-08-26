<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class HasilSegmenting extends Model
{
    protected $table="m_hasil_segmenting";

    protected $fillable = ['tahun','id_barang','id_jasa','id_content_segmenting','hasil_segmenting'];
	
	public function getContentSegmenting(){
        return $this->belongsTo('App\Model\Marketing\ContentSegmenting','id_content_segmenting');
    }
	public function getBarang(){
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }
	public function getJasa(){
        return $this->belongsTo('App\Model\Produksi\Jasa','id_jasa');
    }
	public function getTargeting(){
        return $this->hasOne('App\Model\Marketing\Targeting','id_hasil_segmenting');
    }
}
