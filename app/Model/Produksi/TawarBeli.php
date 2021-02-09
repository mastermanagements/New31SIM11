<?php

namespace App\Model\Produksi;

use Illuminate\Database\Eloquent\Model;

class TawarBeli extends Model
{
    //
    protected $table = 'p_tawar_beli';

    protected $fillable = ['no_tawar','tgl_tawar','tgl_berlaku','tgl_kirim','id_supplier','id_perusahaan'];

    public function linkToDetail(){
        return $this->hasMany('App\Model\Produksi\DetailTB','id_tawar','id');
    }

    public function linkToPpO()
    {
        return $this->hasOne('App\Model\Produksi\PesananPembelian','id_tawar_beli','id');
    }
}
