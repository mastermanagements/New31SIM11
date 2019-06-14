<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class SWOT extends Model
{
    //

    protected $table="u_swot";

    protected $fillable=["tahun_swot","kategori_swot","isi","id_perusahaan","id_karyawan"];
}
