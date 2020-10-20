<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 12/10/2020
 * Time: 10:51
 */

namespace App\Http\utils\data;
use App\Http\utils\data\JurnalUmum;


class BukuBesar
{
    public static $saldo;

    public static function groupAkunBaseOnDataJurnal($array){
        $junal_data = JurnalUmum::data_jurnal_umum(null);
        $array_group=[];
        if(!empty($junal_data['data_jurnal'])){
            foreach ($junal_data['data_jurnal'] as $key=>$data){
                $array_group[$data['id_akun']][] = $data;
            }
        }
       return self::countSaldo($array_group);
    }


    public static function filterSaldow($item){
        if($item['posisi_saldo']=='D'){
            if ($item['debet'] !=0){
                self::$saldo+=$item['debet'];
                $item['saldo_debet'] = self::$saldo;
                $item['saldo_kredit'] = 0;
            }
            if ($item['kredit'] !=0){
                self::$saldo-=$item['kredit'];
                $item['saldo_debet'] = self::$saldo;
                $item['saldo_kredit'] = 0;
            }
        }elseif($item['posisi_saldo']=='K'){
            if ($item['debet'] !=0){
                self::$saldo-=$item['debet'];
                $item['saldo_debet'] = 0;
                $item['saldo_kredit'] = self::$saldo;
            }
            if ($item['kredit'] !=0){
                self::$saldo+=$item['kredit'];
                $item['saldo_debet'] =0;
                $item['saldo_kredit'] =self::$saldo;
            }
        }



        return $item;
    }

    public static function countSaldo($data_group_jurnal){
        $container=[];
        ksort($data_group_jurnal);
        foreach ($data_group_jurnal as $key=> $object) {
            self::$saldo=0;
            $rebuil_array = [];
            foreach ($object as $keys=>$item){
                $rebuil_array[] = self::filterSaldow($item);
            }
            $container[$key] = $rebuil_array;
        }
       return $container;
    }

}