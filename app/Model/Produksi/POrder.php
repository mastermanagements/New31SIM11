<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class POrder extends Model
{
    //

    protected $table = 'p_order';

    protected $fillable = ['id_po','tgl_order','no_order','id_supplier','tgl_tiba','diskon_tambahan','pajak','dp_po','bayar','kurang_bayar','metode_bayar','tgl_jatuh_tempo','expired_date','ongkir','ket','id_perusahaan'];

    public function linkToPO()
    {
        return $this->belongsTo('App\Model\Produksi\PesananPembelian','id_po');
    }

    public function linkToSuppliers()
    {
        return $this->belongsTo('App\Model\Produksi\Supplier','id_supplier');
    }
}
