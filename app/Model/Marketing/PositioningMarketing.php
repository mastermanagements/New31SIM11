<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class PositioningMarketing extends Model
{
    protected $table="m_positioning_marketing";
	
    protected $fillable = ['posisi_perusahaan','ket'];
	
}
