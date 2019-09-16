<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class KetTransaksi extends Model
{
    //
    protected $table="k_ket_transaksi";

    protected $fillable=[
        'nm_transaksi',
        'jenis_transaksi',
        'id_perusahaan',
        'id_karyawan',
    ];

    public function dataAkun(){
        return $this->hasMany('App\Model\Keuangan\Transaksi','id_ket_transaksi');
    }

    public function hasOneAkun(){
        return $this->hasOne('App\Model\Keuangan\Transaksi','id_ket_transaksi');
    }
}
