<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class PTerimaBayar extends Model
{
    //

    protected $table = "p_terima_bayar";

    protected $fillable = [
            'jenis_bayar',
            'id_so',
            'id_sales',
            'id_return_barang',
            'tgl_bayar',
            'metode_bayar',
            'bank_asal',
            'bank_tujuan',
            'jumlah_bayar',
            'bukti_bayar',
            //'terima_bukti',
            'id_perusahaan',
            'id_karyawan',
        ];
    public function linkToBankAsal(){
      return $this->belongsTo('App\Model\Administrasi\RekKlien','bank_asal');
    }
    public function linkToBankTujuan(){
      return $this->belongsTo('App\Model\Produksi\RekUkm','bank_tujuan');
    }
}
