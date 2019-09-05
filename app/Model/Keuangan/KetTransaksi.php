<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class KetTransaksi extends Model
{
    //
    protected $table="k_ket_transaksi";

    protected $fillable=[
        'nm_transaksi',
        'id_perusahaan',
        'id_karyawan',
    ];
}
