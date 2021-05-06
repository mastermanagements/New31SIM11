<?php

namespace App\Model\Manufaktur;

use Illuminate\Database\Eloquent\Model;

class P_item_overhead extends Model
{
    //

    protected $table = 'p_item_over_head';

    protected $fillable = ['item_overhead','id_perusahaan','id_karyawan'];
}
