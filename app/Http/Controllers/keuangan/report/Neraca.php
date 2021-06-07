<?php

namespace App\Http\Controllers\keuangan\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Traits\Transaksi;
use App\Http\utils\data\Neraca as data_neraca;
use App\Http\utils\data\SettingTahunBuku;
use App\Http\utils\HeaderReport;
class Neraca extends Controller
{
    //
    use Transaksi;
    public function index(){
        Session::put('menu-laporan-keuangan','neraca');
        $data_tahun = SettingTahunBuku::tahun_buku();
        $data_neraca = data_neraca::getAktivaPasiva($data_tahun);
//        dd($data_neraca);
        $data= [
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1'],
            'judul'=> 'Neraca',
            'tahun_berjalan2'=> $this->costumDate(),
            'data'=> $data_neraca
        ];

        return view('user.keuangan.section.laporan.page_default', $data);
    }

    public function print($tgl_awal, $tgl_akhir){
        $data_array = SettingTahunBuku::tahun_buku();
        $data_neraca = data_neraca::getAktivaPasiva($data_array);
//        dd($data_neraca);
        $data= [
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1'],
            'judul'=> 'Neraca',
            'tahun_berjalan2'=> $this->costumDate(),
            'data'=> $data_neraca
        ];
        $data['header'] = HeaderReport::header('layouts.header_print.header',$tgl_awal,$tgl_akhir,'Neraca');


        return view('user.keuangan.section.laporan.neraca.print_page', $data);
    }
}
