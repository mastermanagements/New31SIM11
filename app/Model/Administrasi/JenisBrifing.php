<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class JenisBrifing extends Model
{
    //
    protected $table="a_jenis_rapat";

    protected $fillable=['id','jenis_rapat','id_perusahaan'];
}
