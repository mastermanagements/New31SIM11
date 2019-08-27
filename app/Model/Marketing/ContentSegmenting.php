<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class ContentSegmenting extends Model
{
    protected $table="m_content_segmenting";

    protected $fillable = ['id_subsub_segmenting, content_segmenting','jenis_marketing'];
	
	public function getSubSubSegmenting(){
        return $this->belongsTo('App\Model\Marketing\SubSubSegmenting','id_subsub_segmenting');
    }
	public function getHasilSegmenting(){
        return $this->hasMany('App\Model\Marketing\HasilSegmenting','id_content_segmenting');
    }
}
