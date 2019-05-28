<?php

namespace App\Model\Superadmin_sim;

use Illuminate\Database\Eloquent\Model;

class P_subsubkategori_produk extends Model
{
    //
    protected $table="p_subsubkategori_produk";

    protected $fillable = ["id_subkategori_produk","nm_subsub_kategori_produk"];

    public function getSubKategori(){
        return $this->belongsTo('App\Model\Superadmin_sim\P_subkategori_produk','id_subkategori_produk');
    }
}
