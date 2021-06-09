<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 6/8/2021
 * Time: 11:39 AM
 */

namespace App\Http\Controllers\produksi\utils;

use App\Model\Produksi\PSales;
use Session;

class Penjualan
{
    public static $tgl_awal = null;
    public static $tgl_akhir = null;
    public static $tgl_transaksi = null;
    public static $klien = null;
    public static $jenis_penjualan_filter = null;

    public static $month = null;
    public static $year = null;

    public static $jenis_penjualan = [
        'Tunai',
        'Kredit'
    ];

    public static function getData()
    {
        if(!empty(self::$tgl_transaksi)){
            $penjualan = PSales::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
                ->whereDate('tgl_sales', self::$tgl_transaksi);
        }

        if ((self::$tgl_awal != null) && (self::$tgl_akhir != null)) {
            $penjualan = PSales::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
                ->whereBetween('tgl_sales', [self::$tgl_awal, self::$tgl_akhir]);
        }

        if ((self::$month != null) && (self::$year != null)) {
            $penjualan = PSales::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
                ->whereMonth('tgl_sales', self::$month)->whereYear('tgl_sales', self::$year);
        }

        if (self::$klien != null) {
            $penjualan->where('id_klien', self::$klien);
        }

        if (self::$jenis_penjualan_filter != null) {
            $penjualan->where('metode_bayar', '' . self::$jenis_penjualan_filter);
        }

        $container = [];
        $no = 1;
        foreach ($penjualan->get() as $item) {
            $column = [];
            $nota_pesanan = "";
            if (!empty($item->linkToPO)) {
                $nota_pesanan = $item->linkToSo->no_so;
            }

            $column[] = $no++;
            $column[] = date('d-m-Y', strtotime($item->tgl_sales));
            $column[] = $nota_pesanan;
            $column[] = $item->dp_so;
            $column[] = $item->no_sales;
            $column[] = $item->linkToKlien->nm_klien;
            $column[] = $item->linkToDetailSales->count('id');
            $column[] = $item->linkToDetailSales->sum('jumlah_harga');
            $column[] = $item->diskon_tambahan;
            $column[] = $item->ongkir;
            $tgl_kirim = "";
            if($item->tgl_kirim != '1970-01-01'){
                $tgl_kirim = date('d-m-Y', strtotime($item->tgl_kirim));
            }else{
                $tgl_kirim = "";
            }
            $column[] = $tgl_kirim;
            $column[] = self::$jenis_penjualan[$item->metode_bayar];
            $column[] = $item->bayar;
            $column[] = $item->kurang_bayar;

            $tgl_jatuh_tempo = "";
            if($item->tgl_jatuh_tempo != '1970-01-01'){
                $tgl_jatuh_tempo = date('d-m-Y', strtotime($item->tgl_jatuh_tempo));
            }else{
                $tgl_jatuh_tempo = "";
            }

            $column[] = $tgl_jatuh_tempo;
            $column[] = self::DetailPenjualan($item);
            $column[] = $item->pajak;
            $column[] = $item->total;
            $container[] = $column;
        }
        return $container;
    }

    private static function DetailPenjualan($penjualan)
    {
        $container = [];
        $no=1;
        if (!empty($penjualan->linkToDetailSales)) {
            foreach ($penjualan->linkToDetailSales as $item_penjualan) {
                $column=[];
                $column[]=$no++;
                $column[]=$item_penjualan->linkToBarang->kd_barang;
                $column[]=$item_penjualan->linkToBarang->nm_barang;
                $column[]=$item_penjualan->linkToBarang->linkToSatuan->satuan;
                $column[]=$item_penjualan->linkToBarang->spec_barang;
                $column[]=$item_penjualan->linkToBarang->merk_barang;
                $column[]=$item_penjualan->hpp;
                $column[]=$item_penjualan->jumlah_jual;
                $column[]=$item_penjualan->diskon;
                $column[]=$item_penjualan->jumlah_harga;
                $container[] = $column;
            }
        }
        return $container;
    }
}