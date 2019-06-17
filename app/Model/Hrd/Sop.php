<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class Sop extends Model
{
    //
    protected $table="h_sop";

    protected $fillable = ["nm_sop","isi_sop","id_karyawan","id_perusahaan"];
}
