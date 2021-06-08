<?php

namespace App\Http\Controllers\keuangan\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Transaksi;
use Session;
use App\Http\utils\data\BukuBesar as data_buku_besar;
use App\Model\Keuangan\AkunAktifUkm;
use App\Http\utils\data\SettingTahunBuku;
use App\Http\utils\HeaderReport;
class BukuBesar extends Controller
{
    //
    use Transaksi;
    private $tgl_awal;
    private $tgl_akhir;
    public function __construct()
    {
        $this->tgl_awal =date('Y-m-01');
        $this->tgl_akhir= date('Y-m-t');
    }

    public function index(){
        $data_tahun = SettingTahunBuku::tahun_buku();
        $data_tahun['tgl_awal'] = $this->tgl_awal;
        $data_tahun['tgl_akhir'] = $this->tgl_akhir;
        $data_buku_besar = data_buku_besar::groupAkunBaseOnDataJurnal($data_tahun);
        Session::put('menu-laporan-keuangan','buku_besar');
        $data=[
            'judul'=> 'Buku Besar',
            'tahun_berjalan2'=> $this->costumDate(),
            'data_buku_besar'=> $data_buku_besar,
            'akun'=>AkunAktifUkm::all()->where('id_perusahaan',Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.keuangan.section.laporan.page_default', $data);
    }

    public function preview($tgl_awal, $tgl_akhir){
        $data_array = SettingTahunBuku::tahun_buku();
        $data_array['tgl_awal'] = date('Y-m-d', strtotime($tgl_awal));
        $data_array['tgl_akhir'] = date('Y-m-d', strtotime($tgl_akhir));
        $data_buku_besar = data_buku_besar::groupAkunBaseOnDataJurnal($data_array);
        Session::put('menu-laporan-keuangan','buku_besar');
        $data=[
            'judul'=> 'Buku Besar',
            'tahun_berjalan2'=> $this->costumDate(),
            'data_buku_besar'=> $data_buku_besar,
            'akun'=>AkunAktifUkm::all()->where('id_perusahaan',Session::get('id_perusahaan_karyawan'))
        ];
        return view('user.keuangan.section.laporan.page_default', $data);
    }

    public function print($tgl_awal, $tgl_akhir){
        $data_array = SettingTahunBuku::tahun_buku();
        $data_array['tgl_awal'] = date('Y-m-d', strtotime($tgl_awal));
        $data_array['tgl_akhir'] = date('Y-m-d', strtotime($tgl_akhir));
        $data_buku_besar = data_buku_besar::groupAkunBaseOnDataJurnal($data_array);
        $data=[
            'judul'=> 'Buku Besar',
            'tahun_berjalan2'=> $this->costumDate(),
            'data_buku_besar'=> $data_buku_besar,
            'akun'=>AkunAktifUkm::all()->where('id_perusahaan',Session::get('id_perusahaan_karyawan'))
        ];
        $data['header'] = HeaderReport::header('layouts.header_print.header',$tgl_awal,$tgl_akhir,'Buku Besar');

        return view('user.keuangan.section.laporan.buku_besar.print_page', $data);
    }
}
