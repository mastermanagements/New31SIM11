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
                return redirect('login-karyawan')->with('message_login_fail','Waktu masuk anda berakhir, Silahkan login Ulang...!!');
            }
            $this->id_karyawan = Session::get('id_karyawan');
            $this->id_perusahaan = Session::get('id_perusahaan_karyawan');
            return $next($req);
        });
    }

    public function index(){
        $data=[
            'judul'=> 'Jurnal Umum'
        ];
        Session::put('menu-laporan-keuangan','jurnal_umum');
        return view('user.keuangan.section.laporan.page_default', $data);
    }

    public function dataJurnal(){
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year
        ];

        $data = [
            'data'=> $this->daftar_jurnal($data_pass)
        ];

        return response()->json($data);
    }
    public function dataBaseOnDate(Request $req){
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tanggal_awal'=> $req->tanggal_awal,
            'tanggal_akhir'=> $req->tanggal_akhir,
        ];

        $data = [
            'data'=> $this->daftar_jurnal($data_pass)
        ];

        return response()->json($data);
    }

    //====================================== Buku Besar ======================================================

    public function buku_besar(){
        Session::put('menu-laporan-keuangan','buku_besar');
        $data=[
            'judul'=> 'Buku Besar'
        ];
        return view('user.keuangan.section.laporan.page_default', $data);
    }

    public function dataBukuBesars(){
        $data_pass= [
            'id_perusahaan'=> $this->id_perusahaan,
            'tahun_berjalan'=> $this->costumDate()->year
        ];

        $data = [
            'data'=> $this->data_buku_besar($data_pass)
        ];

        return response()->json($data);
    }
}
