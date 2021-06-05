<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 6/5/2021
 * Time: 11:11 AM
 */

namespace App\Http\Controllers\produksi\utils;
use App\Model\Produksi\POrder;
use Session;

class Pembelian
{
    public static $month=null;
    public static $years=null;

    public static $tgl_awal=null;
    public static $tgl_akhir=null;

    public static $jenis_bayar=null;
    public static $supplier=null;

    public static $metode_bayar=[
            'Tunai',
            'Kredit'
        ];

    public static function getData(){
        if(self::$month !=null && self::$years !=null){
            $pembelian = POrder::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
                ->whereMonth('tgl_order',self::$month)
                ->whereYear('tgl_order',self::$years);
        }

        if(self::$tgl_awal !=null && self::$tgl_akhir!=null){
            $pembelian = POrder::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
                ->whereBetween('tgl_order',[self::$tgl_awal,self::$tgl_akhir]);
        }

        if(self::$jenis_bayar !=null){
            $pembelian->where('metode_bayar', self::$jenis_bayar);
        }

        if(self::$supplier !=null){
            $pembelian->where('id_supplier',self::$supplier);
        }

        $data = array();
        $no = 1;
        foreach ($pembelian->get() as $item)
        {
            $no_po="";
            if(!empty($item->linkToPO)){
                $no_po = $item->linkToPO->no_po;
            }

            $column=array();
            $column[] = $no++;
            $column[] = date('d-m-Y', strtotime($item->tgl_order));
            $column[] = $no_po;
            $column[] = $item->dp_po;
            $column[] = $item->no_order;
            $column[] = $item->linkToSuppliers->nama_suplier;
            $column[] = $item->linkToDetailOrder->count('id');
            $column[] = $item->linkToDetailOrder->sum('jumlah_harga');
            $column[] = $item->diskon_tambahan;
            $column[] = $item->ongkir;
            $column[] = date('d-m-Y', strtotime($item->tgl_tiba));
            $column[] = self::$metode_bayar[$item->metode_bayar];
            $column[] = $item->bayar;
            $column[] = $item->kurang_bayar;
            $column[] = date('d-m-Y', strtotime($item->tgl_jatuh_tempo));
            $data[] = $column;
        }
        return $data;
    }

    public static function get_detail_pembelian(){
        if(self::$month !=null && self::$years !=null){
            $pembelian = POrder::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
                ->whereMonth('tgl_order',self::$month)
                ->whereYear('tgl_order',self::$years);
        }

        if(self::$tgl_awal !=null){
            $pembelian = POrder::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
                ->whereDate('tgl_order','=',self::$tgl_awal);
        }

        if(self::$supplier !=null){
            $pembelian->where('id_supplier',self::$supplier);
        }

        $data = array();
        $no = 1;
        foreach ($pembelian->get() as $item)
        {
            $no_po="";
            if(!empty($item->linkToPO)){
                $no_po = $item->linkToPO->no_po;
            }
            $column = [];
            $column[] = $item->no_order;
            $column[] = $item->linkToSuppliers->nama_suplier;
            $column[] = self::$metode_bayar[$item->metode_bayar];
            $column[] = $item->diskon_tambahan;
            $column[] = $item->ongkir;
            $column[] = $item->pajak;
            $column[] = self::list_detail_barang($item);
            $data[] = $column;
        }
        return $data;
    }

    private static function list_detail_barang($detail_order){
        $no = 1;
        $contaier = array();
        if(!empty($detail_order->linkToDetailOrder)){
            foreach ($detail_order->linkToDetailOrder as $item_detail_order){
                $column = array();
                $column[] = $no++;
                $column[] = $item_detail_order->linkToBarang->kd_barang;
                $column[] = $item_detail_order->linkToBarang->nm_barang;
                $column[] = $item_detail_order->linkToBarang->linkToSatuan->satuan;
                $column[] = $item_detail_order->linkToBarang->spec_barang;
                $column[] = $item_detail_order->linkToBarang->merk_barang;
                $column[] = $item_detail_order->harga_beli;
                $column[] = $item_detail_order->jumlah_beli;
                $column[] = $item_detail_order->diskon_item;
                $column[] = $item_detail_order->jumlah_harga;
                $column[] = date('d-m-Y', strtotime($item_detail_order->expired_date));
                $contaier[] = $column;
            }
        }
        return $contaier;
    }
}