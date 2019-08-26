<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class G_tambahan_gaji extends Model
{
    //
    protected $table="g_tambahan_gaji";

    protected $fillable=['id_ky','id_slip','keterangan','jumlah_uang','id_perusahaan','id_karyawan'];

}
