<?php

namespace App\Model\Karyawan;

use Illuminate\Database\Eloquent\Model;

class SWOT extends Model
{
    //

    protected $table="u_swot";

    protected $fillable=["tahun_swot","kategori_swot","Isi","id_perusahaan","id_karyawan"];
}
