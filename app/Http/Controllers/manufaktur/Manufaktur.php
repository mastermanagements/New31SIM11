<?php

namespace App\Http\Controllers\manufaktur;

use App\Http\Controllers\produksi\utils\Penjualan;
use App\Http\Controllers\produksi\utils\StokBarangOperation;
use App\Model\Administrasi\Klien;
use App\Model\Hrd\H_Karyawan;
use App\Model\Produksi\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Manufaktur\P_SOP_Produksi;
use App\Model\Manufaktur\P_tambah_produksi;
use App\Model\Manufaktur\AkunManufaktur;
use App\Http\Controllers\produksi\utils\Produksi;
use App\Http\Controllers\produksi\utils\Pembelian;
use App\Model\Produksi\Supplier;
use App\Http\utils\HeaderReport;

class Manufaktur extends Controller
{
    //
    private $jenis_transaksi = [
        'Pemakaian bahan baku',
        'Penambahan persediaan brg jadi',
        'Penambahan persediaan brg dlm proses'
    ];

    private $month;
    private $years;

    public function __construct()
    {
        $this->month = date('m');
        $this->years = date('Y');
    }

    public function index()
    {
        $array = [
            'sop_produksi' => P_SOP_Produksi::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data_produksi' => P_tambah_produksi::all()->where('status_produksi', '0')->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'data_monitoring' => P_tambah_produksi::all()->where('status_produksi', '1')->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'selesai_produksi' => P_tambah_produksi::all()->where('status_produksi', '2')->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'akun_manufaktur' => AkunManufaktur::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'jenis_jurnal' => $this->jenis_transaksi
        ];
        if (empty(Session::get('tab2')) && empty(Session::get('tab3')) && empty(Session::get('tab4')) && empty(Session::get('tab5'))) {
            Session::flash('tab1', 'tab1');
        }

        if (!empty(Session::get('tab2'))) {
            Session::flash('tab2', Session::get('tab2'));
        }

        if (!empty(Session::get('tab3'))) {
            Session::flash('tab3', Session::get('tab3'));
        }

        if (!empty(Session::get('tab4'))) {
            Session::flash('tab4', Session::get('tab4'));
        }
        if (!empty(Session::get('tab5'))) {
            Session::flash('tab5', Session::get('tab5'));
        }
        return view('user.manufaktur.default', $array);
    }

    public function laporan_produksi()
    {
        Produksi::$month = $this->month;
        Produksi::$year = $this->years;

        $produksi = Produksi::DataProduksi();
        $barang = Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get();
        $supervisor = H_Karyawan::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get();
        return view('user.manufaktur.pages.laporan.produksi.page_show', ['data' => $produksi,'barang'=> $barang,'supervisor'=> $supervisor]);
    }

    public function PrinView_OrCetak(Request $req)
    {
        Produksi::$tanggal_awal = $req->tgl_awal;
        Produksi::$tanggal_akhir = $req->tgl_akhir;
        $produksi = Produksi::DataProduksi();
        $barang = Barang::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get();
        $supervisor = H_Karyawan::where('id_perusahaan', Session::get('id_perusahaan_karyawan'))->get();
        $produksi = Produksi::DataProduksi();
        $header = HeaderReport::header_format_2('layouts.header_print.header_print1', 'LAPORAN PRODUKSI');
        if ($req->action == 'preview') {
            return view('user.manufaktur.pages.laporan.produksi.page_show', ['data' => $produksi,'barang'=> $barang,'supervisor'=> $supervisor]);
        } else {
            return view('user.manufaktur.pages.laporan.produksi.cetak', ['data' => $produksi, 'header' => $header]);
        }
    }

    public function laporan_pembelian()
    {
        Pembelian::$month = $this->month;
        Pembelian::$years = $this->years;
        $pembelian = Pembelian::getData();
        $supplier = Supplier::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $metode_bayar = Pembelian::$metode_bayar;
        return view('user.manufaktur.pages.laporan.pembelian.page_show', ['data' => $pembelian, 'supplier' => $supplier, 'metode_bayar' => $metode_bayar]);
    }

    public function laporan_pembelian_printOrView(Request $req)
    {
        Pembelian::$tgl_awal = $req->tgl_awal;
        Pembelian::$tgl_akhir = $req->tgl_akhir;
        Pembelian::$jenis_bayar = $req->jenis_bayar;
        Pembelian::$supplier = $req->supplier;
        $pembelian = Pembelian::getData();
        $supplier = Supplier::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $metode_bayar = Pembelian::$metode_bayar;
        if ($req->action == 'preview') {
            return view('user.manufaktur.pages.laporan.pembelian.page_show', ['data' => $pembelian, 'supplier' => $supplier, 'metode_bayar' => $metode_bayar]);
        } else {
            $header = HeaderReport::header_format_2('layouts.header_print.header_print1', 'LAPORAN PEMBELIAN');
            return view('user.manufaktur.pages.laporan.pembelian.cetak', ['data' => $pembelian, 'header' => $header]);
        }
    }

    public function laporan_detail_pembelian()
    {
        Pembelian::$month = $this->month;
        Pembelian::$years = $this->years;
        $pembelian = Pembelian::get_detail_pembelian();
        $supplier = Supplier::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $metode_bayar = Pembelian::$metode_bayar;
//        dd($pembelian);
        return view('user.manufaktur.pages.laporan.detail_pembelian.page_show', ['data' => $pembelian, 'supplier' => $supplier, 'metode_bayar' => $metode_bayar]);
    }

    public function print_view_detail_pembelian(Request $req)
    {
        Pembelian::$tgl_awal = $req->tgl_awal;
        Pembelian::$supplier = $req->supplier;
        $pembelian = Pembelian::get_detail_pembelian();
        $supplier = Supplier::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'));
        $metode_bayar = Pembelian::$metode_bayar;
        if ($req->action == 'preview') {
            return view('user.manufaktur.pages.laporan.detail_pembelian.page_show', ['data' => $pembelian, 'supplier' => $supplier, 'metode_bayar' => $metode_bayar]);
        } else {
            $header = HeaderReport::header_format_2('layouts.header_print.header_print1', 'LAPORAN DETAIL PEMBELIAN');
            return view('user.manufaktur.pages.laporan.detail_pembelian.cetak', ['data' => $pembelian, 'supplier' => $supplier, 'header' => $header]);
        }
    }


    //================================== Penjualan =========================================
    public function laporan_penjualan()
    {
        Penjualan::$month = $this->month;
        Penjualan::$year = $this->years;
        $data = [
            'data' => Penjualan::getData(),
            'metode_bayar' => Penjualan::$jenis_penjualan,
            'klien' => Klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.manufaktur.pages.laporan.penjualan.page_show', $data);
    }

    public function laporan_print_penjualan(Request $req)
    {
        Penjualan::$tgl_awal = $req->tgl_awal;
        Penjualan::$tgl_akhir = $req->tgl_akhir;
        $header = HeaderReport::header_format_2('layouts.header_print.header_print1', 'LAPORAN PENJUALAN');
        $data = [
            'data' => Penjualan::getData(),
            'metode_bayar' => Penjualan::$jenis_penjualan,
            'klien' => Klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'header' => $header
        ];
        if ($req->action == 'preview') {
            return view('user.manufaktur.pages.laporan.penjualan.page_show', $data);
        } else {
            return view('user.manufaktur.pages.laporan.penjualan.cetak', $data);
        }
    }

    public function laporan_detail_penjualan()
    {
        Penjualan::$month = $this->month;
        Penjualan::$year = $this->years;
        $data = [
            'data' => Penjualan::getData(),
            'metode_bayar' => Penjualan::$jenis_penjualan,
            'klien' => Klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan'))
        ];

        return view('user.manufaktur.pages.laporan.detail_penjualan.page_show', $data);
    }

    public function laporan_print_detail_penjualan(Request $req)
    {
        Penjualan::$tgl_transaksi = $req->tgl_transaksi;
        Penjualan::$klien = $req->klien;
        $header = HeaderReport::header_format_2('layouts.header_print.header_print1', 'LAPORAN DETAIL PENJUALAN');
        $data = [
            'data' => Penjualan::getData(),
            'metode_bayar' => Penjualan::$jenis_penjualan,
            'klien' => Klien::all()->where('id_perusahaan', Session::get('id_perusahaan_karyawan')),
            'header' => $header
        ];
        if ($req->action == 'preview') {
            return view('user.manufaktur.pages.laporan.detail_penjualan.page_show', $data);
        } else {
            return view('user.manufaktur.pages.laporan.detail_penjualan.cetak', $data);
        }
    }

    public function laporan_stok_barang()
    {
        $stok_barang = StokBarangOperation::getDataStok();
        $data = [
            'data' => $stok_barang,
            'jenis_barang' => StokBarangOperation::$list_jenis_barang
        ];
        return view('user.manufaktur.pages.laporan.StokBarang.page_show', $data);
    }

    public function laporan_print_preview_stok_barang(Request $req)
    {
        StokBarangOperation::$jenis_barang = $req->jenis_barang;
        $stok_barang = StokBarangOperation::getDataStok();
        $header = HeaderReport::header_format_2('layouts.header_print.header_print1', 'LAPORAN STOK BARANG');
        $data = [
            'data' => $stok_barang,
            'jenis_barang' => StokBarangOperation::$list_jenis_barang,
            'header' => $header
        ];
        if ($req->action == "preview") {
            return view('user.manufaktur.pages.laporan.StokBarang.page_show', $data);
        } else {
            return view('user.manufaktur.pages.laporan.StokBarang.cetak', $data);
        }
    }
}
