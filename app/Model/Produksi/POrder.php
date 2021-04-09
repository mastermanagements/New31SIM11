<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class POrder extends Model
{
    //

    protected $table = 'p_order';

    protected $fillable = ['id_po','tgl_order','no_order','id_supplier','tgl_tiba','diskon_tambahan','pajak','dp_po','bayar','kurang_bayar','metode_bayar','tgl_jatuh_tempo','expired_date','ongkir','ket','total','id_perusahaan','id_karyawan'];

    public function linkToPO()
    {
        return $this->belongsTo('App\Model\Produksi\PesananPembelian','id_po');
    }

    public function linkToSuppliers()
    {
        return $this->belongsTo('App\Model\Produksi\Supplier','id_supplier');
    }

    public function linkToDetailOrder()
    {
        return $this->hasMany('App\Model\Produksi\DetailOrder','id_order','id');
    }

    public function linkToCekBarang()
    {
        return $this->hasOne('App\Model\Produksi\Cek_Barang','id_order');
    }

    public function linkToCekBarangDetail()
    {
        return $this->hasMany('App\Model\Produksi\Detail_Cek_Barang','id_order','id');
    }

    public function linkToBayar(){
        return $this->hasOne('App\Model\Produksi\Bayar','id_order', 'id');
    }

    public function linkToMannyBayar(){
        return $this->hasMany('App\Model\Produksi\Bayar','id_order', 'id');
    }
}
