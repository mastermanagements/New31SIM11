<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class DividenPemodal extends Model
{
    //
    protected $table="i_dividen_pemodal";

    protected $fillable = [
        'id_pemodal',
        'id_bulan_dividen',
        'besar_dividen',
        'id_perusahaan',
        'id_karyawan',
    ];

    public function pemodal(){
        return $this->belongsTo('App\Model\Investor\Pemodal','id_pemodal');
    }

    public function bulan_dividen(){
        return $this->belongsTo('App\Model\Investor\BulanDevidenM','id_bulan_dividen');
    }
}
