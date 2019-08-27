<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class SubSubSegmenting extends Model
{
    protected $table="m_subsub_segmenting";

    protected $fillable = ['id_sub_segmenting,item_subsub_segmenting','jenis_marketing'];
	
	public function getContentSegmenting(){
        return $this->hasOne('App\Model\Marketing\ContentSegmenting','id_subsub_segmenting');
    }
	public function getSubSegmenting(){
        return $this->belongsTo('App\Model\Marketing\SubSegmenting','id_sub_segmenting');
    }
}
