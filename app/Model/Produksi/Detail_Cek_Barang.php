<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class Detail_Cek_Barang extends Model
{
    //
    protected $table = 'p_detail_cek_barang';
    protected $fillable = ['id_order','id_cek_barang','id_barang','harga_beli','jumlah_beli','diskon_item','jumlah_harga','cek_jumlah','cek_kualitas','ket','status_return','alasan_ditolak','id_perusahaan','id_karyawan'];

    public function linkToBarang()
    {
        # code...
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }

}
