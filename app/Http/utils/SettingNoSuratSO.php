<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 23/02/2021
 * Time: 10:08
 */

namespace App\Http\utils;
use Session;
use App\Model\Produksi\PSO;
use App\Model\Superadmin_ukm\U_usaha;
use App\Model\Produksi\TawarJual;
use App\Model\Produksi\PSales;
use stdClass;

class SettingNoSuratSO
{
    public static $kode_surat;
    public static $initial_so = 'Pre-SO';
    public static $initial_sale = 'SO';
    public static $sale = 'Sale';
    public static $singkatan_perusahaan;
    #tanggal
    private static function explode_current_date(){
        $date = date('d-m-Y');
        $split = explode('-', $date);
        $obj = new stdClass;
        $obj->tgl = $split[0];
        $obj->moon = $split[1];
        $obj->year = $split[2];
        return $obj;
    }
    #no surat
    private static function no_surat($no_surat){
        if($no_surat < 10){
            $no_surat='0'.$no_surat;
        }
        return $no_surat;
    }

    #singkatan perusahaan
    private static function singkatan_perusahaan(){
        $model = U_usaha::findOrFail(Session::get('id_perusahaan_karyawan'));
        $singkatan_perusahaan = $model->singkatan_usaha;
        return $singkatan_perusahaan;
    }

    # format penawaran penjualan
    public static function no_kode_so(){
        $current_date = self::explode_current_date();
        $count_surat = TawarJual::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->whereYear('tgl_jual',$current_date->year)->count()+1;
        $no_surat = self::no_surat($count_surat);
        $singkatan_perusahaan = self::singkatan_perusahaan();
        $format = $no_surat.'/'.self::$initial_so.'/'.$singkatan_perusahaan.'/'.$current_date->tgl.'/'.$current_date->moon.'/'.$current_date->year;
        return $format;
    }

    # Format pre-sale
    public static function no_so(){
        $current_date = self::explode_current_date();
        $count_surat = PSO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->whereYear('tgl_so',$current_date->year)->count()+1;
        $no_surat = self::no_surat($count_surat);
        $singkatan_perusahaan = self::singkatan_perusahaan();
        $format = $no_surat.'/'.self::$initial_sale.'/'.$singkatan_perusahaan.'/'.$current_date->tgl.'/'.$current_date->moon.'/'.$current_date->year;
        return $format;
    }

    # Format sale
    public static function no_sale(){
        $current_date = self::explode_current_date();
        $count_surat = PSales::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->whereYear('tgl_sales',$current_date->year)->count()+1;
        $no_surat = self::no_surat($count_surat);
        $singkatan_perusahaan = self::singkatan_perusahaan();
        $format = $no_surat.'/'.self::$sale.'/'.$singkatan_perusahaan.'/'.$current_date->tgl.'/'.$current_date->moon.'/'.$current_date->year;
        return $format;
    }
}
