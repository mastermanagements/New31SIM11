<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 20/10/2020
 * Time: 10:30
 */

namespace App\Http\utils\data;
use Session;
use App\Http\utils\data\BukuBesar;

class NeracaSaldo
{
    public static function neraca($array)
    {
        $data_buku_besar = BukuBesar::groupAkunBaseOnDataJurnal($array);
        $row=[];
        foreach ($data_buku_besar as $data){
            $row[]=end($data);
        }
       return $row;
    }
}