<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table="p_barang";

    protected $fillable = ['id_kategori_produk', 'id_subkategori_produk','id_subsubkategori_produk','kd_barang','barcode','nm_barang','id_satuan','spec_barang','desc_barang'
//        ,'expired_date'
        ,'no_rak'
//        ,'stok_awal'
        ,'stok_minimum','stok_akhir','hpp','metode_jual','gambar','id_perusahaan','id_karyawan'];

    public function getkategori(){
        return $this->belongsTo('App\Model\Superadmin_sim\P_kategori_produk','id_kategori_produk');
    }

    public function getsubkategori(){
        return $this->belongsTo('App\Model\Superadmin_sim\P_subkategori_produk','id_subkategori_produk');
    }

    public function getsubsubkategori(){
        return $this->belongsTo('App\Model\Superadmin_sim\P_subsubkategori_produk','id_subsubkategori_produk');
    }

    public function linkToSatuan(){
        return $this->belongsTo('App\Model\Produksi\SatuanBarang', 'id_satuan');
    }

    public function linkToHargaJualSatuan(){
        return $this->hasMany('App\Model\Produksi\HargaJualSatuan','id_barang','id');
    }

    public function linkToHargaBaseOnJumlah(){
        return $this->hasMany('App\Model\Produksi\HargaJualBaseOnJumlah','id_barang','id');
    }
}
