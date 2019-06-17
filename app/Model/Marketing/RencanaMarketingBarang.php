<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class RencanaMarketingBarang extends Model
{
    protected $table="m_rencana_marketing_brg";

    protected $fillable = ['id_rab','id_rencana_pend_brg','id_rincian_pend_brg','jum_klien_lama','jum_klien_baru','ket','id_perusahaan','id_karyawan'];

    public function getRAB(){
        return $this->hasOne('App\Model\Keuangan\k_rab','id_rab');
    }
	public function getRencanaPendBarang(){
        return $this->hasOne('App\Model\Keuangan\k_rencana_pend_barang','id_rencana_pend_brg');
    }
	public function getRincianPendBarang(){
        return $this->hasOne('App\Model\Keuangan\k_rincian_pend_barang','id_rincian_pend_brg');
    }
}
