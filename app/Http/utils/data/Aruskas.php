<?php

namespace App\Http\utils\data;

use Session;
use App\Http\utils\data\LabaRugi;


class Aruskas
{

        private static $tahun_setting = ['2019', '2020'];
        public static $data_arus_kas;
        public static $total_laba_rugi = [];
        public static $akun =  [
            1=>['Aktiva','D'], 2=>['Hutang','K']
        ];

        public static $total_saldo =0;

        public static function set_total_laba_rugi(){
            $default_akun = LabaRugi::$akun_focus;
            LabaRugi::LabaRugi($default_akun);
            $total_laba_rugi_ditahun_berjalan=LabaRugi::hitungjumlah_laba();
            return $total_laba_rugi_ditahun_berjalan;
        }

        public static function DataArusKas($array)
        {
                LabaRugi::$akun_focus=self::$akun;
                LabaRugi::$status_alurkas = true;

                $row = [];
                foreach (self::$tahun_setting as $tahun_berjalan) {
                        $array['thn_berjalan'] = $tahun_berjalan;
                        $data_laba_rugi = LabaRugi::LabaRugi($array);
                        $total_laba_rugi = LabaRugi::hitungjumlah_laba();
                        $row[$tahun_berjalan]['data'] = $data_laba_rugi;
                        $row[$tahun_berjalan]['total_laba_rugi'] = $total_laba_rugi;

                }
                self::$data_arus_kas = $row;
//                return "Hello Niggo";
        }

        public static function compare_between_array(){
            $data = self::$data_arus_kas;
            $extrat_data = [];
            foreach ($data as $key=> $data){
                $extrat_data[$key] = self::change_index_to_kode_akun($data);
            }


            $ndata=self::filter_same_kode_akun($extrat_data);

            return $ndata;
        }

        private static function change_index_to_kode_akun($array){
            $new_array = [];
            if(!empty($array['data'])){
                foreach ($array['data'] as $key=> $data){
                    foreach ($data as  $item){
                        $new_array[$key][$item['id_akun']] =  $item;
                    }
                }
            }
            return $new_array;
        }

        private static function filter_same_kode_akun($array){
            $tahun_berjalan = self::$tahun_setting[1];
            $row = [];
            foreach($array[$tahun_berjalan] as $key=> $akun){
                self::$total_saldo = 0;
                foreach($akun as $nkey=> $item) {
                    $column = [];
                    $column['no_transaksi'] = $item['no_transaksi'];
                    $column['kode_akun'] = $item['kode_akun'];
                    $column['nama_akun'] = $item['nama_akun'];
                    $column['keterangan'] = $item['keterangan'];
                    # Cek kode akun yang berada pada data neraca ditahun sebelumnya
                    if(!empty($array[self::$tahun_setting[0]][$key][$nkey])){
                        $column['sub_total'] = self::subSaldo($array[self::$tahun_setting[0]][$key][$nkey])+self::subSaldo($item);
                    }else{
                        $column['sub_total'] = self::subSaldo($item);                       
                    }
                    $row[$key][$nkey] = $column;
                }
            }
            return $row;
        }

        private static function subSaldo($item)
        {
            if($item['posisi_saldo'] == "D"){
                if($item['posisi_akun_sub_saldo']=="D"){
                    self::$total_saldo += $item['saldo_debet'];
                }else{
                    self::$total_saldo -= $item['saldo_kredit'];     
                }                    
            }else if($item['posisi_saldo'] == "K"){
                if($item['posisi_akun_sub_saldo']=="K"){
                    self::$total_saldo += $item['saldo_kredit'];
                }else{
                    self::$total_saldo -= $item['saldo_debet'];     
                }
            }
            return self::$total_saldo;
        }

}
