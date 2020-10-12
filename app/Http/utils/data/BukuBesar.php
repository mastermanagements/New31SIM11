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

    public static function groupAkunBaseOnDataJurnal($array){
        $junal_data = JurnalUmum::data_jurnal_umum(null);
        $array_group=[];
        if(!empty($junal_data['data_jurnal'])){
            foreach ($junal_data['data_jurnal'] as $key=>$data){
                $array_group[$data['id_akun']][] = $data;
            }
        }
       self::countSaldo($array_group);
    }

    public static function countSaldo($data_group_jurnal){
        foreach ($data_group_jurnal as $key=> $object) {
            $saldo = 0;
            foreach ($object as $item){
                if($item['debet']!=0){
//                    $saldo
                }
            }
        }
        dd($data_group_jurnal);
    }

}