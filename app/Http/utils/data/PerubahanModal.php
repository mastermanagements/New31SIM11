<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 02/11/2020
 * Time: 10:46
 */

namespace App\Http\utils\data;
use App\Http\utils\data\NeracaSaldo;
use App\Http\utils\data\LabaRugi;

class PerubahanModal
{
    public static $akun_focus =[
        3=>['Modal','K']
    ];



    public static function data_perubahan_model($array){

        LabaRugi::LabaRugi(null);
        $total_laba_rugi = LabaRugi::hitungjumlah_laba();
        $data_neraca = NeracaSaldo::neraca($array);
        $group_data = self::group_array($data_neraca);
        $data_spesifik_key = self::getArrayWithSpesificKey($group_data);
        $data_spesifik_key['laba_rugi'] =[
            'nama_akun'=> 'Laba Rugi',
            'posisi_saldo'=> 'D',
            'saldo_debet'=> $total_laba_rugi,
            'saldo_kredit'=>0
        ];
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