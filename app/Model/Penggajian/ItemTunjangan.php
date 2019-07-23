<?php

namespace App\Model\Penggajian;

use Illuminate\Database\Eloquent\Model;

class ItemTunjangan extends Model
{
    //
    protected $table="g_item_tunjangan";

    protected $fillable=['nm_tunjangan','id_perusahaan','id_karyawan'];

    public function OneSkalaGaji(){
        return $this->hasOne('App\Model\Penggajian\SkalaTunjangan','id_item_tunjangan');
    }

}
