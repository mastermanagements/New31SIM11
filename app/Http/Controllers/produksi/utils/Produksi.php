<?php
/**
 * Created by PhpStorm.
 * User: Vandiansyah
 * Date: 6/5/2021
 * Time: 9:17 AM
 */

namespace App\Http\Controllers\produksi\utils;

use App\Model\Manufaktur\P_tambah_produksi;
use Illuminate\Support\Facades\DB;
use App\Model\Produksi\ItemIO;
use Session;

class Produksi
{
    public static $tanggal_awal = null;
    public static $tanggal_akhir = null;
    public static $year = null;
    public static $month = null;
    public static $barang = null;
    public static $supervisor = null;
    public static $karyawan = null;
    public static $jenis_item = null;

    public static $list_jenis_item = [
        'Item masuk',
        'Item keluar'
    ];

    public static $bulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    public static function DataProduksi()
    {
        if (self::$year != null && self::$month != null) {
            $produksi = P_tambah_produksi::where('status_produksi', '2')->whereMonth('tgl_selesai', self::$month)->whereYear('tgl_selesai', self::$year)->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        }

        if (self::$tanggal_awal != null && self::$tanggal_akhir) {
            $produksi = P_tambah_produksi::where('status_produksi', '2')->whereBetween('tgl_selesai', [self::$tanggal_awal, self::$tanggal_akhir])->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        }

        if (self::$barang != null) {
            $produksi->where('id_barang', self::$barang);
        }

        if (self::$supervisor != null) {
            $produksi->where('id_supervisor_produksi', self::$supervisor);
        }

        if (self::$karyawan != null) {
            $produksi->where('id_karyawan', self::$karyawan);
        }

        $data = array();
        $no = 1;
        foreach ($produksi->get() as $data_item) {
            $column = array();
            $column[] = $no++;
            $column[] = date('d-m-Y', strtotime($data_item->tgl_mulai));
            $column[] = date('d-m-Y', strtotime($data_item->tgl_selesai));
            $column[] = (strtotime($data_item->tgl_mulai) - strtotime($data_item->tgl_selesai)) / 60 / 60 / 24;
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

    public static function data_produksi_per_tahun()
    {
        $data = self::data_pertahun();
        $container = array();
        $no = 1;
        if (!empty($data)) {
            foreach ($data as $item) {
                $column = array();
                $column['bulan'] = $item->bulan;
                $column['tgl_produksi'] = $item->tgl_mulai;
                $column['barang'] = $item->nm_barang;
                $column['bjb'] = $item->brg_jd_bagus;
                $column['bjr'] = $item->brg_jd_rusak;
                $column['bdp_b'] = $item->brg_bdp_bagus;
                $column['bdp_r'] = $item->brg_bpd_rusak;
                $column['supervisor'] = $item->supervisor;
                $container[] = $column;
            }
        }
        return self::_group_by($container, 'bulan');
    }

    private static function _group_by($array, $key)
    {
        $return = array();
        foreach ($array as $val) {
            $return[$val[$key]][] = $val;
        }
        return $return;
    }

    public static function dataIO()
    {
        $data = ItemIO::where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        if (self::$jenis_item != null)
        {
            $data->where('jenis_item', self::$jenis_item);
        }
        $no = 1;
        $container = [];
        if (!empty($data)) {
            foreach ($data->orderBy('tgl', 'desc')->get() as $item_data) {
                $column = [];
                $column['no'] = $no++;
                $column['tgl'] = $item_data->tgl;
                $column['barang'] = $item_data->linkToBarang->nm_barang;
                $column['spek'] = $item_data->linkToBarang->spec_barang;
                $column['merk'] = $item_data->linkToBarang->merk_barang;
                $column['satuan'] = $item_data->linkToBarang->linkToSatuan->satuan;
                $column['jumlah'] = $item_data->jumlah_brg;
                $column['ket'] = $item_data->ket;
                $container[] = $column;
            }
        }
        return $container;
    }

    private static function data_pertahun()
    {

        $query_plug = '';

        if (self::$year != null) {
            $query_plug .= ' and year(p_tambah_produksi.tgl_selesai)="' . self::$year . '" ';
        }

        if (self::$karyawan != null) {
            $query_plug .= ' and p_tambah_produksi.id_karyawan="' . self::$karyawan . '" ';
        }

        if (self::$supervisor != null) {
            $query_plug .= ' and p_tambah_produksi.id_supervisor_produksi="' . self::$supervisor . '" ';
        }

        if (self::$barang != null) {
            $query_plug .= ' and p_tambah_produksi.id_barang="' . self::$barang . '" ';
        }

        if (self::$tanggal_awal != null and self::$tanggal_akhir != null) {
            $query_plug .= 'and p_tambah_produksi.tgl_selesai BETWEEN "' . self::$tanggal_awal . '" and "' . self::$tanggal_akhir . '"';
        }

        $query = DB::select('SELECT 
                                    p_barang.nm_barang as nm_barang,
                                    (p_tambah_produksi.jumlah_brg_jadi_bagus/count(p_tenaga_produksi.id)) as brg_jd_bagus,
                                    (p_tambah_produksi.jumlah_brg_jadi_rusan/count(p_tenaga_produksi.id)) as brg_jd_rusak,
                                    (p_tambah_produksi.jumlah_bdp_bagus/count(p_tenaga_produksi.id)) as brg_bdp_bagus,
                                    (p_tambah_produksi.jumlah_bdp_rusak/count(p_tenaga_produksi.id)) as brg_bpd_rusak,
                                    month(p_tambah_produksi.tgl_selesai) as bulan,
                                    h_karyawan.nama_ky as supervisor,
                                    p_tambah_produksi.* FROM p_tambah_produksi JOIN p_barang on p_barang.id = p_tambah_produksi.id_barang 
                                    join p_tenaga_produksi on p_tambah_produksi.id = p_tenaga_produksi.id_tambah_produksi 
                                    join h_karyawan on h_karyawan.id = p_tambah_produksi.id_supervisor_produksi and 
                                    p_tambah_produksi.id_perusahaan = "' . Session::get('id_perusahaan_karyawan') . '" ' . $query_plug . ' GROUP by p_tambah_produksi.id
                                    order by p_tambah_produksi.tgl_selesai asc');
        return $query;
    }

    private static function bahan_produksi($produksi)
    {
        $container = array();
        if (!empty($produksi->linkToBahanProduksi)) {
            foreach ($produksi->linkToBahanProduksi as $item) {
                $container[] = $item->linkToBarang->nm_barang;
            }
        }
        return $container;
    }

    private static function tenaga_produksi($produksi)
    {
        $container = array();
        if (!empty($produksi->linkToMannyTenagaProduksi)) {
            foreach ($produksi->linkToMannyTenagaProduksi as $item) {
                $container[] = rupiahView($item->jumlah_upah);
            }
        }
        return $container;
    }

    private static function biaya_over_head($produksi)
    {
        $container = array();
        if (!empty($produksi->linkToBiayaOverHead)) {
            foreach ($produksi->linkToBiayaOverHead as $item) {
                $container[] = $item->linkToOverhead->item_overhead;
            }
        }
        return $container;
    }

    public static function hpp_perbarang($produski)
    {
        return 0;
    }

    public static function hpp_total($produski)
    {
        return 0;
    }
}