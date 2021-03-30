<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    //

    protected $table = 'k_jurnal';

    protected $fillable = [
        'jenis_jurnal',
        'tgl_jurnal',
        'id_ket_transaksi',
        'id_akun_aktif',
        'no_transaksi',
        'ket',
        'debet_kredit',
        'jumlah_transaksi',
        'id_perusahaan',
        'id_karyawan',
        'id_pesanan',
        'id_pembelian',
        'id_penjualan'
    ];

    public function keterangan(){
        return $this->belongsTo('App\Model\Keuangan\KetTransaksi','id_ket_transaksi');
    }

    public function akun(){
        return $this->belongsTo('App\Model\Keuangan\AkunAktifUkm','id_akun_aktif');
    }
}
