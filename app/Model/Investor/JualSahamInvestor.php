<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class JualSahamInvestor extends Model
{
    //
    protected $table = "i_investor_jual_saham";

    protected $fillable=[
        'tgl_jual_s',
        'id_periode_invest',
        'id_investor_penjual',
        'lembar_saham_penjual',
        'jumlah_dijual',
        'id_investor_pembeli',
        'id_perusahaan',
        'id_karyawan',
    ];
}
