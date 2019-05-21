<?php

namespace App\Model\Superadmin_sim;

use Illuminate\Database\Eloquent\Model;

class P_subkategori_produk extends Model
{
    //
    protected $table = "p_subkategori_produk";

    protected $fillable = ["id_kategori_produk","nm_subkategori_produk"];

    public function getKategori(){
        return  $this->belongsTo('App\Model\Superadmin_sim\P_kategori_produk','id_kategori_produk');
    }
}
