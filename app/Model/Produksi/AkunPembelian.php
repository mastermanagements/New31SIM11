<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class AkunPembelian extends Model
{
    //
    protected $table = 'p_akun_pembelian';

    protected $fillable = ['jenis_jurnal','id_ket_transaksi','jenis_transaksi','id_akun_aktif','posisi_akun','id_perusahaan','id_karyawan'];

    public function linkToOneKetTransaksi(){
        return $this->belongsTo('App\Model\Keuangan\KetTransaksi','id_ket_transaksi');
    }

}
