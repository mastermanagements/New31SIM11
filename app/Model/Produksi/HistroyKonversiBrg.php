<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class HistroyKonversiBrg extends Model
{
    //
    protected $table = "p_history_konversi_brg";

    protected $fillable = ['id_konversi_brg','tgl_konversi','jum_brg_dikonversi','id_perusahaan','id_karyawan'];

    public function linkToKonversiBarang(){
        return $this->belongsTo('App\Model\Produksi\AturKonversi','id_konversi_brg');
    }
    public function linkToKaryawan(){
        return $this->belongsTo('App\Model\Hrd\H_Karyawan','id_karyawan');
    }
}
