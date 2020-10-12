<?php

namespace App\Http\Controllers\keuangan\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Transaksi;
use App\Http\utils\data\JurnalUmum as data_jurnal_umum;
use Session;
class JurnalUmum extends Controller
{
    //
    use Transaksi;

    public function index(){

        $jurnal = data_jurnal_umum::data_jurnal_umum(null);
        $jurnal['judul']='Jurnal Umum';
        $jurnal['tahun_berjalan']=$this->costumDate();

//        dd($jurnal);
        return view('user.keuangan.section.laporan.page_default', $jurnal);
    }

    public function print($tgl_awal, $tgl_akhir){
        data_jurnal_umum::$date_awal = date('Y-m-d', strtotime($tgl_awal));
        data_jurnal_umum::$date_akhir = date('Y-m-d', strtotime($tgl_akhir));
        $jurnal = data_jurnal_umum::data_jurnal_umum(null);
        $jurnal['judul']='Jurnal Umum';
        $jurnal['tahun_berjalan']=$this->costumDate();
        return view('user.keuangan.section.laporan.jurnal_umum.print_page', $jurnal);
    }

    public function preview(Request $request){
        data_jurnal_umum::$date_awal = date('Y-m-d', strtotime($request->tanggal_awal));
        data_jurnal_umum::$date_akhir = date('Y-m-d', strtotime($request->tanggal_akhir));
        $jurnal = data_jurnal_umum::data_jurnal_umum(null);
        $jurnal['judul']='Jurnal Umum';
        $jurnal['tahun_berjalan']=$this->costumDate();
        return response()->json($jurnal);
    }

}
