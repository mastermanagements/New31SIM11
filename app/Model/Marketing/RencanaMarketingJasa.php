<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class RencanaMarketingJasa extends Model
{
    protected $table="m_rencana_marketing_jasa";

    protected $fillable = ['id_rab','id_rencana_pend_jasa','id_rincian_pend_jasa','jum_klien_lama','jum_klien_baru','ket','id_perusahaan','id_karyawan'];

    public function getRAB(){
        return $this->hasOne('App\Model\Keuangan\k_rab','id_rab');
    }
	public function getRencanaPendJasa(){
        return $this->hasOne('App\Model\Keuangan\k_rencana_pend_jasa','id_rencana_pend_jasa');
    }
	public function getRincianPendJasa(){
        return $this->hasOne('App\Model\Keuangan\k_rincian_pend_jasa','id_rincian_pend_jasa');
    }
}
