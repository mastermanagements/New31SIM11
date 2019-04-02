<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class A_Jenis_Proposal extends Model
{
    //
    protected $table = "a_jenis_proposal";
    protected $fillable = ['jenis_proposal','id_perusahaan','id_karyawan'];
}
