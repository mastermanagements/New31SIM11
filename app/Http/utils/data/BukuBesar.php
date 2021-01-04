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
        $junal_data = JurnalUmum::data_jurnal_umum($array);
        $array_group=[];
        if(!empty($junal_data['data_jurnal'])){
            foreach ($junal_data['data_jurnal'] as $key=>$data){
                $array_group[$data['id_akun']][] = $data;
            }
        }
       return self::countSaldo($array_group);
    }

    #rule
    public static function filterSaldow($item){
//        self::$saldo=0;
        # Penentuan Saldo
        if($item['posisi_saldo']=='D'){
            #Bandingkan posisi saldo Debet dan posisi akun saldo
            if($item['posisi_saldo'] == $item['posisi_akun_saldo']){
                # Kalau posisi Saldo debet dan nilai uang debet !=0 maka saldo akan ditambah dengan nilai uang debet
                if ($item['debet'] !=0){
                    self::$saldo+=$item['debet'];
                    $item['saldo_debet'] = self::$saldo;
                    $item['saldo_kredit'] = 0;
                }

                # Kalau posisi Saldo debet dan nilai uang kredit !=0 maka saldo akan dikurang dengan nilai uang kredit
                if ($item['kredit'] !=0){
                    self::$saldo-=$item['kredit'];
                    $item['saldo_debet'] = self::$saldo;
                    $item['saldo_kredit'] = 0;
                }
            }else{
                if ($item['debet'] !=0){
                    self::$saldo-=$item['debet'];
                    $item['saldo_debet'] = self::$saldo;
                    $item['saldo_kredit'] = 0;
                }

                # Kalau posisi Saldo debet dan nilai uang kredit !=0 maka saldo akan dikurang dengan nilai uang kredit
                if ($item['kredit'] !=0){
                    self::$saldo+=$item['kredit'];
                    $item['saldo_debet'] = self::$saldo;
                    $item['saldo_kredit'] = 0;
                }
            }

        }
        elseif($item['posisi_saldo']=='K'){
            #Bandingkan posisi saldo Kredit dan posisi akun saldo
            if($item['posisi_saldo'] == $item['posisi_akun_saldo']) {
                # Kalau posisi Saldo kredit dan nilai uang debet !=0 maka saldo akan dikurangi dengan nilai uang debet
                if ($item['debet'] != 0) {
                    self::$saldo -= $item['debet'];
                    $item['saldo_debet'] = 0;
                    $item['saldo_kredit'] = self::$saldo;
                }else{
                    $item['saldo_debet'] = 0;
                    $item['saldo_kredit'] = 0;
                }
                # Kalau posisi Saldo kredit dan nilai uang kredit !=0 maka saldo akan ditambah dengan nilai uang kredit
                if ($item['kredit'] != 0) {
                    self::$saldo += $item['kredit'];
                    $item['saldo_debet'] = 0;
                    $item['saldo_kredit'] = self::$saldo;
                }else{
                    $item['saldo_debet'] = 0;
                    $item['saldo_kredit'] = 0;
                }
            }else{
                # Kalau posisi Saldo kredit dan nilai uang debet !=0 maka saldo akan dikurangi dengan nilai uang debet
                if ($item['debet'] != 0) {
                    self::$saldo += $item['debet'];
                    $item['saldo_debet'] = 0;
                    $item['saldo_kredit'] = self::$saldo;
                }else{
                    $item['saldo_debet'] = 0;
                    $item['saldo_kredit'] = 0;
                }
                # Kalau posisi Saldo kredit dan nilai uang kredit !=0 maka saldo akan ditambah dengan nilai uang kredit
                if ($item['kredit'] != 0) {
                    self::$saldo -= $item['kredit'];
                    $item['saldo_debet'] = 0;
                    $item['saldo_kredit'] = self::$saldo;
                }else{
                    $item['saldo_debet'] = 0;
                    $item['saldo_kredit'] = 0;
                }
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