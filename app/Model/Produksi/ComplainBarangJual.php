<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class ComplainBarangJual extends Model
{
    //
    protected $table = 'p_complain_barang';

    protected $fillable = [
        'id_sales',
        'id_detail_sales',
        'id_barang',
        'hpp',
        'jumlah_beli',
        'diskon_item',
        'complain_jumlah',
        'complain_kualitas',
        'total_return',
        'ket',
        'status_complain',
        'alasan_ditolak',
        'konfirm_klien',
        'id_perusahaan',
        'id_karyawan',
    ];
    public function linkToSales(){
        return $this->belongsTo('App\Model\Produksi\PSales','id_sales');
    }

    public function linkToBarang(){
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }
}
