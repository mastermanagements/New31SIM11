<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class RencanaMarketingJasa extends Model
{
    protected $table="m_rencana_marketing_jasa";

    protected $fillable = ['id_rencana_pend_jasa','jum_klien_lama','jum_klien_baru','ket','id_perusahaan','id_karyawan'];

	public function getRencanaPendJasa(){
        return $this->belongsTo('App\Model\Keuangan\RencanaPendJasa','id_rencana_pend_jasa');
    }
}
