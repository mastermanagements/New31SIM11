<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    //
    protected $table = 'p_detail_order';

    protected $fillable = ['id_order','id_barang','harga_beli','jumlah_beli','diskon_item','jumlah_harga','expired_date','id_perusahaan','id_karyawan'];

    public function linkToBarang()
    {
        # code...
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }

    public function linkToOrder(){
        return $this->belongsTo('App\Model\Produksi\POrder','id_order');
    }
    public function linkToDetailCek(){
        return $this->hasOne('App\Model\Produksi\Detail_Cek_Barang','id_order');
    }


}
