<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class RmSTP extends Model
{
    protected $table ="m_rm_stp";
	
	protected $fillable =['id_rm','id_targeting','id_positioning'];
}
