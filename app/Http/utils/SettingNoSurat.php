<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 23/02/2021
 * Time: 10:08
 */

namespace App\Http\utils;
use Session;
use App\Model\Produksi\PesananPembelian;
use App\Model\Superadmin_ukm\U_usaha;
use App\Model\Produksi\TawarBeli;
use App\Model\Produksi\POrder;
use stdClass;

class SettingNoSurat
{
    public static $kode_surat;
    public static $initial_po = 'Pre-PO';
    public static $initial_order = 'PO';
    public static $order = 'Order';
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

    # format penawaran pembelian
    public static function no_kode_po(){
        $current_date = self::explode_current_date();
        $count_surat = TawarBeli::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->whereYear('tgl_tawar',$current_date->year)->count()+1;
        $no_surat = self::no_surat($count_surat);
        $singkatan_perusahaan = self::singkatan_perusahaan();
        $format = $no_surat.'/'.self::$initial_po.'/'.$singkatan_perusahaan.'/'.$current_date->tgl.'/'.$current_date->moon.'/'.$current_date->year;
        return $format;
    }

    # Format pre-order
    public static function no_po(){
        $current_date = self::explode_current_date();
        $count_surat = PesananPembelian::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->whereYear('tgl_po',$current_date->year)->count()+1;
        $no_surat = self::no_surat($count_surat);
        $singkatan_perusahaan = self::singkatan_perusahaan();
        $format = $no_surat.'/'.self::$initial_order.'/'.$singkatan_perusahaan.'/'.$current_date->tgl.'/'.$current_date->moon.'/'.$current_date->year;
        return $format;
    }

    # Format order
    public static function no_order(){
        $current_date = self::explode_current_date();
        $count_surat = POrder::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->whereYear('tgl_order',$current_date->year)->count()+1;
        $no_surat = self::no_surat($count_surat);
        $singkatan_perusahaan = self::singkatan_perusahaan();
        $format = $no_surat.'/'.self::$order.'/'.$singkatan_perusahaan.'/'.$current_date->tgl.'/'.$current_date->moon.'/'.$current_date->year;
        return $format;
    }
}