<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class PotonganAbsen extends Model
{
    //

    protected $table = "h_potongan_absen";

    protected $fillable = ['id_absensi','id_potongan_tetap','jumlah_item_p','id_perusahaan','id_karyawan'];

    public function potongan(){
        return $this->belongsTo('App\Model\Hrd\H_potongan_tetap','id_potongan_tetap');
    }

    public function absensi(){
        return $this->belongsTo('App\Model\Hrd\H_absensi','id_absensi');
    }
}
