<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class ContentMarketing extends Model
{
	 protected $table ="m_content_marketing";
    protected $fillable =['id_submedia_marketing','content_marketing'];
	
	public function kegiatan_marketing(){
		return $this->hasMany('App\Model\Marketing\KegMarketing','id_content_marketing');
	}
}
