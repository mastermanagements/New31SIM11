<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class ResponLeads extends Model
{
    protected $table ="m_respon_leads";
	
	protected $fillable = ['id_pel_m','jum_like','jum_comment','jum_share','jum_follower','ket'];
}
