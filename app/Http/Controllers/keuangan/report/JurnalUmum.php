<?php

namespace App\Http\Controllers\keuangan\report;

use App\Http\utils\HeaderReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Transaksi;
use App\Http\utils\data\JurnalUmum as data_jurnal_umum;
use App\Http\utils\data\SettingTahunBuku;
use Session;
class JurnalUmum extends Controller
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
        data_jurnal_umum::$date_awal = $this->tgl_awal;
        data_jurnal_umum::$date_akhir = $this->tgl_akhir;
        $jurnal = data_jurnal_umum::data_jurnal_umum($data_tahun);
        $jurnal['judul']='Jurnal Umum';
        $jurnal['tahun_berjalan']=$this->costumDate();
        Session::put('menu-laporan-keuangan','jurnal_umum');
        return view('user.keuangan.section.laporan.page_default', $jurnal);
    }

    public function print($tgl_awal, $tgl_akhir){
        data_jurnal_umum::$date_awal = date('Y-m-d', strtotime($tgl_awal));
        data_jurnal_umum::$date_akhir = date('Y-m-d', strtotime($tgl_akhir));
        $jurnal = data_jurnal_umum::data_jurnal_umum(null);
        $jurnal['judul']='Jurnal Umum';
        $jurnal['tahun_berjalan']=$this->costumDate();
        $jurnal['header'] = HeaderReport::header('layouts.header_print.header',$tgl_awal,$tgl_akhir,'Jurnal Umum');
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
