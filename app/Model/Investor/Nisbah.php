<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class Nisbah extends Model
{
    //

    protected $table="i_nisbah";

    protected $fillable = [
        'id_periode_invest',
        'pelaksana',
        'pemodal',
        'id_perusahaan',
        'id_karyawan',
    ];

}
