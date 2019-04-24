<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table="p_barang";

    protected $fillable = ['id_kategori_produk','id_subkategori_produk','id_subsubkategori_produk','nm_barang','spec_barang','desc_barang','expired_date','stok_barang','diskon','harga_jual','id_perusahaan','id_karyawan'];

    public function getkategori(){
        return $this->belongsTo('App\Model\Superadmin_sim\P_kategori_produk','id_kategori_produk');
    }
    public function getsubkategori(){
        return $this->belongsTo('App\Model\Superadmin_sim\P_subkategori_produk','id_subkategori_produk');
    }
    public function getsubsubkategori(){
        return $this->belongsTo('App\Model\Superadmin_sim\P_subsubkategori_produk','id_subsubkategori_produk');
    }
}
