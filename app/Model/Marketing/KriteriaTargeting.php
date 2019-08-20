<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class KriteriaTargeting extends Model
{
    protected $table="m_kriteria_targeting";

    protected $fillable = ['kriteria_utama','isi_kriteria'];
	
}
