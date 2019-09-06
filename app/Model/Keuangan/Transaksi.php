<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
    protected $table = "k_transaksi";

    protected $fillable = ['id_ket_transaksi','jenis_transaksi','id_akun_aktif','posisi_akun','id_perusahaan','id_karyawan'];

    public function transaksi()
    {
        return $this->belongsTo('App\Model\Keuangan\AkunAktifUkm','id_akun_aktif');
    }

}
