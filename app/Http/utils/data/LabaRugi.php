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

    public static $total_laba_rugi=0;
    protected static $data_laba;
    public static $status_alurkas = false;

    public static $akun_focus =[
        4=>['Pendapatan','K'],7=>['Pendapatan Lain','K'], 6=>['Biaya','D'],8=>['Biaya Lain','D']
    ];

    private static function sortFunction( $a, $b ) {
        return strtotime($a["tanggal"]) - strtotime($b["tanggal"]);
    }

    public static function LabaRugi($array){
        $data_neraca = NeracaSaldo::neraca($array);
        $group_data = self::group_array($data_neraca);
        $data_spesifik_key = self::getArrayWithSpesificKey($group_data);
        self::$data_laba = $data_spesifik_key;
        return $data_spesifik_key;
    }

    private static function group_array($array){
        $result = array();
        usort($array,'self::sortFunction');
         foreach ($array as $element) {
            if(self::$status_alurkas == false){
                $result[$element['id_akun_ukm']][] = $element;
            }else{
                if($element['status_alur_kas'] == 1){
                    $result[$element['id_akun_ukm']][] = $element;
                }
            }
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

    public static function hitungjumlah_laba(){
        $data = self::$data_laba;
        $total_laba=0;
        foreach ($data as $data_akun){
            foreach ($data_akun as $data_saldo){
                if($data_saldo['posisi_saldo']=="K")
                {
                    $total_laba += $data_saldo['saldo_kredit'];
                } else {
                    $total_laba -= $data_saldo['saldo_debet'];
                }
            }
        }
        return $total_laba;
    }
}