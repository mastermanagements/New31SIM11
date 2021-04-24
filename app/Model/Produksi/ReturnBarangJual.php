<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class ReturnBarangJual extends Model
{
    //
    protected $table='p_return_penjualan';

    protected $fillable = ['id_complain_barang','tgl_return','jenis_return','ongkir_return','konfirm','status_return','id_perusahaan','id_karyawan'];
}
