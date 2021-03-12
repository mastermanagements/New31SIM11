<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class KomisiSales extends Model
{
    //
    protected $table = "p_komisi_sales";
    protected $fillable = ['id_ky','jenis_komisi','persen_komisi','id_perusahaan'];

    public function linkToKaryawan(){
        return $this->belongsTo('App\Model\HRD\H_Karyawan', 'id_ky');
    }
}
