<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 27/10/2020
 * Time: 9:42
 */

namespace App\Http\utils\data;
use App\Http\utils\data\NeracaSaldo;

class LabaRugi
{

    public static $akun_focus =[
        4=>['Pendapatan','K'],7=>['Pendapatan Lain','K'], 6=>['Biaya','D'],8=>['Biaya Lain','D']
    ];

    public static function LabaRugi($array){
        $data_neraca = NeracaSaldo::neraca($array);
        $group_data = self::group_array($data_neraca);
        $data_spesifik_key = self::getArrayWithSpesificKey($group_data);
        return $data_spesifik_key;
    }

    private static function group_array($array){
        $result = array();
        foreach ($array as $element) {
            $result[$element['id_akun_ukm']][] = $element;
        }
        return $result;
    }


    private static function getArrayWithSpesificKey($data){
        $new_container = [];
        foreach (self::$akun_focus as $key=>$value){
            if(!empty($data[$key])){
                $new_container[$key] = $data[$key];
            }
        }
        return $new_container;
    }
}