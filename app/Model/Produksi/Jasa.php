<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    //
    protected $table="p_jasa";

    protected $fillable = ["id_kategori_produk","id_subkategori_produk","id_subsubkategori_produk","nm_jasa","harga_jasa","rincian_jasa","id_perusahaan","id_karyawan"];

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
