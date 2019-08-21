<?php

namespace App\Model\Investor;

use Illuminate\Database\Eloquent\Model;

class DividenPelaksana extends Model
{
    //
    protected $table = "i_dividen_pelaksana";

    protected $fillable = [
        'id_pelaksana',
        'id_bulan_dividen',
        'besar_dividen',
        'id_perusahaan',
        'id_karyawan',
    ];

    public function pelaksana(){
        return $this->belongsTo('App\Model\Investor\Pelaksana','id_pelaksana');
    }
    public function bulan_dividen(){
        return $this->belongsTo('App\Model\Investor\BulanDevidenM','id_bulan_dividen');
    }
}
