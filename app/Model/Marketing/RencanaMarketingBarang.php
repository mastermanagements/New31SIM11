<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class RencanaMarketingBarang extends Model
{
    protected $table="m_rencana_marketing_brg";

    protected $fillable = ['id_rencana_pend_brg','jum_klien_lama','jum_klien_baru','ket','id_perusahaan','id_karyawan'];

	public function getRencanaPendBarang(){
        return $this->belongsTo('App\Model\Keuangan\RencanaPendBarang','id_rencana_pend_brg');
    }
}
