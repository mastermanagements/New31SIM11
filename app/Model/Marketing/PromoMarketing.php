<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class PromoMarketing extends Model
{
    protected $table="m_promo_marketing";

    protected $fillable = ['id_rencana_marketing_brg','id_rencana_marketing_jasa','tgl_promo','tgl_mulai','tgl_selesai','metode_marketing','target_pengguna','media_marketing','detail_media','isi_promosi','id_perusahaan','id_karyawan'];

    public function getRencanaMarketingBarang(){
        return $this->hasOne('App\Model\Marketing\m_rencana_marketing_brg','id_rencana_marketing_brg');
    }
	public function getRencanaMarketingJasa(){
        return $this->hasOne('App\Model\Marketing\m_rencana_marketing_jasa','id_rencana_marketing_jasa');
    }
}
