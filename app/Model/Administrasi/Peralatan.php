<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    //
	protected $table ="a_peralatan";
	protected $fillable =['nm_alat','satuan','jumlah_alat','merk','tipe','thn_buat','tgl_beli','kondisi_alat','bukti_kepemilikan','file_bukti','id_perusahaan','id_karyawan'];
	
}