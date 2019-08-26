<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_aspek_pa extends Model
{
    protected $table="h_aspek_pa";
    protected $fillable=["nm_aspek", "bobot", "id_perusahaan", "id_karyawan"];

}
