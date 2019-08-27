<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class KegMarketing extends Model
{
    protected $table ="m_keg_marketing";
	
	protected $fillable =['id_content_marketing','jenis_keg_marketing','keg_marketing'];
}
