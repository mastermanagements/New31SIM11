<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class PHistoryStokAwal extends Model
{
    protected $table = "p_history_saldo_awal";
    protected $fillable = ['id_barang','tgl_transaksi','id_order','id_detail_order','jumlah','harga_satuan','id_perusahaan','id_karyawan'];
}
