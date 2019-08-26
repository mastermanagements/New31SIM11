<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class SumberDataKlien extends Model
{
    protected $table="m_sumber_data_klien";

    protected $fillable = ['sumber_data','sumber_media'];
	
	public function getPenanda(){
        return $this->hasMany('App\Model\Marketing\PenandaSDK','id_sdk');
    }
}
