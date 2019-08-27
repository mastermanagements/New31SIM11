<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class PenandaSDK extends Model
{
    protected $table="m_penanda_sdk";

    protected $fillable = ['id_sdk','penanda'];
	
	public function getSDK()
    {
        return $this->belongsTo('App\Model\Marketing\SumberDataKlien','id_sdk');
    }
}
