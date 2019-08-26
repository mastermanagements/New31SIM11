<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class PolaTargeting extends Model
{
    protected $table="m_pola_targeting";

    protected $fillable = ['nm_pola_targeting','positif','negatif'];
	
}
