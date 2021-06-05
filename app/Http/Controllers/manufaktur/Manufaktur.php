<?php

namespace App\Http\Controllers\manufaktur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Model\Manufaktur\P_SOP_Produksi;
use App\Model\Manufaktur\P_tambah_produksi;
use App\Model\Manufaktur\AkunManufaktur;
use App\Http\Controllers\produksi\utils\Produksi;
use App\Http\Controllers\produksi\utils\Pembelian;
use App\Model\Produksi\Supplier;

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
        $this->month = date('m', strtotime('2021-05-19'));
        $this->years = date('Y', strtotime('2021-05-19'));
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
        return view('user.manufaktur.pages.laporan.produksi.page_show', ['data' => $produksi]);
    }

    public function PrinView_OrCetak(Request $req)
    {
        Produksi::$tanggal_awal = $req->tgl_awal;
        Produksi::$tanggal_akhir = $req->tgl_akhir;
        $produksi = Produksi::DataProduksi();
        if ($req->action == 'preview') {
            return view('user.manufaktur.pages.laporan.produksi.page_show', ['data' => $produksi]);
        } else {
            return view('user.manufaktur.pages.laporan.produksi.cetak', ['data' => $produksi]);
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
            return view('user.manufaktur.pages.laporan.pembelian.cetak', ['data' => $pembelian]);
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
        }else{
            return view('user.manufaktur.pages.laporan.detail_pembelian.cetak', ['data' => $pembelian, 'supplier' => $supplier]);
        }
    }

}
