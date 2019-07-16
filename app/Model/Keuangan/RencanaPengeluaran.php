<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class RencanaPengeluaran extends Model
{
    protected $table="k_rencana_pengeluaran";
	
	protected $fillable = ['tahun','bulan','id_subsub_akun','jumlah_pengeluaran','id_perusahaan','id_karyawan'];
	
	public function getSubSubAkun()
	{
		return $this->belongsTo('App\Model\Keuangan\SubSubAkun','id_subsub_akun');
	}
}
