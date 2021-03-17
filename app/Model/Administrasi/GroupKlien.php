<?php

namespace App\Model\Administrasi;

use Illuminate\Database\Eloquent\Model;

class GroupKlien extends Model
{
    //
    protected $table = "a_group_klien";

    protected $fillable = ['nama_group','id_perusahaan'];

    public function linkToPDiskon(){
        return $this->hasOne('App\Model\Produksi\PDiskon','id_group','id');
    }
}
