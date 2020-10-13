<?php

namespace App\Http\Controllers\keuangan\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Transaksi;
use Session;
use App\Http\utils\data\BukuBesar as data_buku_besar;
class BukuBesar extends Controller
{
    //
    use Transaksi;

    public function index(){

        $data_buku_besar = data_buku_besar::groupAkunBaseOnDataJurnal(null);

        Session::put('menu-laporan-keuangan','buku_besar');
        $data=[
            'judul'=> 'Buku Besar',
            'tahun_berjalan2'=> $this->costumDate(),
        ];
        return view('user.keuangan.section.laporan.page_default', $data);
    }
}
