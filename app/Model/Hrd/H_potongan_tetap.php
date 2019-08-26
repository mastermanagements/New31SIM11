<?php

namespace App\Model\Hrd;

use Illuminate\Database\Eloquent\Model;

class H_potongan_tetap extends Model
{
    //

    protected $table= 'h_potongan_tetap';

    protected $fillable = ['nm_potongan','satuan_potongan','status_potongan','besar_potongan','id_perusahaan','id_karyawan'];

    public function potongan_absen(){
        return $this->hasOne('App\Model\Hrd\PotonganAbsen','id_potongan_tetap');
    }
}
