<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class G_potongan_tambahan extends Model
{
    //

    protected $table="g_potongan_tambahan";

    protected $fillable = ['id_ky','id_slip','keterangan','jumlah_potongan','id_perusahaan','id_karyawan'];
}
