<?php

namespace App\Model\Marketing;

use Illuminate\Database\Eloquent\Model;

class DetailPromo extends Model
{
    //
    protected $table = 'm_detail_promo';

    protected $fillable = ['id_promo','id_barang','id_jasa','hpp','diskon','minimum_beli','id_perusahaan'];
}
