<?php

namespace App\Model\Manufaktur;

use Illuminate\Database\Eloquent\Model;

class P_Bahan_produksi extends Model
{
    //
    protected $table = 'p_bahan_produksi';

    protected $fillable = ['id_tambah_produksi','id_barang_mentah','jumlah_bahan','id_perusahaan','id_karyawan'];
}
