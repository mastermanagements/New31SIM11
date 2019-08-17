<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class Akad extends Model
{
    //

    protected $table = "i_akad";

    protected $fillable = ['nm_file','file_akad','id_perusahaan','id_karyawan'];
}
