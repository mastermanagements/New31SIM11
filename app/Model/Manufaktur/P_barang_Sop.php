<?php

namespace App\Model\Manufaktur;

use Illuminate\Database\Eloquent\Model;

class P_barang_Sop extends Model
{
    //
    protected $table = 'p_barang_sop';

    protected $fillable = ['id_sop_pro','id_barang','id_perusahaan'];

    public function linkToBarang(){
        return $this->belongsTo('App\Model\Produksi\Barang','id_barang');
    }
}
