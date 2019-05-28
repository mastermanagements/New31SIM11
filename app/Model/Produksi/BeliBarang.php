<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class BeliBarang extends Model
{
    //
    protected $table="p_beli_barang";

    protected $fillable = ["no_order","no_faktur","tgl_beli","id_barang","id_suplier","jumlah_barang","harga_beli","id_perusahaan","id_karyawan"];

    public function getBarang(){
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }

    public function getSupplier(){
        return $this->belongsTo('App\Model\Produksi\Supplier','id_suplier');
    }
}
