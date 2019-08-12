<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class PersenKas extends Model
{
    //
    protected $table="i_persen_kas";

    protected $fillable =[
        'thn',
        'persen_kas',
        'id_perusahaan',
        'id_karyawan',
    ];
}
