<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 04/11/2020
 * Time: 9:29
 */

namespace App\Http\utils\data;
use App\Http\utils\data\NeracaSaldo;
use App\Http\utils\data\LabaRugi;
use App\Http\utils\data\SettingTahunBuku;
class Neraca
{

    private static $array_focus = [
      1=>'Asset','2'=>'Hutang',3=>'Modal'
    ];

    private static $array_aktiva_pasiva = [
        'Aktiva'=>[1],
        'Pasiva'=>[2,3]
    ];

    public static function getAktivaPasiva($array){
        $data_laba = self::data($array);
        $result = [];
        foreach (self::$array_aktiva_pasiva as $key=> $data){
            $total = 0;
          foreach ($data as $data_){
                $total+=self::sumSubArray($data_laba[$data_]);
                $result[$key]['data'][$data_]=$data_laba[$data_];
          }
            $result[$key]['total']=$total;
        };
       return $result;
    }

    private static function sumSubArray($array){
        $result = 0;
        foreach ($array as $k=>$subArray) {
            if ($subArray['posisi_saldo']=='D')
            {
                $result +=$subArray['saldo_debet'];

            }else if($subArray['posisi_saldo']=='K'){
                $result +=$subArray['saldo_kredit'];
            }
        }
        return $result;
    }

    public static function data($array){

        #testing dengan tahun

        $data = NeracaSaldo::neraca($array);

        $result = array();
        # Group Berdasarkan Akun
        foreach ($data as $element) {
            if(!empty(self::$array_focus[$element['id_akun_ukm']])){
                $result[$element['id_akun_ukm']][] = $element;
            }
        }
        $total_laba =self::getLabaRugi();
        # Note bagaimana caranya agar id_aktif_ukm bisa dinama didapatkan jika data akun digunakan berbeda user
        $array_akun_laba_ditahan_ditahun_berjalan = [
            'tgl_jurnal'=> '2020-12-31',
            'id_aktif_ukm'=> 94,
            'debet_kredit' =>1,
            'nama_akun'=> 'Laba di tahan Tahun Berjalan',
            'posisi_saldo'=> 'K',
            'posisi_akun_saldo'=> 'K',
            'debet'=>0,
            'kredit'=>0,
            'saldo_debet'=>0,
            'saldo_kredit'=>$total_laba,
        ];
        # Sisipkan Akun Laba ditahun berjalan khusus akun modal;
        array_push($result[3], $array_akun_laba_ditahan_ditahun_berjalan);
       return $result;
    }


    private static function getLabaRugi(){
        $data_rugi = LabaRugi::LabaRugi(null);
        $total_laba = LabaRugi::hitungjumlah_laba();
        return $total_laba;
    }


}