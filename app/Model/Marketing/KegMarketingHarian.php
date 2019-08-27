<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class KegMarketingHarian extends Model
{
     protected $table ="m_keg_marketing_harian";
	
	protected $fillable =['id_pel_m','id_keg_marketing'];
	
	public function getKegMarketing()
    {
        return $this->belongsTo('App\Model\Marketing\KegMarketing','id_keg_marketing');
    }
	public function getPelMarketing()
    {
        return $this->belongsTo('App\Model\Marketing\PelMarketing','id_pel_m');
    }
}
