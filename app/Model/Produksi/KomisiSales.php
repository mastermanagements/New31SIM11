<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class KomisiSales extends Model
{
    //
    protected $table = "p_komisi_sales";
    protected $fillable = ['id_ky','jenis_komisi','persen_komisi','id_perusahaan','id_karyawan'];

    public function linkToKaryawan(){
        return $this->belongsTo('App\Model\Hrd\H_Karyawan', 'id_ky');
    }
}
