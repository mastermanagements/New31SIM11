<?php

namespace App\Http\Controllers\keuangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Traits\Transaksi;

class LaporanKeuangan extends Controller
{
    private $id_karyawan;
    private $id_perusahaan;
    use Transaksi;

    public function __construct()
    {

        $this->middleware(function($req, $next){
            if(empty(Session::get('id_karyawan')) && empty(Session::get('id_perusahaan_karyawan')))
            {
                Session::flush();
                return redirect('/')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            return $next($req);
        });
    }

    public function index(){
        $data=[
            'judul'=> 'Jurnal Umum',
            'tahun_berjalan'=> $this->costumDate(),
        ];
        Session::put('menu-laporan-keuangan','jurnal_umum');
        return view('user.keuangan.section.laporan.page_default', $data);
    }

    public function dataJurnal(){
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1']
        ];

        $data = [
            'data'=> $this->daftar_jurnal($data_pass)
        ];

        return response()->json($data);
    }
    public function dataBaseOnDate(Request $req){
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tanggal_awal'=> date('Y-m-d',strtotime($req->tanggal_awal)),
            'tanggal_akhir'=>date('Y-m-d',strtotime($req->tanggal_akhir)) ,
            'jenis_jurnal'=> ['0','1']
        ];

        $data = [
            'data'=> $this->daftar_jurnal($data_pass)
        ];

        return response()->json($data);
    }

    public function cetak_jurnal_umum($tgl_awal, $tgl_akhir){
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tanggal_awal'=> date('Y-m-d',strtotime($tgl_awal)),
            'tanggal_akhir'=>date('Y-m-d',strtotime($tgl_akhir)) ,
            'jenis_jurnal'=> ['0','1']
        ];

        $data = [
            'data' => $this->daftar_jurnal($data_pass)
        ];

        return view('user.keuangan.section.laporan.jurnal_umum.print_page', $data);
    }


    //====================================== Buku Besar ======================================================

    public function buku_besar(){
        Session::put('menu-laporan-keuangan','buku_besar');
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,

            'jenis_jurnal'=> ['0','1']
        ];
        $data=[
            'judul'=> 'Buku Besar',
            'tahun_berjalan2'=> $this->costumDate(),
            'data'=> $this->data_buku_besar($data_pass)
        ];
        return view('user.keuangan.section.laporan.page_default', $data);
    }

    public function dataBukuBesars(){
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1']
        ];

        $data = [
            'data'=> $this->data_buku_besar($data_pass)
        ];

        return response()->json($data);
    }

    public function cetak_buku_besar($tgl_awal, $tgl_akhir){
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tanggal_awal'=> date('Y-m-d',strtotime($tgl_awal)),
            'tanggal_akhir'=>date('Y-m-d',strtotime($tgl_akhir)) ,
            'jenis_jurnal'=> ['0','1'],
            'tahun_berjalan'=> $this->costumDate()->year,
        ];

        $data = [
            'data' => $this->data_buku_besar($data_pass)
        ];

        return view('user.keuangan.section.laporan.buku_besar.print_page', $data);
    }

    //======================================= Neraca Saldo ============================================================
    public function neraca_saldo(){
        Session::put('menu-laporan-keuangan','neraca-saldo');
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1'],
         ];
        $data=[
            'judul'=> 'Neraca Saldo',
            'tahun_berjalan2'=> $this->costumDate(),
            'data'=> $this->data_neraca_saldo($data_pass)
        ];
        return view('user.keuangan.section.laporan.page_default', $data);
    }

    public function dataNeracaSaldo(){
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1']
        ];
        $data = [
            'data'=> $this->data_neraca_saldo($data_pass)
        ];
        return response()->json($data);
    }

    public function cetak_neraca_saldo($tgl_awal, $tgl_akhir){
         $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1'],
             'tanggal_awal'=> date('Y-m-d',strtotime($tgl_awal)),
             'tanggal_akhir'=>date('Y-m-d',strtotime($tgl_akhir)) ,
        ];
        $data=[
            'judul'=> 'Neraca Saldo',
            'tahun_berjalan2'=> $this->costumDate(),
            'data'=> $this->data_neraca_saldo($data_pass)
        ];
        return view('user.keuangan.section.laporan.neraca_saldo.print_page', $data);
    }

    //============================================== Laba Rugi ============================================
    public function laba_rugi(){
        Session::put('menu-laporan-keuangan','laba-rugi');
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1']
        ];
        $data=[
            'judul'=> 'Laba Rugi',
            'tahun_berjalan2'=> $this->costumDate(),
            'data'=> $this->data_laba_rugi($data_pass)
        ];
        return view('user.keuangan.section.laporan.page_default', $data);
    }

    public function data_labaRugi(){
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1']
        ];
        $data = [
            'data'=> $this->data_laba_rugi($data_pass)
        ];
        return response()->json($data);
    }
	
	//============================================== perubahan modal ============================================

    public function cetak_laba_rugi($tgl_awal, $tgl_akhir){
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1'],
            'tanggal_awal'=> date('Y-m-d',strtotime($tgl_awal)),
            'tanggal_akhir'=>date('Y-m-d',strtotime($tgl_akhir)) ,
        ];
        $data=[
            'judul'=> 'Laba Rugi',
            'tahun_berjalan2'=> $this->costumDate(),
            'data'=> $this->data_laba_rugi($data_pass)
        ];
        return view('user.keuangan.section.laporan.laba_rugi.print_page', $data);
    }

    //========================================================= Perubahan Modal =================================
    public function perubahan_modal(){
        Session::put('menu-laporan-keuangan','perubahan-modal');
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1'],
            'debet_kredit'=> ['0','1'],
        ];
        $data=[
            'judul'=> 'Perubahan Modal',
            'tahun_berjalan2'=> $this->costumDate(),
            'data'=> $this->data_perubahan_modal($data_pass)
        ];
        return view('user.keuangan.section.laporan.page_default', $data);
    }

    public function data_perubahan_modals(){
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1'],
            'debet_kredit'=> ['0','1'],
        ];
        $data = [
            'data'=> $this->data_perubahan_modal($data_pass)
        ];
        return response()->json($data);
    }

    public function cetak_perubahan_modal($tgl_awal, $tgl_akhir){
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1'],
            'debet_kredit'=> ['0','1'],
            'tanggal_awal'=> date('Y-m-d',strtotime($tgl_awal)),
            'tanggal_akhir'=>date('Y-m-d',strtotime($tgl_akhir)) ,
        ];
        $data=[
            'judul'=> 'Perubahan Modal',
            'data'=> $this->data_perubahan_modal($data_pass)
        ];
        return view('user.keuangan.section.laporan.perubahan_modal.print_page', $data);
    }
    //============================================== Neraca ============================================
    public function neraca(){
        Session::put('menu-laporan-keuangan','neraca');
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1']
        ];
        $data=[
            'judul'=> 'Neraca',
            'tahun_berjalan2'=> $this->costumDate(),
            'data'=> $this->data_neracas($data_pass)
        ];
        return view('user.keuangan.section.laporan.page_default', $data);
    }

    public function data_neraca(){
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1']
        ];
        $data = [
            'data'=> $this->data_neracas($data_pass)
        ];
        return response()->json($data);
    }

    public function cetak_neraca($tgl_awal, $tgl_akhir){
        Session::put('menu-laporan-keuangan','neraca');
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1'],
            'tanggal_awal'=> date('Y-m-d',strtotime($tgl_awal)),
            'tanggal_akhir'=>date('Y-m-d',strtotime($tgl_akhir)) ,
        ];
        $data=[
            'judul'=> 'Neraca',
            'data'=> $this->data_neracas($data_pass)
        ];
        return view('user.keuangan.section.laporan.neraca.print_page', $data);
    }

    public function tampilan_arus_kas(){
        Session::put('menu-laporan-keuangan','arus-kas');
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1']
        ];
        $data=[
            'judul'=> 'Arus Kas',
            'tahun_berjalan2'=> $this->costumDate(),
            'data'=> $this->aruskas($data_pass)[0]
        ];
        return view('user.keuangan.section.laporan.page_default', $data);
    }

    public function cetak_arus_kas($tgl_awal, $tgl_akhir){
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1'],
            'tanggal_awal'=> date('Y-m-d',strtotime($tgl_awal)),
            'tanggal_akhir'=>date('Y-m-d',strtotime($tgl_akhir)) ,
        ];
        $data=[
            'judul'=> 'Arus Kas',
            'tahun_berjalan2'=> $this->costumDate(),
            'data'=> $this->aruskas($data_pass)[0]
        ];
        return view('user.keuangan.section.laporan.arus_kas.print_page', $data);
    }


    public function arus_kas(){
       return response()->json( $this->aruskas());
    }
}
