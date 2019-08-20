<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class RencanaMarketing extends Model
{
    protected $table ="m_rencana_marketing";
	
	protected $fillable =['tahun','bulan','off_on'];
}
