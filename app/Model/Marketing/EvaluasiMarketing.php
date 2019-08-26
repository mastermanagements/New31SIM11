<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class EvaluasiMarketing extends Model
{
    protected $table="m_evaluasi_marketing";

    protected $fillable = ['id_kriteria_evaluasi','dimensi','id_indikator_evaluasi','jenis_content','link_url','id_solusi_evaluasi','ket'];
	
	public function getKevaluasi(){
		return $this->belongsTo('App\Model\Marketing\KriteriaEvaluasi','id_kriteria_evaluasi');
	}
	public function getIevaluasi(){
        return $this->belongsTo('App\Model\Marketing\IndikatorEvaluasi','id_indikator_evaluasi');
    }
	public function getSevaluasi(){
        return $this->belongsTo('App\Model\Marketing\SolusiEvaluasi','id_solusi_evaluasi');
    }
}
