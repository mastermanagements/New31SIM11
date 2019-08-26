<?php

namespace App\Model\MArketing;

use Illuminate\Database\Eloquent\Model;

class Targeting extends Model
{
    protected $table="m_targeting";

    protected $fillable = ['id_hasil_segmenting','id_pola_targeting'];
	
	public function getPolaTargeting(){
        return $this->belongsTo('App\Model\Marketing\PolaTargeting','id_pola_targeting');
    }
}
