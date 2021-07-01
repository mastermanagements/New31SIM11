<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 6/5/2021
 * Time: 9:17 AM
 */

namespace App\Http\Controllers\produksi\utils;

use App\Model\Manufaktur\P_tambah_produksi;
use Session;

class Produksi
{
    public static $tanggal_awal = null;
    public static $tanggal_akhir = null;
    public static $year = null;
    public static $month = null;
    public static $barang = null;
    public static $supervisor = null;

    public static function DataProduksi()
    {
        if (self::$year != null && self::$month != null) {
            $produksi = P_tambah_produksi::where('status_produksi', '2')->whereMonth('tgl_mulai', self::$month)->whereYear('tgl_mulai', self::$year)->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        }
        if (self::$tanggal_awal != null && self::$tanggal_akhir) {
            $produksi = P_tambah_produksi::where('status_produksi', '2')->whereBetween('tgl_mulai', [self::$tanggal_awal, self::$tanggal_akhir])->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        }

        if(self::$barang !=null){
            $produksi->where('id_barang', self::$barang);
        }

        if(self::$supervisor !=null){
            $produksi->where('id_supervisor_produksi',self::$supervisor );
        }

        $data = array();
        $no = 1;
        foreach ($produksi->get() as $data_item) {
            $column = array();
            $column[] = $no++;
            $column[] = date('d-m-Y', strtotime($data_item->tgl_mulai));
            $column[] = date('d-m-Y', strtotime($data_item->tgl_selesai));
            $column[] = $data_item->lama_produksi;
            $column[] = $data_item->linkToBarang->nm_barang;
            $column[] = $data_item->jumlah_brg_jadi_bagus;
            $column[] = $data_item->jumlah_brg_jadi_rusan;
            $column[] = $data_item->jumlah_bdp_bagus;
            $column[] = $data_item->jumlah_bdp_rusak;
            $column[] = self::bahan_produksi($data_item);
            $column[] = self::tenaga_produksi($data_item);
            $column[] = self::biaya_over_head($data_item);
            $column[] = self::hpp_perbarang($data);
            $column[] = self::hpp_total($data);
            $column[] = $data_item->linkToSupervisor->nama_ky;
            $data[] = $column;
        }
        return $data;
    }

    private static function bahan_produksi($produksi)
    {
        $container = array();
        if(!empty($produksi->linkToBahanProduksi))
        {
            foreach ($produksi->linkToBahanProduksi as $item){
                $container[] = $item->linkToBarang->nm_barang;
            }
        }
        return $container;
    }

    private static function tenaga_produksi($produksi)
    {
        $container = array();
        if(!empty($produksi->linkToMannyTenagaProduksi))
        {
            foreach ($produksi->linkToMannyTenagaProduksi as $item){
                $container[] = $item->linkToPekerja->nama_ky;
            }
        }
        return $container;
    }

    private static function biaya_over_head($produksi)
    {
        $container = array();
        if(!empty($produksi->linkToBiayaOverHead))
        {
            foreach ($produksi->linkToBiayaOverHead as $item){
                $container[] = $item->linkToOverhead->item_overhead;
            }
        }
        return $container;
    }

    public static function hpp_perbarang($produski){
        return 0;
    }
    public static function hpp_total($produski){
        return 0;
    }
}