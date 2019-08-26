<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class PelMarketing extends Model
{
    protected $table ="m_pelaksanaan_marketing";
	
	protected $fillable =['id_rm_fase','tema_content'];

	public function getKegMarketHarian(){
        return $this->hasMany('App\Model\Marketing\KegMarketingHarian','id_pel_m');
    }
}
