<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class SubSegmenting extends Model
{
    protected $table="m_sub_segmenting";

    protected $fillable = ['id_segmenting','item_sub_segmenting'];
	
	public function getSegmenting(){
        return $this->belongsTo('App\Model\Marketing\Segmenting','id_segmenting');
    }
	
	public function getSubSubSegmenting(){
        return $this->hasOne('App\Model\Marketing\SubSubSegmenting','id_sub_segmenting');
    }
	
}
