<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_item_wawancara extends Model
{
    //
    protected $table = "h_item_wawancara";

    protected $fillable = ['item_wawancara','id_perusahaan','id_karyawan'];
}
