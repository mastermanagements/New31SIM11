<?php

namespace App\Http\Controllers\keuangan\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Traits\Transaksi;
use App\Http\utils\data\LabaRugi as laba;
class LabaRugi extends Controller
{
    //
    use Transaksi;

    public function index(){

        $data = laba::LabaRugi(null);
        $akun = laba::$akun_focus;
        Session::put('menu-laporan-keuangan','laba-rugi');
        $data_pass= [
            'judul'=> 'Laba Rugi',
            'tahun_berjalan'=> $this->costumDate()->year,
            'jenis_jurnal'=> ['0','1'],
            'tahun_berjalan2'=> $this->costumDate(),
            'data'=>$data,
            'akun'=>$akun
        ];
        return view('user.keuangan.section.laporan.page_default', $data_pass);
    }
}
