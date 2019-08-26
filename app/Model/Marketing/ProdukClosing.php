<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class ProdukClosing extends Model
{
    protected $table="m_produk_closing";

    protected $fillable = ['id_closing','id_barang','id_jasa'];
}
