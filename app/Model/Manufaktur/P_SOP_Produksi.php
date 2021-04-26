<?php

namespace App\Model\Manufaktur;

use Illuminate\Database\Eloquent\Model;

class P_SOP_Produksi extends Model
{
    //
    protected $table = "p_sop_produksi";

    protected $fillable = ['nama_sop','id_perusahaan'];

    public function LinkToMannyPSOPProduksi(){
        return $this->hasMany('App\Model\Manufaktur\P_Proses_Bisnis','id_sop_pro','id');
    }

    public function LinkToMannyPSOBarang(){
        return $this->hasMany('App\Model\Manufaktur\P_barang_Sop','id_sop_pro','id');
    }
}
