<?php

namespace App\Model\Manufaktur;

use Illuminate\Database\Eloquent\Model;

class AkunManufaktur extends Model
{
    //
    protected $table = 'p_akun_manufaktur';

    protected $fillable = ['jenis_jurnal','id_ket_transaksi','jenis_transaksi','posisi_akun','id_perusahaan','id_karyawan'];

    public function linkToOneKetTransaksi(){
        return $this->belongsTo('App\Model\Keuangan\KetTransaksi','id_ket_transaksi');
    }
}
