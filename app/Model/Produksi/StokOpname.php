<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class StokOpname extends Model
{
    //
    protected $table = "p_stok_opname";

    protected $fillable = ['tgl_so','id_barang','stok_akhir','bukti_fisik','selisih','petugas','id_perusahaan','id_karyawan'];

    public function linkToBarang(){
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }
}
