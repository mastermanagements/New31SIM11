<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class PesananPembelian extends Model
{
    //
    protected $table = 'tbl_p_po';

    protected $fillable = ['id_tawar_beli','tgl_po','no_po','id_supplier','tgl_krm','diskon_tambahan','pajak','dp_po','kurang_bayar','ket','status_po'];
}
