<?php

namespace App\Model\Manufaktur;

use Illuminate\Database\Eloquent\Model;

class P_biaya_overhead extends Model
{
    //
    protected $table = 'p_biaya_overhead';

    protected $fillable = ['id_tambah_produksi','id_item_overhead','jumlah_biaya','id_perusahaan','id_karyawan'];

    public function linkToOverhead(){
        return $this->belongsTo('App\Model\Manufaktur\P_item_overhead','id_item_overhead');
    }
}
