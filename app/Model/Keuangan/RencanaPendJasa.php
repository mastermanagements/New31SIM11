<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class RencanaPendJasa extends Model
{
    protected $table="k_rencana_pend_jasa";
	
	protected $fillable = ['tahun','bulan','id_jasa','target_jasa_terjual','target_klien_beli','id_perusahaan','id_karyawan'];
	
	public function getDataJasa()
	{
		return $this->belongsTo('App\Model\Produksi\Jasa','id_jasa');
	}
}
