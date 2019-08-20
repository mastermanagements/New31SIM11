<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class PertanyaanTargeting extends Model
{
    protected $table="m_pertanyaan_targeting";

    protected $fillable = ['id_kriteria_targeting','pertanyaan_kriteria'];
	
}
