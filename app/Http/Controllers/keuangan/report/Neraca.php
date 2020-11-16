<?php

namespace App\Http\Controllers\keuangan\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Traits\Transaksi;
use App\Http\utils\data\Neraca as data_neraca;

class Neraca extends Controller
{
    //
    use Transaksi;
    public function index(){
        Session::put('menu-laporan-keuangan','neraca');
        $data_neraca = data_neraca::getAktivaPasiva(null);
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
}
