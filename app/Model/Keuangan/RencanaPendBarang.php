<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class RencanaPendBarang extends Model
{
    protected $table="k_rencana_pend_barang";
	
	protected $fillable = ['tahun','bulan','id_barang','target_brg_terjual','target_klien_beli','id_perusahaan','id_karyawan'];
	
}
