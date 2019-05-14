<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_loker extends Model
{
    //
    protected $table="h_loker";

    protected $fillable = ["nm_loker","detail","tgl_buka","tgl_selesai","jumlah_pelamar","file_loker","id_perusahaan","id_karyawan"];

}
