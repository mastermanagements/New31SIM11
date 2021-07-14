<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 4/2/2021
 * Time: 9:58 AM
 */

namespace App\Http\utils;
use App\Model\Produksi\DetailTB;
use App\Model\Produksi\DetailPO;
use Session;
use stdClass;
use Zend\Diactoros\Request;
use App\Model\Produksi\Barang;

class GetHargarBarang
{

    public static $id_barang;
    #Todo Ambil harga terakhir barang penawaran 1
    public static function harga_penawaran_pembelian(){
        $model = DetailTB::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->orderBy('id','desc')->where('id_barang',self::$id_barang)->first();
        if(!empty($model)){
            return self::format($model->hpp_baru);
        }else{
            return self::format();
        }
    }

    #Todo Ambil harga terakhir barang pesanan pembelian 2
    public static function harga_pesanan_pembelian(){
        $model = DetailPO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->orderBy('id','desc')->where('id_barang',self::$id_barang)->first();
        if(!empty($model)){
            return self::format($model->hpp);
        }else{
            return self::format();
        }
    }

    #Todo Ambiil harga Hpp dari data hargaJual Satuan atau Harga Jual BaseOnJumlah
    public static function harga_penjualan_barang(){
        $model = Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->orderBy('id','desc')->where('id',self::$id_barang)->first();



        $hpp = 0;
        if(!empty($model)){
            // HPP dari Harga Jual Satuan
            if(!empty($model->linkToHargaJual)){
                $hpp = $model->linkToHargaJual->harga_jual;
            }
            // HPP dari Harga Based On Jumlah
            if(!empty($model->linkToHargaBaseOneJumlah)){
                $hpp = $model->linkToHargaBaseOneJumlah->harga_jual;
                //dd($hpp);
            }

            return self::format($hpp);
        }else{
            return self::format();
        }

    }

    public static function callFunction($numberFunction=0){
        if($numberFunction==1){
           return self::harga_penawaran_pembelian();
        }else if($numberFunction==2){
            return self::harga_pesanan_pembelian();
        }else if($numberFunction==3){
            return self::harga_penjualan_barang();
        }
    }

    public static function format($harga_barang=0){
        $object =new \stdClass();
        $object->harga = $harga_barang;
        return $object;
    }
}
