<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class PHistoryStokAkhir extends Model
{
    //
    protected $table = "p_history_saldo_akhir";

    protected $fillable = ['id_barang','tgl_transaksi','id_order','id_detail_order','id_sales','jumlah','harga_satuan','id_perusahaan','id_karyawan'];
}
