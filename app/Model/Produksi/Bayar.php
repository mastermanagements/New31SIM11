<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    //
    protected $table = 'p_bayar';

    protected $fillable = ['jenis_bayar','id_po','id_order','id_return_barang','tgl_bayar','metode_bayar','bank_asal',
        'bank_tujuan','jumlah_bayar','bukti_bayar','kirim_bukti','id_perusahaan','id_karyawan'];


        public function linkToBankAsal()
        {
            return $this->belongsTo('App\Model\Produksi\RekUkm','bank_asal');
        }
        public function linkToBankTujuan()
        {
            return $this->belongsTo('App\Model\Produksi\RekUkm','bank_tujuan');
        }
}
