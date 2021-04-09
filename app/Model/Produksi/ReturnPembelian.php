<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class ReturnPembelian extends Model
{
    //
    protected $table = "p_return_pembelian";

    protected $fillable = ['id_cek_barang','tgl_return','jenis_return','ongkir_return','konfirm','status_return','id_perusahaan','id_karyawan'];

}
