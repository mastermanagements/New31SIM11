<?php

namespace App\Http\Controllers\keuangan\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Traits\Transaksi;
use App\Http\utils\data\PerubahanModal as perubahan_modal;


class PerubahanModal extends Controller
{
    //
    use Transaksi;
    public function index(){
        $data = perubahan_modal::data_perubahan_model(null);
//        dd($data);
        Session::put('menu-laporan-keuangan','perubahan-modal');
        $akun = perubahan_modal::$akun_focus;
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
