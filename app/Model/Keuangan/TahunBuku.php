<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class TahunBuku extends Model
{
    //
    protected $table = "k_tahun_buku";

    protected $fillable = ["bln_buku","thn_buku","status","id_perusahaan","id_karyawan"];
}
