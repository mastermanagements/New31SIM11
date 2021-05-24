<?php

namespace App\Model\Kasir;

use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    //
    protected $table = 'p_nota_kasir';
    protected $guarded=[];

    public function linkToMannyDetailNota(){
        return $this->hasMany('App\Model\Kasir\DetailKasir','id_nota_kasir','id');
    }
}
