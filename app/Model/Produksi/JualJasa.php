<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class JualJasa extends Model
{
    //

    protected $table="p_jual_jasa";

    protected $fillable = ["id_jasa","id_klien","detail_pesanan","harga_jual","id_perusahaan","id_karyawan"];

    public function getJasa()
    {
        return $this->belongsTo('App\Model\Produksi\Jasa','id_jasa');
    }

    public function getKlien()
    {
        return $this->belongsTo('App\Model\Administrasi\Klien','id_klien');
    }


}
