<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class JawabanTargeting extends Model
{
    protected $table="m_jawaban_targeting";

    protected $fillable = ['id_targeting','id_pertanyaan_targeting','jawaban_kriteria'];
	
	public function getTargeting(){
        return $this->belongsTo('App\Model\Marketing\Targeting','id_targeting');
    }
}
