<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
    //

    protected $table = "a_klien";

    protected $fillable = ['nm_klien','alamat','pekerjaan','hp','wa','email','teleg','ig','fb','twiter','nm_perusahaan',
        'alamat_perusahaan','telp_perusahaan','jabatan','id_perusahaan','id_karyawan'];
}
